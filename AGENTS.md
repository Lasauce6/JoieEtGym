# AGENTS.md - JoieEtGym Development Guide

## Project Overview
**Joie Et Gym** is a Laravel 13 + Filament 4 web application for managing an association's fitness courses, blog content, and member registrations. The project uses Tailwind CSS, Vite for asset bundling, and includes geolocation services for courses.

### Tech Stack
- **Backend:** Laravel 13, PHP 8.3+
- **Admin UI:** Filament 4.0 (admin panel)
- **Frontend:** Blade templates, Tailwind CSS 3.4
- **Database:** MySQL (production), SQLite (testing)
- **Asset Bundling:** Vite 8.0 + laravel-vite-plugin
- **Key Dependencies:** Spatie permissions, Spatie sitemap, Guzzle for HTTP, TinyMCE editor

## Architecture & Data Model

### Core Entity Relationships
```
User (admin-only access)
├── Posts (has_many)
└── Avatar/Profile

Course (main entity with recurring support)
├── Animators (belongs_to_many via animator_course pivot)
├── Parent Course (belongs_to self for recurring patterns)
└── Location with Geocoding (latitude/longitude auto-populated from address)

Post (blog content)
├── Category (belongs_to)
├── User Author (belongs_to)
└── Status workflow: DRAFT → PUBLISHED → ARCHIVED

Category
└── Posts (has_many)

Animator
└── Courses (belongs_to_many)
```

### Recurring Courses Pattern
The `Course` model handles complex recurrence via `getOccurrencesBetween(Carbon $from, Carbon $to)`:
- **Types:** `daily`, `weekly`, `all_week` (Mon-Fri)
- **Data Fields:** `recurrence_days` (array), `recurrence_end` (date), `recurrence_excluded_at`
- **Use Case:** A single recurring course expands into multiple occurrences based on rules
- **Query Pattern:** `scopeOccurringBetween()` efficiently queries both recurring and non-recurring courses

## Developer Workflows

### Build & Development
```bash
# Frontend assets
npm run dev      # Watch mode (Vite)
npm run build    # Production build

# Backend
composer install
php artisan migrate
php artisan tinker  # Interactive shell for debugging

# Admin panel
php artisan filament:upgrade  # Auto-runs on composer update
php artisan filament:cache-components  # Optimize Filament registration
```

### Testing
```bash
php artisan test                          # Run all tests
php artisan test --testsuite=Feature      # Only feature tests
php artisan test tests/Feature/TestName   # Single test
```
- **Config:** `phpunit.xml` defines Feature/Unit test suites
- **Test Setup:** `tests/CreatesApplication.php` provides application bootstrap
- **Database:** Tests use array cache, sync queue; SQLite in-memory DB when enabled

### Data Management
- **Sitemap Generation:** `php artisan app:build-sitemap` (invokes `App\Actions\BuildSitemap`)
- **Database Queries:** Use `artisan tinker` to test scopes and relations

## Key Patterns & Conventions

### Model Lifecycle (Eloquent "booted" Events)
The `Course` model uses `booted()` for auto-geocoding:
```php
protected static function booted(): void {
    static::saved(function (Course $course) {
        // Auto-geocode location on save if latitude/longitude missing
    });
}
```
**Implication:** Model events run synchronously; use `dispatch()` for async geocoding to avoid blocking saves.

### Query Scopes
Models use scopes for common queries:
- `Post::published()` - filters by status=PUBLISHED and published_date ≤ now
- `Course::occurringBetween($from, $to)` - handles recurring course expansion

### Filament Admin Resource Pattern
Each resource lives in `app/Filament/Admin/Resources/` with structure:
```
CourseResource.php          # Main resource definition
CourseResource/
├── Pages/                  # ListPage, CreatePage, EditPage
│   ├── ListCourses.php
│   ├── CreateCourse.php
│   └── EditCourse.php
├── RelationManagers/       # For belongsToMany relations (Animators)
└── Widgets/                # Dashboard widgets
```
**Key Details:**
- Forms use nested `Grid::make(3)` for responsive layouts
- Sections group related fields (e.g., "Planification", "Location")
- Actions (Form Actions) appear as buttons within forms
- Tables use column definitions for listing UI
- Navigation icons use Heroicon library

### Service Layer
**Geocoder Service** (`app/Services/Geocoder.php`):
- Uses OpenStreetMap Nominatim API via Guzzle
- Returns `['lat' => float, 'lon' => float]` or null
- Integrated into `Course::booted()` for automatic coordinate lookup
- **Error Handling:** Catches GuzzleException and logs to Laravel logs

### Post Publishing Workflow
`Post` model uses status constants and scopes:
```php
const STATUS_DRAFT = 'DRAFT';
const STATUS_PUBLISHED = 'PUBLISHED';
const STATUS_ARCHIVED = 'ARCHIVED';

$post->scopePublished()  // where status=PUBLISHED AND published_date ≤ now
```
**Use Pattern:** Always use `Post::published()` for public-facing queries to respect scheduling.

### Storage & URLs
- **Avatar/Photo Storage:** Stored in `public` disk via `Storage::url()` helper
- **Fallback URLs:** UI Avatar API for missing avatars (`ui-avatars.com`)
- **Attribute Accessors:** Models use `getPhotoUrlAttribute()` to expose storage URLs

## Routing & Controllers

### Public Routes (Throttled)
File: `routes/web.php` - All use `throttle:global` middleware:
- `GET /` → `MainController@index`
- `GET /planning` → Shows course calendar
- `GET /load-planning` → Returns JSON events for AJAX
- `GET /news` → Blog listing
- `GET /news/{category}/{slug}` → Individual post with route model binding
- `POST /login` → Uses `throttle:login` (stricter rate limit)

### API Routes
Minimal API (`routes/api.php`):
- `GET /api/user` → Returns authenticated user (requires `auth:sanctum`)

## Important Configuration Files

### `config/filament.php`
- `default_filesystem_disk`: `public` (where uploads go)
- `cache_path`: `bootstrap/cache/filament` (component registration cache)
- Broadcasting disabled by default

### `vite.config.js`
- Refresh paths include `app/Filament/**` for HMR of admin panel
- Includes Filament preset in Tailwind config

### `config/permission.php`
- Uses Spatie Laravel Permission package for roles/permissions
- `canAccessPanel()` method in User checks admin role

## Critical "Why" Decisions

1. **Recurring Courses Architecture:** Rather than duplicating Course rows, a single row with recurrence metadata uses `getOccurrencesBetween()` to expand on-demand. This reduces database size and keeps updates centralized.

2. **Geocoding on Save:** Auto-geocoding in model event keeps geolocation data in sync without requiring manual API calls. Uses dispatch to avoid blocking.

3. **Filament Admin:** Provides CRUD UI generator reducing boilerplate. Forms/tables auto-generate from model fields with minimal configuration.

4. **Separate Migrations Folder Structure:** Multiple migrations handle feature addition over time (permissions, posts, courses, recurring logic).

## Common AI Tasks & Approaches

### Adding a Course Feature
1. Add field to `courses` migration and cast in model
2. Add field to `CourseResource` form/table with appropriate Filament component
3. Update `getOccurrencesBetween()` logic if affecting recurrence
4. Add scope if exposing as query pattern

### Blog Post Addition
1. Create Post record with status=DRAFT
2. Add to Category via relation
3. Set published_date and change status to PUBLISHED
4. Triggers automatic sitemap rebuild (via `BuildSitemap` action)

### Geolocation Updates
1. Editing Course location automatically triggers Geocoder via model event
2. Logs errors to `storage/logs/laravel.log`
3. Test with real addresses or mock Guzzle responses in tests

## Code Quality Tools
- **Linting:** Laravel Pint (configured, not actively enforced)
- **Architecture Rules:** Rector (rector.php) - use `rector process` to apply PHP modernization rules
- **Testing:** PHPUnit with Mockery for mocking external services

## File Organization Quick Reference
```
app/
  Models/             ← Data models + scopes
  Services/           ← Business logic (Geocoder)
  Http/Controllers/   ← Route handlers
  Filament/Admin/     ← Admin UI resources
  Actions/            ← Reusable actions (BuildSitemap)
  Providers/          ← Service registration (AppServiceProvider)
config/              ← App configuration
database/
  migrations/         ← Schema changes
  factories/          ← Test data factories
resources/
  views/              ← Blade templates
  css/                ← Tailwind styles
  js/                 ← Frontend JavaScript
tests/
  Feature/            ← Integration tests
  Unit/               ← Unit tests
routes/
  web.php             ← Public routes
  api.php             ← API routes
public/              ← Static assets, sitemap XML
```

---

**Last Updated:** June 2026 | **Laravel Version:** 13 | **Filament Version:** 4

