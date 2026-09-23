**Quick start (Windows):** double-click `apply.bat` in this folder — it checks your GitHub login, pulls your `dilki` branch, applies the patches below in order, commits, and pushes automatically. First time doing this? See `docs/README.md`. Manual steps below are the fallback if the script stops partway.

# Handoff: Delivery earnings page

**For:** H.K.D. Ishara — Delivery Personnel Module
**Branch:** `dilki`
**From:** Tharusha Gunerathne (Core System Architecture / Admin Module)

## Scope note

Same deal as the last two batches — built outside your module (converted
from `docs/delivery-earnings.php`, the Tailwind mockup dropped into
`docs/`) to get you a working endpoint fast. Presentation-tier only,
nothing touches `business/` or `data/`. Own it from here.

**This batch depends on the previous one** (`docs/dilki/2026-09-21_23-56`,
the task details page, which itself depends on `2026-09-21_18-45`, the
rider dashboard). `sidebar-earnings-link.patch`'s context includes the
`'manifest'` line that batch changed to `delivery-details.php` — `apply.bat`
checks `sidebar-delivery.php` exists before doing anything, and the patch
itself will fail to apply if you haven't run that batch yet.

There's no `style-additions.patch` this time — the page reused existing
components end to end, no new CSS rules needed.

## What's in this batch

| File | Type | Contents |
|---|---|---|
| `earnings-view.patch` | new file | `presentation/views/delivery/earnings.php` — the earnings & payouts page |
| `earnings-entrypoint.patch` | new file | `delivery-earnings.php` (root) thin entry point, same pattern as `delivery-dashboard.php` / `delivery-details.php` |
| `sidebar-earnings-link.patch` | update | `presentation/views/partials/sidebar-delivery.php` — points the "Earnings" nav link at this new page instead of the `#` placeholder |

## If a patch fails

- `earnings-view.patch` / `earnings-entrypoint.patch`: these create new
  files, so they only fail if those files already exist on your branch —
  message Tharusha, something's out of sync.
- `sidebar-earnings-link.patch`: fails if you've already changed the
  `'earnings'` line in `sidebar-delivery.php` yourself (e.g. pointed it
  somewhere else while building out your own earnings page), or if the two
  prior batches haven't been applied yet (its context includes the
  `'manifest'` line, which only reads `delivery-details.php` after
  `2026-09-21_23-56` is applied). If it's the former, just point
  `'earnings'` at `delivery-earnings.php` by hand and skip this patch.

## Manual apply (fallback if you're not using `apply.bat`)

```bash
git checkout dilki   # or your working branch
cd MedReach
git apply docs/dilki/2026-09-22_00-10/earnings-view.patch
git apply docs/dilki/2026-09-22_00-10/earnings-entrypoint.patch
git apply docs/dilki/2026-09-22_00-10/sidebar-earnings-link.patch
git add presentation/views/delivery/earnings.php \
        delivery-earnings.php \
        presentation/views/partials/sidebar-delivery.php
git commit -m "feat(delivery): add earnings page"
git push origin dilki
```

## What the page does

A rider's earnings & payout screen: header capsules for Today/Week/Month
totals, a completed-deliveries ledger table (order id, date, pharmacy, fee,
status) with pagination, a revenue-trend chart, a weekly-target progress
ring with a "Cash out summary" action, a top-pharmacies-serviced bar list,
and a delivery-metrics card (best day, average per delivery, active time).
Entirely static markup, same as the dashboard and details batches — no
backend wiring, no live payment processing (cash on delivery only, per
project scope).

## Reused vs. new

Entirely reused, zero new CSS or JS. `mr-dash-stats` (header capsules,
same as the dashboard's "Deliveries today"/"On-time rate" pair — just a
third stat added, the component already supports it), `mr-pay-table` +
`mr-pagination` (payments.php's ledger table), `mr-spend-ring` +
`mr-spend-row` and its Chart.js canvas ids (`mr-earnings-trend-chart` /
`mr-earnings-target-chart` — the exact same ids `pharmacy/earnings.php`
already wires up in `main.js`, so no new chart config was needed at all),
`mr-med-stats` bars (order-history.php's "most ordered" widget, reused by
`pharmacy/earnings.php` for "Top earning medicines"), `mr-pharmacy-row`
(the same label/value leader row `dashboard.php` uses for "Total
Distance"), `mr-sidebar` (unchanged, just one link's `href` updated).

## Defects fixed vs. `docs/` mockup

- Dropped the Tailwind CDN/Google Fonts/inline theme config and the
  standalone glass side-nav for the shared `sidebar-delivery.php` partial.
- Replaced the hand-coded inline-SVG progress ring and CSS
  bar-placeholder chart with the project's existing Chart.js spend-ring
  and trend-chart patterns — same canvas ids `pharmacy/earnings.php`
  already uses, so the existing `main.js` init code drives this page too.
- Replaced the mockup's fabricated order-id/pharmacy pairings with ones
  consistent with `dashboard.php`'s manifest queue (`CarePlus Pharma`,
  `MediTrust LK`, `City Health Pharmacy`), so the pages read as the same
  rider's data if you look at them together.
- Swapped the mockup's plain `<h2>` under a bare `<div>` for the project's
  `mr-dash-card`/`mr-dash-card__head` wrapper in the metrics card — a bare
  `<h2>` has no styling of its own outside that wrapper (or `mr-med-stats`,
  which sets its own).
