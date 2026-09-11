<?php

namespace Tests\Feature;

use App\Models\Basispengetahuan;
use App\Models\Gejala;
use App\Models\Jawaban;
use App\Models\Penyakit;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

class UpgradeSmokeTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Seed explicitly rather than via $seed. RefreshDatabase only runs the
     * $seed hook for whichever test class happens to trigger the one-time
     * migration, so relying on it makes this class order-dependent.
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->seed(\Database\Seeders\DatabaseSeeder::class);
    }

    private function admin(): User
    {
        return User::where('email', 'admin@gmail.com')->firstOrFail();
    }

    private function user(): User
    {
        return User::where('email', 'user@gmail.com')->firstOrFail();
    }

    public function test_seeders_run(): void
    {
        $this->assertSame(2, \App\Models\Role::count());
        $this->assertSame(9, Gejala::count());
        $this->assertSame(9, Penyakit::count());
        $this->assertSame(27, Basispengetahuan::count());
    }

    public function test_login_redirects_admin_and_user_by_role(): void
    {
        $this->post('/login', ['email' => 'admin@gmail.com', 'password' => '1234'])
            ->assertRedirect('/admin/dashboard');
        $this->post('/logout');

        $this->post('/login', ['email' => 'user@gmail.com', 'password' => '1234'])
            ->assertRedirect('/user/dashboard');
    }

    #[DataProvider('adminPages')]
    public function test_admin_pages_render(string $uri): void
    {
        $this->actingAs($this->admin())->get($uri)->assertOk();
    }

    public static function adminPages(): array
    {
        return [
            ['/admin/dashboard'],
            ['/admin/basis_pengetahuan'],
            ['/admin/rule'],
            ['/admin/user'],
            ['/admin/gejala'],
            ['/admin/penyakit'],
        ];
    }

    #[DataProvider('userPages')]
    public function test_user_pages_render(string $uri): void
    {
        $this->actingAs($this->user())->get($uri)->assertOk();
    }

    public static function userPages(): array
    {
        return [
            ['/user/dashboard'],
            ['/user/caramerawat'],
            ['/user/pengenalan'],
            ['/user/morph'],
            ['/user/penyakitpengobatan'],
            ['/user/deteksi'],
        ];
    }

    #[DataProvider('dataTableEndpoints')]
    public function test_datatables_ajax_endpoints(string $uri): void
    {
        $response = $this->actingAs($this->admin())
            ->get($uri, ['X-Requested-With' => 'XMLHttpRequest']);

        $response->assertOk();
        $json = $response->json();
        $this->assertArrayHasKey('data', $json);
        $this->assertArrayHasKey('recordsTotal', $json);
        $this->assertNotEmpty($json['data']);
        $this->assertArrayHasKey('action', $json['data'][0]);
        $this->assertArrayHasKey('DT_RowIndex', $json['data'][0]);
        $this->assertStringContainsString('<button', $json['data'][0]['action']);
    }

    public static function dataTableEndpoints(): array
    {
        return [
            ['/admin/gejala'],
            ['/admin/penyakit'],
            ['/admin/basis_pengetahuan'],
        ];
    }

    public function test_role_gate_blocks_cross_role_access(): void
    {
        $this->actingAs($this->user())->get('/admin/dashboard')->assertNotFound();
        $this->actingAs($this->admin())->get('/user/dashboard')->assertNotFound();
    }

    public function test_admin_can_create_gejala_with_generated_kode(): void
    {
        $this->actingAs($this->admin())
            ->post('/admin/gejala', ['name' => 'Gejala Baru Uji'])
            ->assertRedirect(route('adm.master.gejala'));

        $created = Gejala::latest('id')->first();
        $this->assertSame('G10', $created->kode);
        $this->assertSame('gejala baru uji', $created->getRawOriginal('name'));
        $this->assertSame('Gejala baru uji', $created->name);
    }

    public function test_admin_can_create_penyakit_with_generated_kode(): void
    {
        $this->actingAs($this->admin())
            ->post('/admin/penyakit', ['name' => 'Penyakit Baru Uji'])
            ->assertRedirect(route('adm.master.penyakit'));

        $this->assertSame('P10', Penyakit::latest('id')->first()->kode);
    }

    public function test_admin_can_create_basis_pengetahuan_and_duplicates_are_rejected(): void
    {
        $before = Basispengetahuan::count();

        $this->actingAs($this->admin())
            ->post('/admin/basis_pengetahuan', ['penyakit_id' => 9, 'gejala_id' => 1])
            ->assertRedirect(route('adm.basispengetahuan'));
        $this->assertSame($before + 1, Basispengetahuan::count());

        $this->actingAs($this->admin())
            ->post('/admin/basis_pengetahuan', ['penyakit_id' => 9, 'gejala_id' => 1])
            ->assertRedirect(route('adm.basispengetahuan'));
        $this->assertSame($before + 1, Basispengetahuan::count());
    }

    public function test_admin_user_crud(): void
    {
        $admin = $this->admin();

        $this->actingAs($admin)->post('/admin/user', [
            'name' => 'Pengguna Uji',
            'email' => 'uji@example.com',
            'password' => 'rahasia',
        ])->assertRedirect(route('adm.master.user'));

        $created = User::where('email', 'uji@example.com')->firstOrFail();
        $this->assertSame(3, (int) $created->role_id);
        $this->assertSame(1, (int) $created->status);

        $this->actingAs($admin)->patch('/admin/user', [
            'user_id' => $created->id,
            'name' => 'Pengguna Uji Diubah',
            'email' => 'uji@example.com',
        ])->assertRedirect(route('adm.master.user'));
        $this->assertSame('Pengguna Uji Diubah', $created->fresh()->name);

        $this->actingAs($admin)->delete('/admin/user', ['user_id' => $created->id])
            ->assertRedirect(route('adm.master.user'));
        $this->assertNull(User::find($created->id));
    }

    public function test_admin_user_validation_errors_use_named_bags(): void
    {
        $this->actingAs($this->admin())
            ->post('/admin/user', ['name' => '', 'email' => 'bukan-email', 'password' => 'x'])
            ->assertSessionHasErrors(['name', 'email', 'password'], null, 'tambah');
    }

    public function test_deteksi_answer_flow(): void
    {
        $user = $this->user();

        $this->actingAs($user)->get('/user/deteksi')->assertOk();

        $basis = Basispengetahuan::firstOrFail();
        $this->actingAs($user)
            ->post('/user/deteksi', ['jawaban' => 1, 'basis_id' => $basis->id])
            ->assertRedirect(route('user.deteksi'));

        $jawaban = Jawaban::where('user_id', $user->id)->firstOrFail();
        $this->assertSame($basis->kode, $jawaban->kode);
        $this->assertSame($basis->id, (int) $jawaban->basispengetahuan_id);
        $this->assertNotNull($jawaban->basis->gejala);

        $this->actingAs($user)->get('/user/deteksi/ulangi')
            ->assertRedirect(route('user.deteksi'));
        $this->assertSame(0, Jawaban::where('user_id', $user->id)->count());
    }

    public function test_guest_is_redirected_to_login(): void
    {
        $this->get('/admin/dashboard')->assertRedirect(route('login'));
        $this->get('/user/dashboard')->assertRedirect(route('login'));
        $this->get('/')->assertRedirect('/login');
    }

    public function test_sanctum_api_route_rejects_guests(): void
    {
        $this->getJson('/api/user')->assertUnauthorized();
    }
}
