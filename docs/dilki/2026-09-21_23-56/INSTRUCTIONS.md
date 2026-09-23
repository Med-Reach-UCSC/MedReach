**Quick start (Windows):** double-click `apply.bat` in this folder — it checks your GitHub login, pulls your `dilki` branch, applies the patches below in order, commits, and pushes automatically. First time doing this? See `docs/README.md`. Manual steps below are the fallback if the script stops partway.

# Handoff: Delivery task details page

**For:** H.K.D. Ishara — Delivery Personnel Module
**Branch:** `dilki`
**From:** Tharusha Gunerathne (Core System Architecture / Admin Module)

## Scope note

Same deal as the last batch — built outside your module (converted from
`docs/delivery-details.php`, the Tailwind mockup dropped into `docs/`) to
get you a working endpoint fast. Presentation-tier only, nothing touches
`business/` or `data/`. Own it from here.

**This batch depends on the previous one** (`docs/dilki/2026-09-21_18-45`,
the rider dashboard). It modifies the `sidebar-delivery.php` that batch
added — `apply.bat` checks that file exists before doing anything, and
fails with a clear message if it doesn't (meaning you need to run the first
batch first).

There's no `style-additions.patch` this time — the page reused existing
components end to end, no new CSS rules needed.

## What's in this batch

| File | Type | Contents |
|---|---|---|
| `details-view.patch` | new file | `presentation/views/delivery/details.php` — the task details page (tapped from a delivery on the dashboard) |
| `details-entrypoint.patch` | new file | `delivery-details.php` (root) thin entry point, same pattern as `delivery-dashboard.php` |
| `sidebar-manifest-link.patch` | update | `presentation/views/partials/sidebar-delivery.php` — points the "Deliveries" nav link at this new page instead of the `#` placeholder |

## If a patch fails

- `details-view.patch` / `details-entrypoint.patch`: these create new
  files, so they only fail if those files already exist on your branch —
  message Tharusha, something's out of sync.
- `sidebar-manifest-link.patch`: fails if you've already changed the
  `'manifest'` line in `sidebar-delivery.php` yourself (e.g. pointed it
  somewhere else while building out your own Deliveries list page). If so,
  just point it at `delivery-details.php` by hand and skip this patch.

## Manual apply (fallback if you're not using `apply.bat`)

```bash
git checkout dilki   # or your working branch
cd MedReach
git apply docs/dilki/2026-09-21_23-56/details-view.patch
git apply docs/dilki/2026-09-21_23-56/details-entrypoint.patch
git apply docs/dilki/2026-09-21_23-56/sidebar-manifest-link.patch
git add presentation/views/delivery/details.php \
        delivery-details.php \
        presentation/views/partials/sidebar-delivery.php
git commit -m "feat(delivery): add task details page"
git push origin dilki
```

## What the page does

The screen a rider lands on after tapping into an active delivery: order
header with an "In Transit" status badge and pharmacy/distance/COD tags, a
route timeline (picked up → in transit → delivered, with the destination
being the patient's home address, not a facility), a cash-to-collect
breakdown, a "Confirm Handover" action that opens a confirmation modal
(checkbox-gated, no backend wiring — that's a `business/`/`data/` task for
later), and a package details grid (weight, handling, payment method,
recipient). Entirely static markup, same as the dashboard batch — no
JS beyond the project's existing generic modal open/close handler, no
backend calls, no live map/GPS.

Continues the fictional data already established in the dashboard batch:
order `#ORD-9921`, "General Hospital Pharmacy", `450 West Ave`, `LKR 4,500`
cash to collect — so the two pages read as the same delivery if you look at
them back to back.

## Reused vs. new

Entirely reused, zero new CSS. `mr-timeline` (the same component
`track-order-status.php` uses for the patient-side delivery timeline),
`mr-order-lines__summary` (the same fee-breakdown rows used on
`track-order-status.php` and `order-confirmation.php`), `mr-courier-card`/
`mr-payment-card`/`mr-confirm-actions` (the payment-status-card-plus-button
pattern from `order-confirmation.php`), `mr-profile-details` (the
label/value grid from `profile.php`), `mr-modal` plus the existing
`data-modal-open`/`data-modal-close` JS in `main.js` (same modal used by
`manage-patients.php` and `profile.php`), `mr-track-title`/`mr-order__tags`
(header layout from `track-order-status.php`), `mr-sidebar` (unchanged,
just one link's `href` updated).

## Defects fixed vs. `docs/` mockup

- Dropped the Tailwind CDN/Google Fonts/inline theme config and the
  standalone glass side-nav for the shared `sidebar-delivery.php` partial.
- Swapped the mockup's USD pricing (`$61.75`, `CUR: USD`) for MedReach's
  LKR/cash-on-delivery model — this project has no online payments, cash on
  delivery only.
- Swapped the mockup's hospital drop-off ("St. Jude Medical Center") for a
  patient home address — MedReach delivers to patients, not facilities.
- Replaced the mockup's hand-rolled JS that manually enabled/disabled the
  confirm button on checkbox change with a native `required` attribute on
  the checkbox (same pattern already used for the sign-up terms checkbox)
  — same result, no JS needed.
- Dropped the mockup's disconnected `TELEMETRY_SYNC` stat grid (distance
  remaining / time elapsed, shown with no source) in favor of the existing
  payment-card + confirm-actions pattern already used for the same "confirm
  and proceed" moment on `order-confirmation.php`.
