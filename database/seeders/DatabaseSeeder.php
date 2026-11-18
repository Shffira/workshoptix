<?php

namespace Database\Seeders;

use App\Models\Registration;
use App\Models\User;
use App\Models\Workshop;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create admin user
        $admin = User::create([
            'name' => 'Admin WorkshopTix',
            'email' => 'admin@workshoptix.com',
            'password' => Hash::make('password'),
            'is_admin' => true,
            'phone' => '081234567890',
        ]);

        // Create regular user
        $user = User::create([
            'name' => 'John Doe',
            'email' => 'user@workshoptix.com',
            'password' => Hash::make('password'),
            'phone' => '089876543210',
        ]);

        // Create workshops
        $workshops = [
            [
                'title' => 'Web Development dengan Laravel 13',
                'slug' => 'web-development-dengan-laravel-13',
                'description' => 'Workshop intensif selama satu hari penuh mempelajari pengembangan web modern menggunakan Laravel 13. Peserta akan belajar membuat aplikasi web dari nol hingga siap produksi. Materi mencakup routing, Eloquent ORM, Blade templating, authentication, dan deployment.',
                'speaker' => 'Budi Santoso, S.Kom',
                'location' => 'Lab Komputer A, Gedung Teknik Lt. 2',
                'start_at' => now()->addDays(7)->setHour(8)->setMinute(0),
                'end_at' => now()->addDays(7)->setHour(17)->setMinute(0),
                'quota' => 30,
                'price' => 150000,
                'category' => 'Web Development',
                'is_active' => true,
            ],
            [
                'title' => 'Machine Learning dengan Python',
                'slug' => 'machine-learning-dengan-python',
                'description' => 'Pengenalan machine learning menggunakan Python dan library populer seperti scikit-learn, pandas, dan matplotlib. Peserta akan mempraktikkan berbagai algoritma klasifikasi dan regresi dengan dataset nyata.',
                'speaker' => 'Dr. Rina Kusuma',
                'location' => 'Aula Utama Gedung B',
                'start_at' => now()->addDays(14)->setHour(9)->setMinute(0),
                'end_at' => now()->addDays(14)->setHour(16)->setMinute(0),
                'quota' => 25,
                'price' => 200000,
                'category' => 'Data Science',
                'is_active' => true,
            ],
            [
                'title' => 'UI/UX Design dengan Figma',
                'slug' => 'uiux-design-dengan-figma',
                'description' => 'Workshop desain antarmuka dan pengalaman pengguna menggunakan Figma. Peserta belajar prinsip desain, wireframing, prototyping, dan kolaborasi desain secara profesional.',
                'speaker' => 'Anisa Putri, S.Ds',
                'location' => 'Ruang Multimedia, Gedung C',
                'start_at' => now()->addDays(21)->setHour(8)->setMinute(30),
                'end_at' => now()->addDays(21)->setHour(15)->setMinute(30),
                'quota' => 20,
                'price' => 125000,
                'category' => 'Design',
                'is_active' => true,
            ],
            [
                'title' => 'Cybersecurity & Ethical Hacking',
                'slug' => 'cybersecurity-ethical-hacking',
                'description' => 'Workshop keamanan siber dan ethical hacking untuk pemula. Pelajari dasar-dasar keamanan jaringan, pengujian penetrasi, dan cara melindungi sistem dari ancaman siber.',
                'speaker' => 'Irfan Hadi, CEH',
                'location' => 'Lab Jaringan, Gedung Teknik Lt. 3',
                'start_at' => now()->addDays(28)->setHour(8)->setMinute(0),
                'end_at' => now()->addDays(28)->setHour(17)->setMinute(0),
                'quota' => 15,
                'price' => 250000,
                'category' => 'Cybersecurity',
                'is_active' => true,
            ],
            [
                'title' => 'Mobile App Development dengan Flutter',
                'slug' => 'mobile-app-development-flutter',
                'description' => 'Belajar membuat aplikasi mobile cross-platform menggunakan Flutter dan Dart. Workshop ini mencakup widget dasar, state management, integrasi API, dan publikasi ke Play Store.',
                'speaker' => 'Dian Pramono, S.T',
                'location' => 'Lab Komputer B, Gedung Teknik Lt. 2',
                'start_at' => now()->addDays(35)->setHour(8)->setMinute(0),
                'end_at' => now()->addDays(35)->setHour(17)->setMinute(0),
                'quota' => 25,
                'price' => 175000,
                'category' => 'Mobile Development',
                'is_active' => true,
            ],
            [
                'title' => 'DevOps & Docker untuk Pemula',
                'slug' => 'devops-docker-untuk-pemula',
                'description' => 'Pengenalan DevOps dan containerization menggunakan Docker. Peserta akan belajar membuat Dockerfile, docker-compose, CI/CD pipeline dasar, dan deployment ke cloud.',
                'speaker' => 'Fajar Nugroho',
                'location' => 'Aula Utama Gedung B',
                'start_at' => now()->addDays(42)->setHour(9)->setMinute(0),
                'end_at' => now()->addDays(42)->setHour(16)->setMinute(0),
                'quota' => 20,
                'price' => 180000,
                'category' => 'DevOps',
                'is_active' => true,
            ],
        ];

        foreach ($workshops as $workshopData) {
            Workshop::create($workshopData);
        }

        // Create a sample paid registration for the user
        $firstWorkshop = Workshop::first();
        Registration::create([
            'user_id' => $user->id,
            'workshop_id' => $firstWorkshop->id,
            'ticket_code' => 'WTX-DEMO0001',
            'status' => 'paid',
            'payment_id' => 'WTX-ORDER-1',
            'amount' => $firstWorkshop->price,
            'paid_at' => now(),
        ]);
    }
}
