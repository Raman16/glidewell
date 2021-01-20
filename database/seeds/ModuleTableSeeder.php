<?php

use App\Modules;
use Illuminate\Database\Seeder;

class ModuleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $mod=new Modules();
        $mod->name='Sleep Disorder';
        $mod->save();
    }
}
