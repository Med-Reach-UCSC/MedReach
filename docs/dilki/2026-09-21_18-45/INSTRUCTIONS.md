**Quick start (Windows):** double-click `apply.bat` in this folder — it checks your GitHub login, pulls your `dilki` branch, merges in the latest `main`, applies the patches below in order, commits, and pushes automatically. First time doing this? See `docs/README.md`. Manual steps below are the fallback if the script stops partway.

# Handoff: Delivery rider dashboard

**For:** H.K.D. Ishara — Delivery Personnel Module
**Branch:** `dilki`
**From:** Tharusha Gunerathne (Core System Architecture / Admin Module)

## Scope note

This page belongs to your module. It was built outside it (converted from
`docs/delivery-dahsboard.php`, the Tailwind mockup dropped into `docs/`) so
the collaboration workflow could get you a working endpoint to review
quickly. Please own it going forward — presentation-tier only, nothing
touches `business/` or `data/`, but it's your call on the delivery module's
UI from here.

This is the first delivery-module batch, so there's no prior batch it
depends on — `apply.bat` only checks that
`presentation/views/delivery/dashboard.php` doesn't already exist on your
branch before doing anything.

**Update, 2026-09-24 — `style-additions.patch` removed, merge step added
instead.** `style.css` and `main.js` were only ever built up on Tharusha's
own branch and never merged into `main`, so your branch's `style.css` was
still empty (0 bytes) — that's why the old CSS patch existed and then
failed. `main` has since had that branch merged into it (PR #3), so it now
carries the complete `style.css`, `main.js`, and vendor Chart.js. `apply.bat`
now merges `origin/main` into your branch first — that alone fills in the
full stylesheet (including the 3 rules this page needs), so the separate
CSS patch isn't needed anymore and has been deleted from this folder.

## What's in this batch

| File | Type | Contents |
|---|---|---|
| `dashboard-view.patch` | new file | `presentation/views/delivery/dashboard.php` — the rider dashboard page |
| `sidebar-delivery.patch` | new file | `presentation/views/partials/sidebar-delivery.php` — shared sidebar for the delivery module, same pattern as `sidebar-pharmacy.php`/`sidebar-patient.php` |
| `dashboard-entrypoint.patch` | new file | `delivery-dashboard.php` (root) thin entry point, same pattern as `orders.php`/`pharmacy-earnings.php` |

The 3 CSS rules this page needs (`.mr-mini-stat--accent`,
`.mr-map-preview--lg`, `.mr-stat-grid-3`) now arrive via the `main` merge
step below, not a patch file.

## If a patch fails

- `dashboard-view.patch` / `sidebar-delivery.patch` / `dashboard-entrypoint.patch`:
  these create new files, so they only fail if those files already exist on
  your branch — message Tharusha, something's out of sync.
- The `main` merge step failing means something changed since this batch
  was made — don't try to resolve it yourself, run `git merge --abort` and
  message Tharusha.

## Manual apply (fallback if you're not using `apply.bat`)

```bash
git checkout dilki   # or your working branch
git pull
git merge origin/main
cd MedReach
git apply docs/Dilki/2026-09-21_18-45/dashboard-view.patch
git apply docs/Dilki/2026-09-21_18-45/sidebar-delivery.patch
git apply docs/Dilki/2026-09-21_18-45/dashboard-entrypoint.patch
git add presentation/views/delivery/dashboard.php \
        presentation/views/partials/sidebar-delivery.php \
        delivery-dashboard.php
git commit -m "feat(delivery): add rider dashboard page"
git push origin dilki
```

## What the page does

Delivery rider-facing dashboard: a greeting header with today's
delivery-count/on-time-rate capsules and an availability toggle, a 3-card
status row (active delivery ID, ETA, cash to collect), a route-overview card
with a live-tracking badge, a manifest queue of upcoming drop-offs, a
Cold Chain Alert card flagging temperature-sensitive cargo with a progress
bar, and a distance/earnings summary. Entirely static markup — no JS
wiring, no backend calls, no live map/GPS (the route card is the same
static decorative `.mr-map-preview` used elsewhere in the app — wire up
real tracking later if/when a mapping API is approved). Character used is
"Marcus Reed", the same courier name already established in
`track-order-status.php` and `pharmacy/orders.php`.

## Reused vs. new

Almost entirely reused, only 3 small CSS variants added (see
`style-additions.patch` above). Reused: `mr-sidebar` (shared sidebar shell,
same as pharmacy/patient), `mr-dash-header`/`mr-dash-stats`/`mr-switch`
(header capsules + availability toggle, same as pharmacy dashboard),
`mr-card`/`mr-mini-stat` (status row cards), `mr-map-preview`
(patient `order.php`'s static route placeholder), `mr-badge`/`mr-badge__dot`
(live-tracking badge), `mr-order-row` (manifest queue, same as pharmacy
`orders.php`), `mr-courier-card`/`mr-payment-card` (Cold Chain Alert card,
same gradient composition as patient `order-confirmation.php`'s courier
card), `mr-med-stats`/`__bar`/`__fill` (cargo-temp progress bar, reused from
`pharmacy/earnings.php`'s progress rows), `mr-pharmacy-row` (distance/
earnings summary footer).

## Defects fixed vs. `docs/` mockup

- Dropped the Tailwind CDN/custom theme config — the mockup pulled in an
  unapproved external CSS framework; replaced with the project's own
  `--mr-` token system in `style.css` (only 3 small new rules needed).
- Dropped the mockup's standalone glass side-nav in favor of a new shared
  `sidebar-delivery.php` partial, matching the `sidebar-pharmacy.php`/
  `sidebar-patient.php` pattern exactly (same collapse/toggle/menu/footer
  markup, swapped for delivery nav items — unbuilt items point at `#`,
  same placeholder convention used elsewhere).
- Replaced the mockup's "Route Telemetry" live map image with the project's
  existing static `.mr-map-preview` component — no mapping engine/API
  involved, consistent with the CLAUDE.md constraint against live GPS/
  real-time tracking for now.
- Rebuilt the Manifest Queue with the existing `mr-order-row` component
  instead of the mockup's hand-rolled list markup.
- Rebuilt the Cold Chain Transfer accent card with the existing
  `mr-courier-card`/`mr-payment-card` gradient composition instead of a
  one-off card, and moved its temperature progress bar out of the
  `mr-payment-card__due` flex row (which would have squeezed it in as a
  third flex column) into its own block below — a real layout bug in the
  first draft, fixed before handoff.
- Rebuilt the Weekly Analytics metrics with the existing `mr-med-stats`
  progress-bar rows instead of the mockup's custom metric blocks.
