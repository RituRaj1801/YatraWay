# Mountain Trails — Laravel 11 Tour & Travel Lead Website

A deliberately simple Laravel 11 travel-agency lead-generation website. It is **not** a booking platform. Public users browse three packages and contact the agency by phone, WhatsApp or enquiry form. Enquiries are stored in JSON and managed in a protected admin area.

## Stack
- Laravel 11 / PHP 8.2+
- Blade
- Tailwind CSS + Vite
- Vanilla JavaScript
- Session-based custom admin authentication
- JSON files under `storage/app/data/`
- No database and no migrations required

## Requirements
PHP 8.2+, Composer, Node.js/NPM.

## Installation
```bash
composer install
npm install
cp .env.example .env
php artisan key:generate
npm run build
php artisan serve
```

Configure `.env` before using admin:
```env
ADMIN_EMAIL=admin@example.com
ADMIN_PASSWORD=change-this-password
```

Admin: `/admin/login`

## JSON data
- `storage/app/data/packages.json` — three public packages.
- `storage/app/data/settings.json` — agency/contact/hero settings.
- `storage/app/data/enquiries.json` — submitted enquiries.

The application creates missing JSON files when possible, treats empty JSON as an empty collection, logs invalid JSON/write failures, and uses exclusive file locks for writes.

## Editing business information
Change agency name, phone, WhatsApp, email, address and hero copy in `settings.json`. Change package descriptions, prices, highlights and image paths in `packages.json`.

## Images
Replace:
- `public/images/packages/himachal.jpg`
- `public/images/packages/uttarakhand.jpg`
- `public/images/packages/manali.jpg`
- `public/images/hero.jpg`

with your final licensed destination imagery. Keep the paths unchanged or update `packages.json`.

## Routes
Public: `/`, `/contact`, `POST /contact`.
Admin: `/admin/login`, `/admin/dashboard`, `/admin/enquiries`, `/admin/enquiries/{id}` and delete via `DELETE /admin/enquiries/{id}`.

## Architecture
Controllers depend on services rather than manipulating JSON files directly:
`Controller → Service → JsonDataService → JSON`.

This makes a later replacement of `JsonDataService` with a repository/database implementation possible without changing the public views or controller responsibilities significantly.

## Security
CSRF protection, request validation, session regeneration on login, protected admin routes, `.env` credentials, escaped Blade output, safe JSON filenames, file locking, and controlled application errors are included. Never expose `storage/app/data` through `public/`.
