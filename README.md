# 🏠 Boarding House Rental Management System

A full-featured boarding house management system built with **Laravel 12** as a portfolio project. Covers the complete rental lifecycle — from room setup and tenant onboarding through lease contracts, billing, maintenance requests, and monthly reporting.

---

## ✨ Features

### 🛏️ Room & Room Type Management
- Define room types with base pricing and descriptions
- Manage individual rooms with amenities (stored as JSON), floor, and status
- Room status (`available` / `occupied`) flips automatically when a lease is created or deleted
- Inline status toggle directly from the room list

### 👤 Tenant Management
- Admin-only tenant registration — no public sign-up
- Auto-generates login credentials (username + password) on tenant creation, flashed as a one-time alert
- Full tenant profile: contact info, emergency contact, move-in date

### 📄 Lease Contracts
- Link tenants to rooms with start/end dates and monthly rate
- Active, expired, and terminated lease statuses
- Automatically marks room as occupied on contract creation; releases it on deletion

### 💳 Billing & Payments
- Generate monthly bills from all active leases in one action
- Bills cover rent, electricity, and water (electricity/water default to 0 and are updated after meter readings)
- Record partial or full payments against any bill
- `recalculate()` method on the `Bill` model auto-updates balance and status (`unpaid` → `partial` → `paid`) after every payment change
- Remove payments and balances recalculate automatically

### 🔧 Maintenance Requests
- Tenants submit requests through their own portal; admins manage all requests
- Priority levels: low, medium, high, urgent
- Status workflow: open → in progress → resolved
- `resolved_at` timestamp auto-stamped when status flips to resolved; cleared if moved back
- Tracks who submitted each request (admin or tenant)

### 📊 Dashboard & Reports
- Admin dashboard with 8 live stat cards: occupancy rate, available rooms, active tenants, open maintenance, outstanding balance, collections this month, unpaid bills, and resolved requests
- Occupancy progress bar
- Recent activity panels: latest leases, payments, and maintenance requests
- Monthly reports filterable by month and year
- Report covers billing detail with totals, payment breakdown by method, maintenance summary, and active lease snapshot
- **PDF export** — downloads a fully formatted A4 report via `barryvdh/laravel-dompdf`

### 🔐 Role-Based Access
- Powered by **Spatie Laravel Permission**
- `admin` role: full access to all modules
- `tenant` role: scoped portal — submit and track their own maintenance requests only
- Separate sidebar layouts for admin and tenant portals
- Post-login redirect sends admins to the dashboard and tenants to their maintenance portal

---

## 🛠️ Tech Stack

| Layer | Technology |
|---|---|
| Framework | Laravel 12 |
| PHP | 8.2.12 |
| Frontend | Laravel Breeze (Blade) + Tailwind CSS |
| Auth & Roles | Spatie Laravel Permission |
| Database | MySQL (via XAMPP) |
| PDF Export | barryvdh/laravel-dompdf |
| Icons | Tabler Icons (CDN) |
| Dev Environment | XAMPP, VS Code, Windows |

---

## 🎨 UI Theme

A warm, consistent color palette used throughout all views via pure inline styles:

| Role | Color |
|---|---|
| Headings & Sidebar | Walnut Brown `#3D2314` |
| Buttons & Accents | Terracotta `#C2622A` |
| Page Background | Warm Cream `#FDF8F4` |
| Secondary Text | Soft Tan `#7A5542` |
| Borders & Cards | Warm Border `#E8DDD4` |

---

## 🚀 Installation

### Prerequisites
- PHP 8.2+
- Composer
- MySQL (XAMPP or equivalent)
- Node.js & npm

### Steps

```bash
# 1. Clone the repository
git clone https://github.com/Vinco2025/rental-management-system.git
cd rental-management-system

# 2. Install PHP dependencies
composer install

# 3. Install Node dependencies and build assets
npm install && npm run build

# 4. Copy and configure environment
cp .env.example .env
php artisan key:generate

# 5. Create the database
# In phpMyAdmin (or MySQL CLI), create a database named: rental_db
# Collation: utf8mb4_unicode_ci

# 6. Update .env with your database credentials
DB_DATABASE=rental_db
DB_USERNAME=root
DB_PASSWORD=

# 7. Run migrations and seed the admin account
php artisan migrate --seed

# 8. Serve the application
php artisan serve
```

Visit `http://localhost:8000` and log in with the credentials created by `AdminSeeder`.

---

## 📁 Project Structure

```
app/
├── Http/Controllers/
│   ├── Admin/
│   │   ├── DashboardController.php
│   │   ├── ReportController.php
│   │   ├── RoomTypeController.php
│   │   ├── RoomController.php
│   │   ├── TenantController.php
│   │   ├── LeaseContractController.php
│   │   ├── BillController.php
│   │   ├── PaymentController.php
│   │   └── MaintenanceRequestController.php
│   └── Tenant/
│       └── MaintenanceRequestController.php
├── Models/
│   ├── RoomType.php
│   ├── Room.php
│   ├── Tenant.php
│   ├── LeaseContract.php
│   ├── Bill.php
│   ├── MaintenanceRequest.php
│   └── User.php
resources/
├── views/
│   ├── layouts/
│   │   ├── admin.blade.php
│   │   └── tenant.blade.php
│   ├── admin/
│   │   ├── dashboard.blade.php
│   │   ├── room_types/
│   │   ├── rooms/
│   │   ├── tenants/
│   │   ├── lease_contracts/
│   │   ├── bills/
│   │   ├── maintenance_requests/
│   │   └── reports/
│   └── tenant/
│       └── maintenance_requests/
```

---

## 🗺️ Development Phases

| Phase | Module | Status |
|---|---|---|
| 1 | Laravel Setup, Breeze, Spatie, Seeder | ✅ Done |
| 2 | Room Types | ✅ Done |
| 3 | Room Management | ✅ Done |
| 4 | Tenant Management | ✅ Done |
| 5 | Lease Contracts | ✅ Done |
| — | UI Redesign (Warm Theme) | ✅ Done |
| 6 | Billing & Payments | ✅ Done |
| 7 | Maintenance Requests | ✅ Done |
| 8 | Dashboard & Reports + PDF Export | ✅ Done |

---

## 📝 Notable Implementation Details

- **Spatie middleware** must be manually registered in `bootstrap/app.php` in Laravel 12 — not auto-registered
- **Delete forms are always placed outside edit forms** to prevent `_method=DELETE` from overriding `_method=PUT`
- **Enum column changes** use `DB::statement` instead of the `Schema` facade (MySQL limitation)
- **Bill `recalculate()`** centralizes all balance and status logic — called after every payment create or delete
- **PDF template** uses `display: table` layout and `DejaVu Sans` font (DomPDF doesn't support Flexbox/Grid; `DejaVu Sans` is required for the ₱ peso sign)
- **Amenities** are stored as JSON on the `rooms` table and cast via `$casts` on the model
- **Tenant portal** is fully scoped — tenants can only see and act on their own data; `abort(403)` guards prevent URL-guessing

---

## 📄 License

This project is open source and available under the [MIT License](LICENSE).
