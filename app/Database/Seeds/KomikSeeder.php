<?php

namespace App\Database\Seeds;

// use CodeIgniter\I18n\Time;

class KomikSeeder extends \CodeIgniter\Database\Seeder
{
    public function run()
    {
        $faker = \Faker\Factory::create();

        for ($i = 1; $i < 100; $i++) {
            $judul = $faker->text(8);
            $slug = url_title($judul, '-', true);

            $data = [
                'judul' => $judul,
                'slug' => $slug,
                'penulis' => $faker->name,
                'penerbit' => $faker->company,
                'sampul' => 'default.png'

            ];


            $this->db->table('komik')->insert($data);
        }
    }
}
