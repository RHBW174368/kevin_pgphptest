<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert(
	    	[
	            'name' => "John Smith",
	            'email' => "Sample@gmail.com",
	            'password' => "720DF6C2482218518FA20FDC52D4DED7ECC043AB",
	            'comments' => "Director"
	        ]
    	);
    }
}
