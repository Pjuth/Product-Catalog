<?php

use Illuminate\Database\Seeder;

class ConfigurationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('Configurations')->insert([
            'tax_rate'        => 21,
            'tax_inclusion'   => true,
            'global_discount' => 3,
        ]);
    }
}
