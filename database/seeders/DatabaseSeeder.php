<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Food;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
  /**
   * Seed the application's database.
   */
  public function run(): void
  {
    User::factory()->create([
      'name' => 'Admin',
      'email' => 'admin@gmail.com',
      'password' => bcrypt('admin@gmail.com'),
      'name_slug' => 'admin'
    ]);

    // Food
    Food::create([
      'name' => 'Mie Ayam',
      'name_slug' => 'mie_ayam',
      'image' => 'mie_ayam.jpeg',
    ]);

    Food::create([
      'name' => 'Ayam Geprek',
      'name_slug' => 'ayam_geprek',
      'image' => 'ayam_geprek.webp',
    ]);

    Food::create([
      'name' => 'Nasi Goreng',
      'name_slug' => 'nasi_goreng',
      'image' => 'nasi_goreng.jpg',
    ]);

    Food::create([
      'name' => 'Nasi Gurih',
      'name_slug' => 'nasi_gurih',
      'image' => 'nasi_gurih.jpg',
    ]);

    Food::create([
      'name' => 'Sup Ayam',
      'name_slug' => 'sup_ayam',
      'image' => 'sup_ayam.jpg',
    ]);

    Food::create([
      'name' => 'Rendang',
      'name_slug' => 'rendang',
      'image' => 'rendang.webp',
    ]);
  }
}
