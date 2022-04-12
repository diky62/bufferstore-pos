<?php

use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
        	'roles_id' => 1,
          	'name' => 'Super Admin',
          	'alamat' => 'Cirebon',
          	'no_hp' => '083148302377',
          	'email' => 'superadmin@superadmin.com',
          	'password' => bcrypt('superadmin')
          	
      ]);

        DB::table('users')->insert([
        	'roles_id' => 2,
          	'name' => 'Admin',
          	'alamat' => 'Cirebon',
          	'no_hp' => '083148302377',
          	'email' => 'admin@admin.com',
          	'password' => bcrypt('admin')
          	
      ]);
    }
}
