<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        // Reset cached roles & permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // =========================================
        // 1. Definisi Semua Permissions
        // =========================================
        $permissions = [
            // Keuangan
            'keuangan.view',
            'keuangan.create',
            'keuangan.edit',
            'keuangan.delete',
            'spp.view',
            'spp.create',
            'spp.edit',

            // Kepegawaian
            'pegawai.view',
            'pegawai.create',
            'pegawai.edit',
            'pegawai.delete',

            // Siswa & Alumni
            'siswa.view',
            'siswa.create',
            'siswa.edit',
            'siswa.delete',
            'alumni.view',

            // Absensi
            'absensi.view',
            'absensi.manage',
            'absensi.qr_generate',

            // Inventaris
            'inventaris.view',
            'inventaris.manage',

            // Dashboard Eksekutif
            'dashboard.view',
            'dashboard.statistik',

            // Berita / Konten
            'berita.view',
            'berita.manage',

            // Pendaftaran PPDB
            'ppdb.view',
            'ppdb.manage',

            // Payroll
            'payroll.view',
            'payroll.process',

            // Pengaturan Sistem
            'system.settings',
            'system.users_manage',
        ];

        foreach ($permissions as $perm) {
            Permission::firstOrCreate(['name' => $perm, 'guard_name' => 'web']);
        }

        // =========================================
        // 2. Definisi Roles & Assignment Permissions
        // =========================================

        // Super Admin: akses semua
        $superAdmin = Role::firstOrCreate(['name' => 'super_admin', 'guard_name' => 'web']);
        $superAdmin->syncPermissions(Permission::all());

        // Yayasan: lihat semua, tapi tidak bisa edit keuangan
        $yayasan = Role::firstOrCreate(['name' => 'yayasan', 'guard_name' => 'web']);
        $yayasan->syncPermissions([
            'keuangan.view', 'spp.view',
            'pegawai.view',
            'siswa.view', 'alumni.view',
            'absensi.view',
            'inventaris.view',
            'dashboard.view', 'dashboard.statistik',
            'berita.view',
            'ppdb.view',
            'payroll.view',
        ]);

        // Bendahara: kelola keuangan penuh
        $bendahara = Role::firstOrCreate(['name' => 'bendahara', 'guard_name' => 'web']);
        $bendahara->syncPermissions([
            'keuangan.view', 'keuangan.create', 'keuangan.edit', 'keuangan.delete',
            'spp.view', 'spp.create', 'spp.edit',
            'siswa.view',
            'dashboard.view',
            'payroll.view', 'payroll.process',
        ]);

        // Guru: kelola absensi dan lihat data siswa
        $guru = Role::firstOrCreate(['name' => 'guru', 'guard_name' => 'web']);
        $guru->syncPermissions([
            'absensi.view', 'absensi.manage', 'absensi.qr_generate',
            'siswa.view',
            'dashboard.view',
            'berita.view',
        ]);

        // Staff / Tata Usaha
        $staff = Role::firstOrCreate(['name' => 'staff', 'guard_name' => 'web']);
        $staff->syncPermissions([
            'siswa.view', 'siswa.create', 'siswa.edit',
            'pegawai.view',
            'inventaris.view', 'inventaris.manage',
            'ppdb.view', 'ppdb.manage',
            'berita.manage',
            'dashboard.view',
        ]);

        // Siswa: akses sangat terbatas
        $siswa = Role::firstOrCreate(['name' => 'siswa', 'guard_name' => 'web']);
        $siswa->syncPermissions([
            'absensi.view',
            'spp.view',
        ]);

        // Orang Tua: lihat data anak
        $orangTua = Role::firstOrCreate(['name' => 'orang_tua', 'guard_name' => 'web']);
        $orangTua->syncPermissions([
            'spp.view',
            'absensi.view',
        ]);

        // =========================================
        // 3. Buat User Default
        // =========================================
        $adminUser = User::firstOrCreate(
            ['email' => 'admin@aladelphi.sch.id'],
            [
                'name'     => 'Super Administrator',
                'password' => Hash::make('Admin@Aladelphi2024'),
                'role'     => 'super_admin',
            ]
        );
        $adminUser->syncRoles(['super_admin']);

        $yayasanUser = User::firstOrCreate(
            ['email' => 'yayasan@aladelphi.sch.id'],
            [
                'name'     => 'Pengawas Yayasan',
                'password' => Hash::make('Yayasan@2024'),
                'role'     => 'yayasan',
            ]
        );
        $yayasanUser->syncRoles(['yayasan']);

        $bendaharaUser = User::firstOrCreate(
            ['email' => 'bendahara@aladelphi.sch.id'],
            [
                'name'     => 'Bendahara Sekolah',
                'password' => Hash::make('Bendahara@2024'),
                'role'     => 'bendahara',
            ]
        );
        $bendaharaUser->syncRoles(['bendahara']);

        $this->command->info('✅ Roles, Permissions & Default Users berhasil dibuat!');
        $this->command->table(
            ['Role', 'Permissions'],
            [
                ['super_admin', 'Semua permissions'],
                ['yayasan',     'View only (semua modul)'],
                ['bendahara',   'Keuangan penuh + Payroll'],
                ['guru',        'Absensi + View Siswa'],
                ['staff',       'Siswa + Inventaris + PPDB + Berita'],
                ['siswa',       'Absensi + SPP (view)'],
                ['orang_tua',   'SPP + Absensi (view)'],
            ]
        );
    }
}
