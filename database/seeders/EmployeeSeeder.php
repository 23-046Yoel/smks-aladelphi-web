<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Employee;
use Illuminate\Support\Facades\DB;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Kosongkan tabel sebelum mengisi data baru (optional)
        DB::table('employees')->truncate();

        $employees = [
            [
                'nip' => '197501012000011001',
                'name' => 'Dr. H. Ahmad Fauzi, M.Pd',
                'position' => 'Kepala Sekolah',
                'subject' => 'Manajemen Pendidikan',
                'employee_type' => 'guru',
                'education' => 'S3 Teknologi Pendidikan',
                'email' => 'ahmad.fauzi@aladelphi.sch.id',
                'phone' => '081234567890',
                'status' => 'aktif',
            ],
            [
                'nip' => '198005122005022002',
                'name' => 'Siti Aminah, S.Pd., M.Si',
                'position' => 'Wakil Kepala Sekolah Bidang Kurikulum',
                'subject' => 'Bahasa Indonesia',
                'employee_type' => 'guru',
                'education' => 'S2 Linguistik',
                'email' => 'siti.aminah@aladelphi.sch.id',
                'phone' => '081234567891',
                'status' => 'aktif',
            ],
            [
                'nip' => '198203152008011003',
                'name' => 'Budi Santoso, S.T',
                'position' => 'Wakil Kepala Sekolah Bidang Kesiswaan',
                'subject' => 'Produktif TKJ',
                'employee_type' => 'guru',
                'education' => 'S1 Teknik Informatika',
                'email' => 'budi.santoso@aladelphi.sch.id',
                'phone' => '081234567892',
                'status' => 'aktif',
            ],
            [
                'nip' => '198507202010012004',
                'name' => 'Dewi Lestari, S.Pd',
                'position' => 'Guru Mata Pelajaran',
                'subject' => 'Bahasa Inggris',
                'employee_type' => 'guru',
                'education' => 'S1 Pendidikan Bahasa Inggris',
                'email' => 'dewi.lestari@aladelphi.sch.id',
                'phone' => '081234567893',
                'status' => 'aktif',
            ],
            [
                'nip' => '198811112015011005',
                'name' => 'Rian Hidayat, S.Pd',
                'position' => 'Guru Mata Pelajaran',
                'subject' => 'Matematika',
                'employee_type' => 'guru',
                'education' => 'S1 Pendidikan Matematika',
                'email' => 'rian.hidayat@aladelphi.sch.id',
                'phone' => '081234567894',
                'status' => 'aktif',
            ],
            [
                'nip' => '199002252018022006',
                'name' => 'Lutfi Hakim, S.Kom',
                'position' => 'Kepala Lab Komputer',
                'subject' => 'Pemrograman Web',
                'employee_type' => 'guru',
                'education' => 'S1 Sistem Informasi',
                'email' => 'lutfi.hakim@aladelphi.sch.id',
                'phone' => '081234567895',
                'status' => 'aktif',
            ],
            [
                'nip' => '197809302003012007',
                'name' => 'Ani Wijaya, S.E',
                'position' => 'Bendahara Sekolah',
                'subject' => null,
                'employee_type' => 'staff',
                'education' => 'S1 Akuntansi',
                'email' => 'ani.wijaya@aladelphi.sch.id',
                'phone' => '081234567896',
                'status' => 'aktif',
            ],
            [
                'nip' => '199205142020011008',
                'name' => 'Rizky Pratama, A.Md',
                'position' => 'Staf Tata Usaha',
                'subject' => null,
                'employee_type' => 'tata_usaha',
                'education' => 'D3 Administrasi Perkantoran',
                'email' => 'rizky.pratama@aladelphi.sch.id',
                'phone' => '081234567897',
                'status' => 'aktif',
            ],
            [
                'nip' => '198408102012012009',
                'name' => 'Hj. Maryam, S.Ag',
                'position' => 'Guru Mata Pelajaran',
                'subject' => 'Pendidikan Agama Islam',
                'employee_type' => 'guru',
                'education' => 'S1 Pendidikan Agama',
                'email' => 'maryam@aladelphi.sch.id',
                'phone' => '081234567898',
                'status' => 'aktif',
            ],
            [
                'nip' => '199512302022011010',
                'name' => 'Fajar Sidik, S.Pd',
                'position' => 'Guru Mata Pelajaran',
                'subject' => 'PJOK',
                'employee_type' => 'guru',
                'education' => 'S1 Pendidikan Olahraga',
                'email' => 'fajar.sidik@aladelphi.sch.id',
                'phone' => '081234567899',
                'status' => 'aktif',
            ],
        ];

        foreach ($employees as $employee) {
            Employee::create($employee);
        }
    }
}
