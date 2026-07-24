# Rental Management System

A boarding house / rental management system built with **Laravel** and **MySQL**, developed as a portfolio project under [DarkFrame Studio](https://Vinco2025.github.io).

## Features
- Role-based access control (Admin, Tenant) via Spatie Laravel Permission
- Room management (types, status, availability)
- Tenant management and lease contracts
- Monthly billing and utility tracking
- Maintenance request system
- Admin dashboard with reports

## Tech Stack
- **Backend:** Laravel, PHP
- **Database:** MySQL
- **Frontend:** Blade, Tailwind CSS
- **Auth:** Laravel Breeze

## Setup Instructions

1. Clone the repository
```bash
   git clone https://github.com/Vinco2025/rental-management-system.git
```
2. Install dependencies
```bash
   composer install
   npm install
```
3. Copy `.env.example` to `.env` and configure your database
```bash
   cp .env.example .env
   php artisan key:generate
```
4. Run migrations and seeders
```bash
   php artisan migrate --seed
```
5. Start the development server
```bash
   npm run dev
```

## Status
🚧 In active development