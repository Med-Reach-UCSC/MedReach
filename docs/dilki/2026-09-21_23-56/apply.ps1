# Applies this handoff for Ishara (branch: dilki).
# Second delivery-module batch -- depends on the first one
# (docs/dilki/2026-09-21_18-45) already being applied, since it modifies
# the sidebar that batch added.
# Run it by double-clicking apply.bat in this same folder.
$Here = $PSScriptRoot
. (Join-Path $Here "..\..\apply-patch-lib.ps1")

$Branch = "dilki"

Confirm-Git
Enter-RepoRoot -ScriptDir $Here
Confirm-Auth
Confirm-CleanWorktree
Sync-Branch -Branch $Branch

if (-not (Test-Path "presentation/views/partials/sidebar-delivery.php")) {
    Fail "presentation/views/partials/sidebar-delivery.php doesn't exist on your branch yet. Run docs/dilki/2026-09-21_18-45/apply.bat first -- this batch builds on top of it."
}

if (Test-Path "presentation/views/delivery/details.php") {
    Fail "presentation/views/delivery/details.php already exists on your branch. Don't run this -- message Tharusha, something's out of sync."
}

Invoke-ApplyPatch (Join-Path $Here "details-view.patch")
Invoke-ApplyPatch (Join-Path $Here "details-entrypoint.patch")
Invoke-ApplyPatch (Join-Path $Here "sidebar-manifest-link.patch")

Invoke-CommitFiles -Message "feat(delivery): add task details page" -Files @(
    "presentation/views/delivery/details.php",
    "delivery-details.php",
    "presentation/views/partials/sidebar-delivery.php"
)

Invoke-PushBranch -Branch $Branch

Write-Host ""
Info "Done. No style.css changes in this batch -- the page reused existing components only."
