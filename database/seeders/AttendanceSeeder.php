<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Student;
use App\Models\Subject;

class AttendanceSeeder extends Seeder
{
    public function run(): void
    {
        // =============================================
        // Seed Subjects (Mata Pelajaran per Kelas)
        // =============================================
        Subject::truncate();
        $subjects = [
            // Kelas X RPL 1
            ['name' => 'Pemrograman Dasar',    'code' => 'PD-XRPL1',    'teacher_name' => 'Ir. Bambang Wijaya, S.Kom',  'class_name' => 'X RPL 1',   'class_president' => 'Ahmad Fauzi'],
            ['name' => 'Basis Data',           'code' => 'BD-XRPL1',    'teacher_name' => 'Siti Aminah, M.Pd',          'class_name' => 'X RPL 1',   'class_president' => 'Ahmad Fauzi'],
            ['name' => 'Matematika',           'code' => 'MTK-XRPL1',   'teacher_name' => 'Drs. Ahmad Yusuf, M.Pd',     'class_name' => 'X RPL 1',   'class_president' => 'Ahmad Fauzi'],
            // Kelas X TKJ 1
            ['name' => 'Jaringan Komputer',    'code' => 'JK-XTKJ1',    'teacher_name' => 'Drs. Budi Santoso',          'class_name' => 'X TKJ 1',   'class_president' => 'Rina Agustina'],
            ['name' => 'Sistem Operasi',       'code' => 'SO-XTKJ1',    'teacher_name' => 'Hendra Gunawan, S.T',        'class_name' => 'X TKJ 1',   'class_president' => 'Rina Agustina'],
            // Kelas XI RPL 1
            ['name' => 'Pemrograman Web',      'code' => 'PW-XIRPL1',   'teacher_name' => 'Dewi Kusuma, M.Kom',         'class_name' => 'XI RPL 1',  'class_president' => 'Budi Hartono'],
            ['name' => 'Pemrograman Mobile',   'code' => 'PM-XIRPL1',   'teacher_name' => 'Ir. Bambang Wijaya, S.Kom',  'class_name' => 'XI RPL 1',  'class_president' => 'Budi Hartono'],
            ['name' => 'Bahasa Indonesia',     'code' => 'BIN-XIRPL1',  'teacher_name' => 'Ibu Sari Indah, S.Pd',       'class_name' => 'XI RPL 1',  'class_president' => 'Budi Hartono'],
            // Kelas XII RPL 1
            ['name' => 'Proyek Perangkat Lunak','code'=> 'PPL-XIIRPL1', 'teacher_name' => 'Dewi Kusuma, M.Kom',         'class_name' => 'XII RPL 1', 'class_president' => 'Citra Dewi'],
            ['name' => 'Bahasa Inggris',       'code' => 'ENG-XIIRPL1', 'teacher_name' => 'Mr. John Anderson, M.A',     'class_name' => 'XII RPL 1', 'class_president' => 'Citra Dewi'],
        ];
        foreach ($subjects as $s) {
            Subject::create(array_merge($s, []));
        }

        // =============================================
        // Seed Students (20 per Kelas)
        // =============================================
        Student::truncate();

        $classes = [
            'X RPL 1'   => 'RPL',
            'X TKJ 1'   => 'TKJ',
            'XI RPL 1'  => 'RPL',
            'XII RPL 1' => 'RPL',
        ];

        $maleNames = ['Ahmad Fauzi','Budi Santoso','Eko Prasetyo','Gilang Ramadhan','Irfan Hakim',
                      'Joko Susilo','Muhammad Rizki','Omar Faruq','Qodri Ananda','Sandi Pratama',
                      'Teguh Wibowo','Usman Harun','Vino Pratama','Wahyu Nugroho','Yogi Setiawan'];
        $femaleNames = ['Citra Dewi','Dina Rahayu','Fani Putri','Hana Safitri','Kartika Sari',
                        'Lina Marlina','Nadia Aulia','Putri Anggraini','Rina Agustina','Siti Rahayu',
                        'Tina Wulandari','Ulfa Hasanah','Vivi Andriani','Wulandari','Yeni Susanti'];

        $nisCounter = 1;
        foreach ($classes as $className => $major) {
            $allNames = array_merge($maleNames, $femaleNames);
            shuffle($allNames);
            $classNames = array_slice($allNames, 0, 20);

            foreach ($classNames as $name) {
                Student::create([
                    'nis'        => '2024' . str_pad($nisCounter++, 4, '0', STR_PAD_LEFT),
                    'name'       => $name,
                    'class'      => $className,
                    'major'      => $major,
                    'spp_amount' => 150000,
                ]);
            }
        }

        $this->command->info('Seeder selesai: ' . Subject::count() . ' mata pelajaran, ' . Student::count() . ' siswa.');
    }
}
