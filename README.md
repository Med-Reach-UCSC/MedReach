# MedReach
Automated Prescription Fulfillment and Medicine Delivery System  
SCS2202 | CS Group 12 | University of Colombo School of Computing

## Team
- K.P.A.S.D. Kariyawasam — Pharmacy Module
- R.A.D.T.S. Rupasinghe — Patient Portal Module
- H.K.D. Ishara — Delivery Personnel Module
- E.D.T.N. Gunarathne — Admin Module + Core System

## Architecture
Manually implemented 3-Tier Layered Architecture
- presentation/ — HTML/CSS/UI (Tier 1)
- business/     — PHP Logic (Tier 2)
- core/         — Cross-cutting system logic (Tier 2)
- data/         — DB access only (Tier 3)

## Stack
HTML5, CSS3, PHP, MySQL

## Setup
1. Clone the repo
2. Import `database/medreach.sql` into your local MySQL
3. Copy `config/db.php.example` to `config/db.php` and fill in credentials
4. Serve via XAMPP/WAMP pointing to project root
