<?php

namespace Database\Seeders;

use App\Models\Mahasiswa;
use App\Models\User;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class MahasiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        // Mendapatkan semua pengguna dengan role 'mahasiswa'
        $mahasiswaUsers = User::where('role', 'mahasiswa')->get();

        if ($mahasiswaUsers->isEmpty()) {
            throw new \Exception('Mahasiswa tidak ditemukan.');
        }

        $kelasId = 1;
        $studentCountInClass = 0;

        foreach ($mahasiswaUsers as $mahasiswaUser) {
            // Create Mahasiswa record
            Mahasiswa::create([
                'id' => $mahasiswaUser->id,
                'id_user' => $mahasiswaUser->id,
                'kelas_id' => $kelasId,
                'nama' => $mahasiswaUser->name,
                'nim' => $faker->unique()->numberBetween(100000000, 999999999),
                'tempat_lahir' => $faker->city,
                'tanggal_lahir' => $faker->date('Y-m-d'),
                'edit' => false,
            ]);

            // Increment the count of students in the current class
            $studentCountInClass++;

            // Check if the current class has reached its capacity
            if ($studentCountInClass >= 10) {
                // Switch to the other class and reset the student count
                $kelasId = ($kelasId === 1) ? 2 : 1;
                $studentCountInClass = 0;
            }
        }
    }
}
