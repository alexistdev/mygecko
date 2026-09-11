# Laravel 9 → 12 Migration Notes — MyGecko

Branch: `upgrade/laravel-12` (based on `chore/bump-min-php-8.1`)
Companion document: [`UPGRADE_PLAN.md`](UPGRADE_PLAN.md) (the Phase 1 audit)

---

## Migration summary

The application was upgraded in place, one major version at a time, with a full
verification pass between each step. The classic Laravel 9 application skeleton was
**kept throughout** — `app/Http/Kernel.php`, `app/Console/Kernel.php`,
`app/Exceptions/Handler.php`, the five providers in `app/Providers`, provider
registration through `config/app.php`, and the `bootstrap/app.php` that returns the
application instance. Laravel 12 still supports all of it, so the slim Laravel 11
structure was not adopted.

| Step | Framework | Result |
| --- | --- | --- |
| Laravel 9 → 10 | `v9.52.17` → `v10.50.3` | 42 routes, 14 passed / 3 failed |
| Laravel 10 → 11 | `v10.50.3` → `11.x` (reports `11.56.1`) | 42 routes, 14 passed / 3 failed |
| Laravel 11 → 12 | `11.x` → `v12.69.2` | 42 routes, 40 passed / 3 failed |

The three failures are identical at every step and identical to the pre-upgrade
Laravel 9 baseline. They are explained under **Tests** below.

### A note on the Laravel 11 step

Composer's advisory policy refuses to load packages covered by an unpatched security
advisory. Laravel 11 is end of life, so **every stable 11.x tag is affected** and
Composer fell back to the `11.x` maintenance branch. Laravel 11 was only ever a transit
state here; Laravel 12 resolves to `v12.69.2`, a patched tag, and `composer audit` on
the final state reports nothing. No advisory was ignored and
`--ignore-platform-reqs` was never used at any point.

---

## PHP

| | Version |
| --- | --- |
| Previous requirement | `^8.1` |
| Required by Laravel 12 | `^8.2` |
| Declared now | `^8.2` |
| Used for this migration | 8.4.23 (Laravel Herd, NTS) |

Composer 2.10.2. Node 25.6.1 / npm 11.9.0.

---

## Composer

### Production

| Package | Before | After | Installed |
| --- | --- | --- | --- |
| `laravel/framework` | `^9.19` | `^12.0` | `v12.69.2` |
| `laravel/sanctum` | `^2.14.1` | `^4.0` | `v4.3.3` |
| `laravel/tinker` | `^2.7` | `^2.10` | `v2.11.1` |
| `guzzlehttp/guzzle` | `^7.2` | `^7.8` | `7.15.5` |
| `jeroennoten/laravel-adminlte` | `^3.15` | `^3.16` | `v3.16.0` |
| `mckenziearts/laravel-notify` | `^2.4` | `^2.7` | `v2.7` |
| `yajra/laravel-datatables-oracle` | `^10.0` | `^12.0` | `v12.7.2` |
| `yajra/laravel-datatables` | `^9.0` | **removed** | — |

### Development

| Package | Before | After | Installed |
| --- | --- | --- | --- |
| `phpunit/phpunit` | `^9.5.10` | `^11.5.3` | `11.5.56` |
| `nunomaduro/collision` | `^6.1` | `^8.6` | `v8.9.5` |
| `spatie/laravel-ignition` | `^1.0` | `^2.9` | `2.12.0` |
| `laravel/breeze` | `^1.10` | `^2.0` | `v2.4.2` |
| `laravel/sail` | `^1.0.1` | `^1.41` | `v1.67.0` |
| `mockery/mockery` | `^1.4.4` | `^1.6` | `1.6.15` |
| `fakerphp/faker` | `^1.9.1` | `^1.23` | `v1.24.1` |

### Transitive changes worth knowing about

Symfony 6.4 → 7.4, Monolog 2 → 3, Carbon 2 → 3, `laravel/serializable-closure` 1 → 2.
Nothing in the application touches the parts of those libraries that changed:
`config/logging.php` uses stock channels with no custom processor or formatter, and
the only Carbon calls are `Carbon::now()->format()` in the seeders plus `->format()`
on Eloquent timestamps inside DataTables callbacks.

### Packages removed, and why

`yajra/laravel-datatables` is a metapackage bundling `-oracle`, `-html`, `-buttons`,
`-editor`, `-fractal` and `-export`. The application imports exactly one class from
it, `Yajra\DataTables\DataTables`, which lives in `-oracle`; nothing references the
other five. On the Laravel 10-and-newer line the metapackage additionally pulls
`-export`, which drags **Livewire, PhpSpreadsheet and OpenSpout** into production and
registers four `livewire/*` routes that did not exist on Laravel 9. Requiring
`-oracle` directly keeps all five admin DataTables working identically with a much
smaller installed tree.

Dropping it also removed **`laravelcollective/html`**, which is abandoned and capped at
`illuminate/* ^10.0`. It arrived through `yajra/laravel-datatables-html` and was the
single hard blocker for Laravel 11 and 12. The application never called `Form::` or
`Html::`, so no replacement was needed.

`composer audit` on the final state finds no advisories, and no package in the
lockfile is marked abandoned.

---

## Application changes

Six files changed in total, plus two new files. Every controller, model, route file,
Blade view, seeder, existing migration, view component, helper and middleware is
untouched.

### `composer.json` / `composer.lock`
Dependency constraints as tabulated above, and the PHP floor raised from `^8.1` to
`^8.2`.

### `app/Http/Kernel.php`
* **Reason:** Laravel 10 renamed the HTTP kernel's middleware alias property.
* **Old:** `protected $routeMiddleware = [...]`
* **New:** `protected $middlewareAliases = [...]`
* The alias map itself is byte-for-byte unchanged, including the application's own
  `'roles' => \App\Http\Middleware\CekRole::class`. Laravel 12 still reads
  `$routeMiddleware` as a deprecated fallback, so this is forward-looking rather than
  strictly required.

### `phpunit.xml`
* **Reason:** PHPUnit 10 removed the `processUncoveredFiles` attribute and moved
  coverage source declaration out of `<coverage>`; PHPUnit 10 refuses to start against
  the old schema.
* **Old:** `<coverage processUncoveredFiles="true"><include>…</include></coverage>`
* **New:** `<source><include>…</include></source>`
* Every `<env>` value and both test suites are unchanged, including the commented-out
  `DB_CONNECTION`/`DB_DATABASE` lines.

### `config/sanctum.php`
* **Reason:** Sanctum 4 renamed a middleware config key and added two settings.
* **Old:** a `middleware` array with `verify_csrf_token` and `encrypt_cookies`.
* **New:** `authenticate_session`, `encrypt_cookies` and `validate_csrf_token`, plus a
  `token_prefix` setting.
* The application's own `App\Http\Middleware\EncryptCookies` and
  `App\Http\Middleware\VerifyCsrfToken` subclasses stay wired in, so their `$except`
  lists keep applying. Sanctum 4 does fall back from `validate_csrf_token` to the old
  `verify_csrf_token` key, but `authenticate_session` had no fallback and was silently
  dropping session authentication for stateful requests.
* `stateful`, `guard` and `expiration` are unchanged.

### `database/migrations/2026_09_11_000000_add_expires_at_to_personal_access_tokens_table.php` (new)
* **Reason:** Sanctum 3 introduced an `expires_at` column on `personal_access_tokens`
  and Sanctum 4 writes it on every `createToken()` call. This project's
  `personal_access_tokens` migration dates from 2019 and predates the column, so token
  creation would fail with an unknown-column error.
* **Old behavior:** reads worked (a missing attribute reads as null, which Sanctum
  treats as "never expires"), but `createToken()` would have failed.
* **New behavior:** the nullable column exists and Sanctum 4 behaves as designed.
* The migration is purely additive, guarded by a `Schema::hasColumn` check, and touches
  no existing column or row. No other migration was edited.

### `database/factories/UserFactory.php`
* **Reason:** the `users` table declares `role_id` and `status` `NOT NULL` with no
  default, but the factory never set them, so every test that created a user died on an
  integrity-constraint violation. On Laravel 9 the suite was 15 failed / 2 passed,
  which left no signal to migrate against.
* **Old:** definition without `role_id` or `status`.
* **New:** `'role_id' => 2` (the "user" role seeded by `RoleSeeder`) and `'status' => 1`.
* Factories are test-only; no seeder uses this factory and no application behavior
  changes. This was committed **before** the upgrade began so that before-and-after
  comparisons are meaningful.

### `tests/Feature/UpgradeSmokeTest.php` (new)
Covers the business domain the existing suite never touched. See **Tests** below.

### Deliberately unchanged
`bootstrap/app.php`, `public/index.php`, `artisan`, all 18 controllers (including the
constructor `$this->middleware(...)` pattern, which `Illuminate\Routing\Controller`
still supports in Laravel 12), all 6 models, `app/Http/Middleware/CekRole.php`, the
`['roles' => 'admin']` route-group convention, `app/Http/Helpers/Bantuan.php`, every
route file, every Blade view, every view component, every seeder, every pre-existing
migration, `config/auth.php` (the password broker still points at `password_resets`),
`config/adminlte.php`, `config/datatables.php`, `config/notify.php`, `.env.example`,
and the entire frontend toolchain.

---

## Breaking changes that actually affected this application

| Laravel | Change | How it was handled |
| --- | --- | --- |
| 10 | `$routeMiddleware` renamed to `$middlewareAliases` | property renamed in `app/Http/Kernel.php` |
| 10 | PHPUnit 10 required; coverage schema changed | `phpunit.xml` rewritten to the new schema |
| 10 | Sanctum 2 capped at Laravel 9 | bumped to Sanctum 3, then 4 |
| 11 | PHP floor raised to 8.2 | `"php": "^8.2"` |
| 11 | `laravelcollective/html` capped at Laravel 10 | removed with the yajra metapackage |
| 11 | Sanctum 4 middleware config keys | `config/sanctum.php` updated |
| 11 | Sanctum 3+ expects `expires_at` on `personal_access_tokens` | additive migration |
| 12 | PHPUnit 11 | bumped, `phpunit.xml` schema already compatible |

Breaking changes that were checked and found **not** to apply: the Laravel 11 slim
application structure (optional for existing apps), `Query\Expression` no longer being
`Stringable` (no `DB::raw` anywhere), the Model `$dates` property (unused — `$casts` was
already in use), Redis cache tags, rate limiter return values (already returning
`Limit` objects), the `lang/` directory move (already done under Laravel 9), the
`password_resets` → `password_reset_tokens` rename (a new-skeleton convention, not a
framework requirement — the table and `config/auth.php` were left alone), `dispatchNow`,
Monolog 3 record shape, Carbon 3 parsing, multi-schema database inspection, nested array
validation, and the Laravel 12 image-validation SVG change. Horizon, Telescope,
Livewire, Jetstream, Passport and Pest are not installed.

`Authenticate::redirectTo()` gained a `Request` type hint in the framework; the
application's subclass declares the parameter untyped, which is contravariant and
therefore legal. No change was needed.

---

## Tests

| | Laravel 9 baseline | Laravel 12 final |
| --- | --- | --- |
| Passed | 14 | 40 |
| Failed | 3 | 3 |
| Assertions | 25 | 112 |

Command: `php artisan test`.

### The 3 failures, all pre-existing

They fail identically on Laravel 9 and Laravel 12 and are unrelated to the upgrade.
None of them was "fixed", because each would have meant changing application behavior
or rewriting a test to match it — both outside the scope of a migration.

1. **`ExampleTest > the application returns a successful response`** — asserts `GET /`
   returns 200, but `routes/web.php` has `Route::redirect('/', '/login')`, so it returns
   302. The stock Breeze stub was never updated for this application's routing.
2. **`AuthenticationTest > users can authenticate using the login screen`** — asserts a
   redirect to `RouteServiceProvider::HOME` (`/dashboard`), but
   `AuthenticatedSessionController::store()` deliberately redirects by role, sending
   role 2 to `/user/dashboard`. The application is correct; the stub test is stale.
3. **`RegistrationTest > new users can register`** — a genuine pre-existing application
   bug. `RegisteredUserController::store()` calls `User::create()` without `role_id` or
   `status`, and both are `NOT NULL` without a default, so public registration fails
   with an integrity-constraint violation. This is unrelated to the framework version
   and is listed under **Recommended next steps**.

### New coverage

`tests/Feature/UpgradeSmokeTest.php` — 26 tests, 87 assertions — exercises what the
existing suite never did:

* role-based login redirect for both admin and user
* all 6 admin pages and all 6 user pages render
* the 3 DataTables AJAX endpoints, including the JSON envelope, `DT_RowIndex`, and the
  rendered `action` button markup
* the `roles` middleware gate in both directions (user blocked from admin, admin
  blocked from user)
* `Bantuan` kode generation for gejala (`G10`) and penyakit (`P10`)
* duplicate rejection on basis pengetahuan
* admin user create, update and delete
* named validation error bags (`tambah`, `edit`, `hapus`)
* the `Gejala`/`Penyakit` `Attribute` accessor and mutator pair (stored lowercase, read
  back capitalised)
* the deteksi answer-and-reset flow including the `basis` → `gejala` eager chain
* guest redirects and the Sanctum-guarded `/api/user` route

**All 26 were replayed against the Laravel 9 baseline in a separate git worktree and
pass identically there.** They therefore record existing behavior rather than asserting
new behavior, which is what makes them a valid regression check for this migration.

### Other verification performed

* `php artisan about` on each version
* `php artisan optimize`, `optimize:clear`, `config:clear`, `cache:clear`, `view:clear`
* `php artisan route:list` — 42 routes at every step, matching Laravel 9 exactly
* `php artisan view:cache` — every Blade template compiles under Laravel 12
* `php artisan migrate` against a throwaway local SQLite database
* `php artisan db:show` — connection and 10 tables
* `php -l` across the whole tree excluding `vendor/` and `node_modules/`
* `composer validate`, a clean `composer install` from the lockfile, and `composer audit`
* `npm install` and `npm run build`

No destructive database command was run. `migrate:fresh` and `db:wipe` were never
invoked outside PHPUnit's own `RefreshDatabase` on the throwaway SQLite file. No
production database was contacted. `.env` does not exist in the repository and
`.env.example` was not modified; a local `.env` was created for verification and is
gitignored, as is the SQLite file.

---

## Static analysis

The project has no PHPStan, Larastan, Psalm, Pint or PHP-CS-Fixer configuration and no
such package in `composer.json`. Per the brief, no new static analysis toolchain was
installed for the migration. What was checked instead:

* `php -l` on every PHP file outside `vendor/` and `node_modules/` — clean
* Blade compilation of all 39 views via `php artisan view:cache` — clean
* a grep sweep for removed and deprecated Laravel, Symfony and PHP APIs — no hits
* container-level verification through the smoke test, which instantiates every
  controller, middleware, model and view component on a real request

`.styleci.yml` is present and configures StyleCI with the `laravel` preset. It runs
on the hosted service, not locally, and was not modified.

---

## Frontend

No change was required. The frontend had already been carried forward by Dependabot and
is internally consistent: Vite 8.0.12 with `laravel-vite-plugin` 3.1.0, whose peer range
is `vite ^8.0.0`. Tailwind 3, PostCSS 8, Alpine 3, Axios 1.18 and Lodash 4 are all
unaffected by the PHP-side upgrade. `package.json`, `vite.config.js`,
`tailwind.config.js` and `postcss.config.js` were not touched.

`npm install` and `npm run build` both succeed on Laravel 12.

One observation, pre-existing and not a regression: `tailwind.config.js` lists
`./storage/framework/views/*.php` in its `content` globs, so the generated CSS changes
size depending on whether the Blade view cache happens to be populated when the build
runs (23.8 kB with a cleared cache, 39.8 kB with a warm one). Run `php artisan
view:clear` before `npm run build` if you want reproducible output.

---

## Remaining issues and things that could not be verified

1. **No browser or UI test exists**, so the following were verified only at the HTTP
   and JSON level, not visually. Worth a manual pass before deploying:
   * AdminLTE 3 styling and layout on the admin screens
   * `laravel-notify` toast rendering (`@notifyCss`, `@notifyJs`,
     `@include('notify::components.notify')`). The controllers' `notify()` calls all
     execute without error and the redirects land correctly, but the rendered toast was
     not seen.
   * client-side DataTables initialisation and the jQuery plugin bundle under
     `public/adminlte/` and `public/vendor/adminlte/`
2. **AdminLTE assets must be re-published on deploy.** `public/vendor` is gitignored, and
   `jeroennoten/laravel-adminlte` moved from v3.15.3 to v3.16.0. Run
   `php artisan vendor:publish --tag=adminlte-assets --force` as part of deployment. The
   `vendor/adminlte/...` paths the Blade views use are unchanged within the 3.x line.
   Note that some views reference `adminlte/...` without the `vendor/` prefix
   (`components/admin/js-layout.blade.php`, and one image in `sidebar-layout.blade.php`);
   those point at a separate copy under `public/adminlte/` that this migration did not
   touch.
3. **MySQL was not exercised.** `.env.example` targets MySQL, but verification ran
   against SQLite so that no real database was involved. The schema uses only portable
   constructs — `id()`, `foreignId()->constrained()`, `string`, `tinyInteger`,
   `timestamp`, `rememberToken`, `morphs` — and there is no raw SQL, no `DB::raw` and no
   database-specific column type anywhere, so the risk is low. Still, run
   `php artisan migrate` against a MySQL copy of production before deploying.
4. **The `personal_access_tokens.expires_at` migration has not run in production.** It is
   additive and guarded, but it is a schema change and needs a normal deployment
   migration run.
5. **Laravel 13 exists.** `laravel/framework` is pinned to `^12.0` as instructed, so
   Composer will not drift onto it.

---

## Recommended next steps (deliberately kept out of this migration)

These are real findings, none of them required for Laravel 12, and none were acted on
because each changes application behavior.

1. **Public registration is broken.** `RegisteredUserController::store()` creates a user
   without `role_id` or `status`, both `NOT NULL` without a default, so
   `POST /register` fails with an integrity-constraint violation. This predates the
   upgrade. Either set a default role on creation, or give the columns database
   defaults, or remove the registration routes if self-registration is not wanted.
2. **`Deteksi::index()` can read an undefined `$kode`.** When `$cekJawaban` is empty the
   method takes the `else` branch that sets `$selesai = 1` without ever assigning
   `$kode`; if `$selesai` were ever not 1 on that path, `$kode` would be undefined. The
   current control flow makes it unreachable, but it is fragile.
3. **Two stale Breeze test stubs** (`ExampleTest` and the authentication redirect
   assertion) encode behaviour this application deliberately does not have. Updating
   them to match the real routing would take the suite to fully green.
4. **`User::hasRole()` writes to a model attribute.** It assigns `$this->have_role`,
   which Eloquent stores as an attribute rather than a plain property. It is never
   persisted on the current code paths, but a `save()` on a user after a role check
   would attempt to write a non-existent `have_role` column.
5. **Consider `laravel/pint`** for formatting. The repo already declares the `laravel`
   preset via `.styleci.yml`, so Pint would apply the same rules locally.
6. **AdminLTE 4** (`jeroennoten/laravel-adminlte ^4.0`) is available and explicitly
   supports Laravel 12, but it moves to AdminLTE 4 and Bootstrap 5 and would require
   reworking every admin view. The 3.x line was kept for exactly that reason.
