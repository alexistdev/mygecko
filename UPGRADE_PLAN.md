# Laravel 9 → 12 Upgrade Plan — MyGecko

Repository: `alexistdev/mygecko`
Plan authored during Phase 1 (repository audit). No application files were modified to produce it.

---

## 1. Current environment

| Item | Value |
| --- | --- |
| Laravel (locked) | `laravel/framework v9.52.17` |
| Laravel (declared) | `^9.19` |
| PHP requirement (composer.json) | `^8.1` |
| PHP on this machine | 8.4.23 (Laravel Herd, NTS) |
| Composer | 2.10.2 |
| Node / npm | 25.6.1 / 11.9.0 |
| `vendor/` installed | no |
| `node_modules/` installed | no |
| `.env` present | no (only `.env.example`) |
| Current branch | `chore/bump-min-php-8.1` (clean tree) |
| Symfony components (locked) | 6.4.x |
| Monolog (locked) | 2.10.0 |
| Carbon (locked) | 2.72.5 |
| PHPUnit (locked) | 9.6.9 |

Application structure is the **classic Laravel 9 skeleton**: `app/Http/Kernel.php`, `app/Console/Kernel.php`,
`app/Exceptions/Handler.php`, five providers in `app/Providers`, providers registered through `config/app.php`,
and a `bootstrap/app.php` that returns the application instance.

## 2. Target

| Item | Target |
| --- | --- |
| Laravel | `^12.0` |
| PHP requirement | `^8.2` (framework floor for Laravel 12) |
| Application structure | **unchanged** — classic skeleton retained |
| Symfony | 7.2+ (pulled transitively) |
| Monolog | 3.x |
| Carbon | 3.x |
| PHPUnit | 11.x |

Laravel 12 still supports the Laravel 10-style skeleton. `Illuminate\Foundation\Http\Kernel`,
`Illuminate\Routing\Controller::middleware()`, `config/app.php` provider discovery and the old
`bootstrap/app.php` are all present in the 12.x branch, so the migration to the "slim" Laravel 11
structure is **not required** and will not be performed.

---

## 3. Composer dependency map

### Production

| Package | Current | Target | Notes |
| --- | --- | --- | --- |
| `laravel/framework` | `^9.19` | `^12.0` | primary upgrade |
| `laravel/sanctum` | `^2.14.1` | `^4.0` | v3 for L10, v4 for L11/12 |
| `laravel/tinker` | `^2.7` | `^2.9` | 2.11 already spans L6–L12 |
| `guzzlehttp/guzzle` | `^7.2` | `^7.8` | framework floor is `^7.8.2` |
| `jeroennoten/laravel-adminlte` | `^3.15` | `^3.16` | v3.16 declares `laravel/framework >=8.0`; keeps AdminLTE **3** assets and the `vendor/adminlte` asset paths the Blade views use. v4 would swap in AdminLTE 4/Bootstrap 5 and break every view — **not** taken. |
| `mckenziearts/laravel-notify` | `^2.4` | `^2.7` | v2.7 allows `illuminate/support ^12.0`. v3 requires PHP `^8.3` and changes the API — **not** taken. |
| `yajra/laravel-datatables` | `^9.0` | `^12.0` | metapackage; v12 tracks Laravel 12 |
| `yajra/laravel-datatables-oracle` | `^10.0` | `^12.0` | provides `Yajra\DataTables\DataTables` used by five controllers |

### Development

| Package | Current | Target | Notes |
| --- | --- | --- | --- |
| `phpunit/phpunit` | `^9.5.10` | `^11.5.3` | requires `phpunit.xml` schema migration |
| `nunomaduro/collision` | `^6.1` | `^8.6` | v7 for L10, v8 for L11/12 |
| `spatie/laravel-ignition` | `^1.0` | `^2.9` | v2 supports L10–L12 |
| `laravel/breeze` | `^1.10` | `^2.0` | scaffolding installer only; views are already published |
| `laravel/sail` | `^1.0.1` | `^1.41` | already spans L9–L13 |
| `mockery/mockery` | `^1.4.4` | `^1.6` | no constraint issue |
| `fakerphp/faker` | `^1.9.1` | `^1.23` | no constraint issue |

### Abandoned / blocked packages

* **`laravelcollective/html v6.4.1` — abandoned, and hard-capped at `illuminate/* ^10.0`.**
  It is not a direct dependency; it is pulled in by `yajra/laravel-datatables-html v9`.
  This is the single package that would block Laravel 11 and 12.
  `yajra/laravel-datatables-html v11+` dropped the dependency entirely, so bumping the yajra
  metapackage removes it with no code change on our side. No replacement package is needed —
  the application never calls `Form::` or `Html::`.

No other locked package is marked abandoned.

### Version-by-version blockers

| Blocks | Package | Reason |
| --- | --- | --- |
| Laravel 10 | `laravel/sanctum ^2`, `nunomaduro/collision ^6`, `spatie/laravel-ignition ^1`, `mckenziearts/laravel-notify ^2.4` | each caps at `^9.0` |
| Laravel 11 | `laravelcollective/html` (via `yajra/…-html v9/v10`), `laravel/sanctum ^3`, `mckenziearts/laravel-notify ^2.5` | cap at `^10.0` |
| Laravel 12 | `mckenziearts/laravel-notify ^2.6`, `yajra/…-oracle ^11` | cap at `^11.0` |

---

## 4. Laravel 9 → 10 breaking changes that affect this project

| Change | Affects this app? | Action |
| --- | --- | --- |
| PHP floor raised to 8.1 | already `^8.1` | none |
| Minimum stability / dependency bumps (Symfony 6.2, Monolog 3) | transitively | `composer update` |
| `$routeMiddleware` renamed to `$middlewareAliases` on the HTTP kernel | yes — `app/Http/Kernel.php` uses `$routeMiddleware` | rename the property (old name still read, but deprecated) |
| Language files moved to `lang/` at project root | already done in L9 | none |
| Redis cache tags behaviour | not used | none |
| `Illuminate\Database\Query\Expression` is no longer `Stringable` | no `DB::raw` / `Expression` use anywhere | none |
| Model `$dates` property deprecated | not used (`$casts` already used for `email_verified_at`) | none |
| `Str::ucfirst` / date-handling changes | not used | none |
| Rate limiter callbacks must return `Limit` objects | `RouteServiceProvider::configureRateLimiting()` already returns `Limit::perMinute(...)` | none |
| Service mocking / `getMockForAbstractClass` | no mocks in the test suite | none |
| `dispatchNow` removed | not used | none |
| PHPUnit 10 required; `processUncoveredFiles` removed from the coverage schema | yes — `phpunit.xml` uses it | rewrite `phpunit.xml` to the PHPUnit 10/11 schema |

## 5. Laravel 10 → 11 breaking changes that affect this project

| Change | Affects this app? | Action |
| --- | --- | --- |
| PHP floor raised to 8.2 | `composer.json` says `^8.1` | raise to `^8.2` |
| New slim application structure | **optional for existing apps** | keep the existing structure |
| `config/app.php` `providers` array still honoured alongside `bootstrap/providers.php` | yes | none |
| `Illuminate\Routing\Controller::middleware()` | all 12 feature controllers call `$this->middleware(...)` in their constructors | verified present in 12.x — **no change** |
| `Authenticate::redirectTo()` now type-hints `Request` | `app/Http/Middleware/Authenticate.php` overrides it with an untyped parameter | contravariant, therefore legal — no change |
| `TrustHosts` gained an `Application` constructor argument | our subclass overrides only `hosts()`, and the middleware is commented out of the global stack | none |
| `VerifyCsrfToken` renamed to `ValidateCsrfToken` (old class kept as a deprecated subclass) | our middleware and `config/sanctum.php` reference the old name | keep working; align `config/sanctum.php` with the Sanctum 4 defaults |
| `password_resets` renamed to `password_reset_tokens` in new skeletons | **schema change, not a framework requirement** — `config/auth.php` points at `password_resets` | leave the table and config alone |
| Sanctum 3+ expects an `expires_at` column on `personal_access_tokens` | the 2019 migration predates it | add a **new additive** migration; no existing column is touched |
| Carbon 2 → 3 | seeders use `Carbon::now()->format()` only | none |
| HTTP client / validation behaviour changes | no custom HTTP client or validator extensions | none |
| Horizon / Telescope / Livewire / Jetstream / Passport | **not installed** | none |
| Queue and scheduler config | scheduler is empty, queue is `sync`, `failed` driver `database-uuids` | none |

## 6. Laravel 11 → 12 breaking changes that affect this project

Laravel 12 is a maintenance-focused release. The items relevant here:

| Change | Affects this app? | Action |
| --- | --- | --- |
| PHP floor stays 8.2 | no | none |
| Carbon 3 is now mandatory (`nesbot/carbon ^3.8.4`) | seeders only | none |
| `laravel/serializable-closure` 2.x | transitive | none |
| Multi-schema database inspection changes | no `Schema::` inspection code | none |
| Container / concrete-binding edge cases | no custom container bindings | none |
| Nested array request validation | validation rules are all flat | none |
| Image validation no longer accepts SVG by default | no `image` rule anywhere | none |
| PHPUnit 11 / Pest 3 | PHPUnit only | bump PHPUnit |
| Starter kits replaced | Breeze views already published and customised (`auth/login2.blade.php`) | **do not** swap starter kits |

---

## 7. Files that must change

| File | Why |
| --- | --- |
| `composer.json` | PHP floor `^8.2`, framework `^12.0`, all dependency constraints above |
| `composer.lock` | regenerated by `composer update` |
| `phpunit.xml` | PHPUnit 10/11 schema: drop `processUncoveredFiles`, move `<coverage><include>` to `<source>`, add `cacheDirectory` |
| `app/Http/Kernel.php` | `$routeMiddleware` → `$middlewareAliases` (one property rename; the alias map itself is unchanged) |
| `config/sanctum.php` | Sanctum 4 configuration keys |
| `database/migrations/<new>_add_expires_at_to_personal_access_tokens_table.php` | new additive migration required by Sanctum 3+ |
| `UPGRADE_PLAN.md`, `UPGRADE_NOTES.md` | documentation |

## 8. Files that must NOT change

* All 18 controllers under `app/Http/Controllers` — including the constructor `$this->middleware(...)` pattern.
* All 6 models, their `Attribute` accessors/mutators, `$fillable`, `$guarded`, and the `User::hasRole()` role logic.
* `app/Http/Middleware/CekRole.php` and the `['roles' => 'admin']` route-group attribute convention.
* `app/Http/Helpers/Bantuan.php` (`kode` generation for penyakit / gejala / rule).
* `routes/web.php`, `routes/api.php`, `routes/auth.php`, `routes/channels.php`, `routes/console.php`.
* Every existing migration, and therefore the live database schema — in particular `password_resets`,
  which stays under its current name.
* All seeders, all Blade views, all `app/View/Components`.
* `bootstrap/app.php`, `public/index.php`, `artisan` — the classic bootstrap is retained.
* `config/auth.php` (`'table' => 'password_resets'`), `config/adminlte.php`, `config/datatables.php`, `config/notify.php`.
* `.env.example` — no secret or credential is touched.
* `package.json`, `vite.config.js`, `tailwind.config.js`, `postcss.config.js` — the frontend is
  already on Vite 8 with `laravel-vite-plugin` 3.1 (peer range `vite ^8.0.0`) and is unaffected by
  the PHP-side upgrade.

## 9. Regression risks

| Risk | Severity | Mitigation |
| --- | --- | --- |
| `yajra/datatables` v9 → v12 spans three majors; `DataTables::of()` on an Eloquent builder vs a Collection behaves slightly differently across versions | **high** — five admin screens depend on it | v12 still ships `DataTables::of()`, `addIndexColumn()`, `editColumn()`, `addColumn()`, `rawColumns()`, `make()`. Exercise each admin list endpoint with an AJAX request after the upgrade. |
| `GejalaController` / `PenyakitController` pass `collect($model)->sortDesc()` (a Collection) into `DataTables::of()` | medium | v12 routes Collections through `CollectionDataTable`; verify ordering and the rendered `action` column. |
| `mckenziearts/laravel-notify` 2.4 → 2.7: `notify()`, `@notifyCss`, `@notifyJs`, `notify::components.notify` | medium | all four are still present in 2.7; verify a flash message renders on an admin create/update. |
| `jeroennoten/laravel-adminlte` 3.15 → 3.16 republishes `public/vendor/adminlte` | medium | `public/vendor` is gitignored; assets must be re-published on deploy (`vendor:publish --tag=adminlte-assets`). Views reference `asset('vendor/adminlte/...')`, which is unchanged in the 3.x line. |
| Sanctum 2 → 4 on an old `personal_access_tokens` table | medium | additive `expires_at` migration; the app only uses the default `auth:sanctum` `/api/user` route. |
| Monolog 2 → 3 changes log record shape for custom processors/formatters | low | `config/logging.php` uses stock channels only. |
| Carbon 2 → 3 stricter parsing | low | only `Carbon::now()->format()` in seeders, and `->format()` on model timestamps in DataTables callbacks. |
| PHPUnit 9 → 11 removes `assertDeprecated`-era APIs and doc-comment metadata | low | the suite uses plain `test_*` methods. |
| `Deteksi::index()` reads `$kode` on a code path where it may be undefined | **pre-existing**, unrelated to the upgrade | flagged, not modified; PHP 8.2+ raises a warning rather than a fatal. |

## 10. Testing strategy

The existing suite is thin: 7 test files, all Breeze auth scaffolding plus two stubs. There are **no**
tests covering the actual business domain (penyakit, gejala, basis pengetahuan, rule, deteksi, role
gating). This is the principal limitation of this migration and is recorded as such.

1. **Baseline.** Install the current lockfile and run the suite on Laravel 9 *before* touching
   anything, so that any post-upgrade failure can be attributed correctly.
2. **After each major version** (10, then 11, then 12):
   * `composer update` with the narrowest constraint change that reaches the target
   * `php artisan about`, `optimize:clear`, `config:clear`, `cache:clear`, `view:clear`
   * `php artisan route:list` — all 28 routes must resolve
   * `php artisan test`
3. **Database.** A throwaway local SQLite database is used for `migrate` verification.
   `migrate:fresh`, `db:wipe` and every other destructive command are out of scope; no production
   database is contacted.
4. **Static checks.** The project has no PHPStan/Larastan/Psalm/Pint configuration. Rather than
   installing a new toolchain, compatibility is checked with `php -l` across the tree plus
   container-level smoke tests (route resolution, controller instantiation, view compilation).
5. **Frontend.** `npm install` and `npm run build` to confirm the Vite pipeline is unaffected.
6. **Security.** `composer audit` after the final upgrade.
7. **Manual verification checklist** (cannot be automated here — no seeded database or browser session):
   login → role redirect (admin/user), each admin DataTable AJAX endpoint, each admin create form,
   user delete, and the `deteksi` question/answer flow.
