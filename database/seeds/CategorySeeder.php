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
            ['name' => 'Supermercado','background_color'=>'#BBCDF2','sub_title'=>'Os melhores preços da cidade','image'=>'','checked' => false],
            ['name' => 'Farmácia','background_color'=>'#F27781','sub_title'=>'Rémedios a bom preço','image'=>'', 'checked' => false],
            ['name' => 'Alimentação','background_color'=>'#91F2BB','sub_title'=>'Express - Super - Hiper','image'=>'', 'checked' => false],
            ['name' => 'Pet Shop','background_color'=>'#F2C288','sub_title'=>'É só nos dizer o que precisa e levamos até você','image'=>'', 'checked' => false],
            ['name' => 'Papelaria','background_color'=>'#F2D680','sub_title'=>'Promoções o ano inteiro','image'=>'', 'checked' => false],
        ]);

    }
}
