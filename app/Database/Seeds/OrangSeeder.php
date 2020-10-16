<?php

namespace App\Database\Seeds;

use CodeIgniter\I18n\Time;

class OrangSeeder extends \CodeIgniter\Database\Seeder
{
    public function run()
    {
        // $data = [
        //     [
        //         'nama'              => 'Ikka',
        //         'alamat'            => 'Jingaraka',
        //         'created_at'        => Time::Now(),
        //         'updated_at'        => Time::now()
        //     ],
        //     [
        //         'nama'              => 'Kiki',
        //         'alamat'            => 'Jingaraka',
        //         'created_at'        => Time::Now(),
        //         'updated_at'        => Time::now()
        //     ],
        //     [
        // 'nama'              => 'Oko',
        // 'alamat'            => 'Jingaraka',
        // 'created_at'        => Time::Now(),
        // 'updated_at'        => Time::now()
        //     ]
        // ];
        $faker = \Faker\Factory::create('id_ID');
        for ($i = 0; $i < 100; $i++) {

            $data = [
                'nama'              => $faker->name,
                'alamat'            => $faker->address,
                'created_at'        => Time::createFromTimestamp($faker->unixTime()),
                'updated_at'        => Time::now()
            ];
            // Using Query Builder
            $this->db->table('orang')->insert($data);
        }

        // Simple Queries
        // $this->db->query(
        //     "INSERT INTO orang (nama, alamat, created_at, updated_at) VALUES(:nama:, :alamat:, :created_at:, :updated_at:)",
        //     $data
        // );

        //digunakan untuk upload data yang banyak
        // $this->db->table('orang')->insertBatch($data);
    }
}
