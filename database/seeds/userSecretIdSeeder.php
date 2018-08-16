<?php

use Illuminate\Database\Seeder;

class userSecretIdSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
		
		DB::table('users')->update([
            'secretId' => DB::raw('ROUND(RAND() * 100000000)'),
        ]);
    }
}
