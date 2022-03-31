<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class Serviceoption extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('service_option')->insert([
            ['name'=>'Good','status'=>1,'created_at' =>date("Y-m-d H:i:s"),'updated_at' =>date("Y-m-d H:i:s")],
            ['name'=>'Fair','status'=>1,'created_at' =>date("Y-m-d H:i:s"),'updated_at' =>date("Y-m-d H:i:s")],
            ['name'=>'Neutral','status'=>1,'created_at' =>date("Y-m-d H:i:s"),'updated_at' =>date("Y-m-d H:i:s")],
            ['name'=>'Bad','status'=>1,'created_at' => date("Y-m-d H:i:s"),'updated_at' =>date("Y-m-d H:i:s")],
         
        ]);
    }
}
