# Applies this handoff for Ishara (branch: dilki).
# First delivery-module batch -- no prior batch dependency.
# Run it by double-clicking apply.bat in this same folder.
$Here = $PSScriptRoot
. (Join-Path $Here "..\..\apply-patch-lib.ps1")

$Branch = "dilki"

Confirm-Git
Enter-RepoRoot -ScriptDir $Here
Confirm-Auth
Confirm-CleanWorktree
Sync-Branch -Branch $Branch

if (Test-Path "presentation/views/delivery/dashboard.php") {
    Fail "presentation/views/delivery/dashboard.php already exists on your branch. Don't run this -- message Tharusha, something's out of sync."
}

Invoke-ApplyPatch (Join-Path $Here "dashboard-view.patch")
Invoke-ApplyPatch (Join-Path $Here "sidebar-delivery.patch")
Invoke-ApplyPatch (Join-Path $Here "dashboard-entrypoint.patch")
Invoke-ApplyPatch (Join-Path $Here "style-additions.patch")

Invoke-CommitFiles -Message "feat(delivery): add rider dashboard page" -Files @(
    "presentation/views/delivery/dashboard.php",
    "presentation/views/partials/sidebar-delivery.php",
    "delivery-dashboard.php",
    "presentation/assets/css/style.css"
)

Invoke-PushBranch -Branch $Branch

Write-Host ""
Info "Done. If style-additions.patch failed above, see INSTRUCTIONS.md -- it means one of the 3 new rules already landed on your branch some other way and needs checking by hand."
