<?php

namespace Database\Seeders;

use App\Models\Team;
use Illuminate\Database\Seeder;

class TeamSeeder extends Seeder
{
    public function run(): void
    {
        $teams = [
            ['nama' => 'Ahmad Sahrul F', 'npm' => '20241320031', 'urutan' => 1],
            ['nama' => 'Siti Nurhaliza', 'npm' => '2024002', 'urutan' => 2],
            ['nama' => 'Budi Santoso', 'npm' => '2024003', 'urutan' => 3],
            ['nama' => 'Dewi Lestari', 'npm' => '2024004', 'urutan' => 4],
            ['nama' => 'Eko Prasetyo', 'npm' => '2024005', 'urutan' => 5],
            ['nama' => 'Fitri Handayani', 'npm' => '2024006', 'urutan' => 6],
            ['nama' => 'Gilang Ramadhan', 'npm' => '2024007', 'urutan' => 7],
        ];

        foreach ($teams as $team) {
            Team::create($team);
        }
    }
}
