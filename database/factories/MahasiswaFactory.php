<?php

namespace Database\Factories;

use App\Models\Mahasiswa;
use Illuminate\Database\Eloquent\Factories\Factory;

class MahasiswaFactory extends Factory
{
    protected $model = Mahasiswa::class;

    public function definition(): array
    {
        // Jenis kelamin
        $sex = fake()->randomElement(['L', 'P']);

        // Tahun masuk
        $tahunMasuk = fake()->numberBetween(2016, 2025);

        // NIM = tahun + 4 digit
        $nim = $tahunMasuk . fake()->numerify('########');

        return [
            'nim' => $nim,
            'sex' => $sex,

            // Nama Indonesia + sesuai gender
            'nama' => $sex === 'L'
                ? fake('id_ID')->firstNameMale() . ' ' . fake('id_ID')->lastName()
                : fake('id_ID')->firstNameFemale() . ' ' . fake('id_ID')->lastName(),

            'prodi' => fake()->randomElement([
                'Teknik Informatika',
                'Teknik Geomatika',
                'Teknik Sipil',
            ]),

            'tanggal_masuk' => fake()
                ->dateTimeBetween("$tahunMasuk-08-01", "$tahunMasuk-09-01")
                ->format('Y-m-d'),
        ];
    }
}