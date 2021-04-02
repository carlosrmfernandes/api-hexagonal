<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            ['name' => 'Supermercado', 'checked' => false],
            ['name' => 'Farmácia', 'checked' => false],
            ['name' => 'Alimentação', 'checked' => false],
            ['name' => 'Pet Shop', 'checked' => false],
            ['name' => 'Papelaria', 'checked' => false],
        ]);

    }
}
