# Shared helpers for every docs\<Member>\<date>\apply.ps1 script.
# Windows PowerShell only -- no Git Bash / WSL / Linux tools required.
# Not committed to git (docs/ is gitignored) -- travels inside the same
# zip/folder handoff you already send teammates. Fix a check here once
# instead of copy-pasting it into every apply.ps1.
#
# ponytail: one shared lib instead of duplicating this in 12 scripts.

$ErrorActionPreference = 'Stop'

function Info { param([string]$Message) Write-Host "==> $Message" -ForegroundColor Green }
function Warn { param([string]$Message) Write-Host "!!  $Message" -ForegroundColor Yellow }
function Fail { param([string]$Message) Write-Host "xx  $Message" -ForegroundColor Red; exit 1 }

function Confirm-Git {
    if (-not (Get-Command git -ErrorAction SilentlyContinue)) {
        Fail "git isn't installed. Install Git for Windows first: https://git-scm.com/downloads, then re-run this script."
    }
}

# Every apply.ps1 lives at docs\<Member>\<date>\apply.ps1 and passes its own
# $PSScriptRoot in here explicitly -- three levels up from there is the repo
# root (date -> Member -> docs -> repo root).
function Enter-RepoRoot {
    param([Parameter(Mandatory)][string]$ScriptDir)
    $repoRoot = Resolve-Path (Join-Path $ScriptDir "..\..\..")
    Set-Location $repoRoot
    if (-not (Test-Path ".git")) {
        Fail "This doesn't look like the MedReach git repo. Make sure this docs folder is the one inside your MedReach checkout, not a copy elsewhere."
    }
    Info "Repo root: $(Get-Location)"
}

function Confirm-Auth {
    Info "Checking GitHub access..."
    if (Get-Command gh -ErrorAction SilentlyContinue) {
        gh auth status *>$null
        if ($LASTEXITCODE -ne 0) {
            Warn "You're not logged into GitHub yet. Starting 'gh auth login' -- when prompted, choose GitHub.com, HTTPS, and 'Login with a web browser'."
            gh auth login
            if ($LASTEXITCODE -ne 0) {
                Fail "GitHub login didn't complete. Re-run this script once you're logged in ('gh auth login' from any terminal)."
            }
        } else {
            Info "GitHub CLI is authenticated."
        }
    } else {
        Warn "GitHub CLI (gh) isn't installed, so this script can't log you in automatically."
        Warn "If the next step fails with a permission/authentication error: install it from https://cli.github.com, run 'gh auth login', then re-run this script."
    }

    git ls-remote origin *>$null
    if ($LASTEXITCODE -ne 0) {
        Fail "Can't reach 'origin' with your current credentials. Install GitHub CLI and run 'gh auth login' (or ask Tharusha to help set up access), then re-run this script."
    }
    Info "Access to origin confirmed."
}

function Confirm-CleanWorktree {
    $status = git status --porcelain
    if ($status) {
        Fail "You have uncommitted changes in your checkout. Commit or 'git stash' them first, then re-run this script. (This check exists so a patch never silently overwrites work you haven't saved yet.)"
    }
}

function Sync-Branch {
    param([Parameter(Mandatory)][string]$Branch)

    Info "Fetching latest from origin..."
    git fetch origin
    if ($LASTEXITCODE -ne 0) { Fail "git fetch failed. Check your internet connection and GitHub access." }

    git show-ref --verify --quiet "refs/heads/$Branch"
    $hasLocalBranch = ($LASTEXITCODE -eq 0)

    if ($hasLocalBranch) {
        Info "Switching to your local '$Branch' branch..."
        git checkout $Branch
    } else {
        git show-ref --verify --quiet "refs/remotes/origin/$Branch"
        $hasRemoteBranch = ($LASTEXITCODE -eq 0)
        if ($hasRemoteBranch) {
            Info "Creating local branch '$Branch' tracking origin/$Branch..."
            git checkout -b $Branch "origin/$Branch"
        } else {
            Fail "Branch '$Branch' doesn't exist locally or on origin. Don't create a new one -- check with Tharusha first."
        }
    }
    if ($LASTEXITCODE -ne 0) { Fail "Could not check out branch '$Branch'." }

    Info "Pulling latest '$Branch' (fast-forward only, no auto-merge)..."
    git pull --ff-only origin $Branch
    if ($LASTEXITCODE -ne 0) {
        Fail "Your '$Branch' has diverged from origin and can't fast-forward safely. This script won't auto-merge to avoid creating a mess -- resolve it yourself or ask for help, then re-run."
    }
}

function Merge-Main {
    Info "Merging latest 'main' into your branch (brings in the shared style.css/main.js library)..."
    git merge origin/main -m "Merge main into branch: bring in shared CSS/JS library"
    if ($LASTEXITCODE -ne 0) {
        Fail "Merging 'main' hit a conflict. Don't try to resolve it yourself -- run 'git merge --abort' and message Tharusha."
    }
    Info "Merged latest main."
}

function Invoke-ApplyPatch {
    param([Parameter(Mandatory)][string]$PatchFile)
    $name = Split-Path $PatchFile -Leaf
    Info "Checking patch applies cleanly: $name"
    git apply --check $PatchFile
    if ($LASTEXITCODE -ne 0) {
        Fail "'$name' doesn't apply cleanly on top of your current branch. Don't force it -- message Tharusha with this exact error; something has probably changed since this patch was made."
    }
    git apply $PatchFile
    if ($LASTEXITCODE -ne 0) { Fail "'$name' failed to apply even though the check passed. Message Tharusha with this error." }
    Info "Applied $name"
}

function Invoke-CommitFiles {
    param(
        [Parameter(Mandatory)][string]$Message,
        [Parameter(Mandatory)][string[]]$Files
    )
    git add -- $Files
    if ($LASTEXITCODE -ne 0) { Fail "git add failed for: $($Files -join ', ')" }
    git commit -m $Message
    if ($LASTEXITCODE -ne 0) { Fail "git commit failed." }
    Info "Committed: $Message"
}

function Invoke-PushBranch {
    param([Parameter(Mandatory)][string]$Branch)
    Info "Pushing '$Branch' to origin..."
    git push origin $Branch
    if ($LASTEXITCODE -ne 0) { Fail "git push failed. Check your GitHub access/permissions." }
    Info "Pushed. Open a pull request on GitHub if your team wants review before merging to main."
}
