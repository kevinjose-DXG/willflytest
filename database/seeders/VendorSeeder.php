<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;
use Hash;

class VendorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('vendors')->insert([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'mobile' => '9745920795',
            'password' => Hash::make('123456789'),
            'mobile' => '9745920795',
            'status' => 'active',
            'is_vendor' => '1',
            'bussiness_details' => '0',
            'verified' => '0',

        ]);
    }
}
