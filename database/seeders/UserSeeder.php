<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'username' => 'widya',
                'name' => 'Widya Indah Puspita Sari',
                'email' => 'widyain@gmail.com',
                'password' => Hash::make('1111')
            ],
            [
                'username' => 'nasya',
                'name' => 'Nasyawa Ramadhia',
                'email' => 'nasyawa@gmail.com',
                'password' => Hash::make('2222')
            ],
            [
                'username' => 'nuril',
                'name' => 'Nuril Haidar',
                'email' => 'nuril@gmail.com',
                'password' => Hash::make('3333')
            ]
        ]);
    }
}
