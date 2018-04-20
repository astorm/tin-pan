<?php

use Illuminate\Database\Seeder;

class PackageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('packages')->insert([
            'vendor_name' => 'pulsestorm',
            'package_name' => 'magento2-hello-world',
        ]);

        DB::table('packages')->insert([
            'vendor_name' => 'pulsestorm',
            'package_name' => 'magento2-tin-pan-test',
        ]);
    }
}
