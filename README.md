
# MedReach

**Automated Prescription Fulfillment and Medicine Delivery System**

SCS2202 — Group Project I · CS Group 12
University of Colombo School of Computing (UCSC)

---

## Overview

MedReach is a web platform for the Sri Lankan market that lets patients upload
prescriptions and have them automatically routed to nearby pharmacies. Instead
of a patient calling pharmacies one by one, MedReach broadcasts each
prescription request to the closest registered pharmacies using a
**proximity-priority routing** engine, with **timed auto-forwarding** when a
pharmacy does not respond in time. It also handles medicine substitution
approvals, split orders across multiple pharmacies, and delivery coordination.

Payment is **cash on delivery only**.

---

## Core Differentiator

Unlike existing Sri Lankan competitors (Flash Health, eChannelling, Carelink.lk,
CFC Healthcare), MedReach implements an **automated proximity-priority broadcast
with timed forwarding**:

- Each item in a multi-item prescription is routed **independently** to the
  nearest registered pharmacy that stocks it.
- There is **no fixed lead pharmacy**.
- If a pharmacy rejects an item or times out, routing **falls back to the
  next-closest** stocking pharmacy for that item.

---

## System Actors

| Actor            | Description                                             |
|------------------|---------------------------------------------------------|
| Patient          | Uploads prescriptions, approves substitutions, orders   |
| Guardian         | Generalization of Patient (manages on another's behalf) |
| Pharmacist       | Accepts/rejects requests, manages stock and orders      |
| Delivery Person  | Accepts and completes delivery tasks                    |
| Admin            | Manages pharmacies, users, and the platform             |

---

## Architecture

MedReach uses a **manually implemented 3-Tier Layered Architecture**
(not MVC). Layered separation was chosen over MVC because MedReach's distinct,
role-based workflows map more naturally to tiers.

```
Presentation Layer  (HTML / CSS / UI)
        │
Business Logic Layer  (PHP)
        │
Data Layer  (MySQL)
```

The folder structure mirrors these tiers directly:

```
MedReach/
├── index.php                     # Application entry point
│
├── presentation/                 # Tier 1 — Presentation Layer
│   ├── assets/
│   │   ├── css/                  # style.css (vanilla CSS only)
│   │   ├── js/                   # main.js
│   │   └── images/
│   └── views/                    # UI files only — no SQL, no business logic
│       ├── layout.php            # Shared <head>, <body> and scripts
│       ├── partials/             # nav, sidebar, modals, auth pieces
│       ├── patient/
│       ├── pharmacy/
│       ├── delivery/
│       └── admin/
│
├── business/                     # Tier 2 — Business Logic Layer
│   ├── auth/                     # Sign in / sign up / email codes
│   ├── patient/
│   ├── pharmacy/
│   ├── delivery/
│   └── admin/
│
├── core/                         # Tier 2 — cross-cutting logic (shared)
│   ├── Router.php                # Request routing (MR_ROUTES)
│   ├── Auth.php                  # Session, CSRF and role guards
│   ├── Mailer.php                # Outgoing email
│   ├── BroadcastManager.php      # Proximity-priority broadcast + timed forwarding
│   └── SubstitutionHandler.php   # Medicine substitution approvals
│
├── data/                         # Tier 3 — Data Layer (DB access only)
│   ├── patient/
│   ├── pharmacy/
│   ├── delivery/
│   └── admin/
│
├── config/
│   └── database.php            # Reads secrets from .env (git-ignored)
│
├── database/
│   ├── medreach.sql              # Schema
│   └── seeds/                    # Seed data
│
└── docs/                         # Project documentation
```

### Layer rules (all members follow)

- **`presentation/views/`** — only `.php` files that output HTML. No SQL, no
  business decisions.
- **`business/`** — PHP that applies rules and processes data; calls `core/`
  and `data/`.
- **`core/`** — cross-module logic (broadcast routing, substitution) used by
  multiple modules. Sits in Tier 2.
- **`data/`** — only database queries. No HTML output, no business decisions.

### Adding a page

1. Create the view in `presentation/views/<role>/`. Start it with
   `<?php $title = 'Page — MedReach'; $active = '<sidebar key>'; ?>` and
   write only what goes inside `<body>`. Add `$bodyClass` or
   `$charts = true` when needed.
2. Add one line to `MR_ROUTES` in `core/Router.php`:
   `'page-name' => ['<role>', '<role>/<view>']`. The URL is `page-name.php`.
3. If the page handles a form, add a function in `business/<role>/` that
   returns the flash message and name it as the third route value.

---

## Tech Stack

| Layer         | Technology                          |
|---------------|-------------------------------------|
| Frontend      | HTML5, CSS3 (vanilla — no UI frameworks) |
| Backend       | PHP                                 |
| Database      | MySQL                               |
| Dev Tools     | GitHub, VS Code / PhpStorm, XAMPP / WAMP |
| Collaboration | Google Meet, Google Docs, ClickUp, Google Drive |

### External APIs & Libraries

Approved:

- **Chart.js** — dashboard analytics (bundled in `presentation/assets/js/vendor/`)

Pending supervisor approval:

- **Resend** — sign-up and password-reset emails. Leave `RESEND_API_KEY` empty
  until approved; codes are then written to the PHP error log instead of sent.
- **OpenStreetMap + Leaflet.js** — pharmacy location maps
- **Firebase Cloud Messaging** — push notifications
- **Cloudinary** — prescription image storage
- **jsPDF** — order record export

Icons are from [Icons8](https://icons8.com) and stored locally in
`presentation/assets/images/icons/`.

---

## Scope Constraints

- No frameworks or libraries without explicit supervisor approval
- No live GPS tracking (out of scope)
- No online or insurance payments — **cash on delivery only**
- No lab reports (out of scope)

---

## Team & Workload

| Member                  | Module / Responsibility                                              |
|-------------------------|---------------------------------------------------------------------|
| E.D.T.N. Gunarathne     | Core System Architecture & Intelligent Routing Engine, Guardian extendability, Admin Module |
| K.P.A.S.D. Kariyawasam  | Pharmacy Management Module (UI + Backend)                            |
| R.A.D.T.S. Rupasinghe   | Patient Portal Module (UI + Backend)                                |
| H.K.D. Ishara           | Delivery Personnel Module (UI + Backend)                            |

Shared by all members: requirement gathering, testing (unit, integration,
bug fixing), and maintenance.

### Branching

Each member works on their own feature branch and merges into `main` via
pull request:

- `feature/admin-core-module`
- `feature/pharmacy-module`
- `feature/patient-module`
- `feature/delivery-module`

Do **not** commit directly to `main`.

---

## Local Setup

1. Clone the repository:
   ```bash
   git clone git@github.com:Med-Reach-UCSC/MedReach.git
   cd MedReach
   ```

2. Create the database and import the schema:
   ```bash
   mysql -u root -p -e "CREATE DATABASE medreach;"
   mysql -u root -p medreach < database/medreach.sql
   ```

3. Configure database credentials:
   ```bash
   cp .env.example .env
   # edit .env with your local MySQL credentials
   ```
   `.env` is git-ignored and must never be committed.

4. Serve the project with your local PHP + MySQL stack (XAMPP / WAMP, or a
   native LAMP setup) and open `index.php` in the browser.

---

## Timeline

**June 2026 – February 2027** (academic year project)

---

## License

Academic project — University of Colombo School of Computing.

