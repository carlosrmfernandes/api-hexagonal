<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sub_categories')->insert([
            ['name' => 'Limpeza', 'checked' => false, 'category_id' => 1],
            ['name' => 'Biscoitos e Salgadinhos', 'checked' => false, 'category_id' => 1],
            ['name' => 'Frios e Laticínios', 'checked' => false, 'category_id' => 1],
            ['name' => 'Leites e Iogurtes', 'checked' => false, 'category_id' => 1],
            ['name' => 'Higiene e Cuidados Pessoais', 'checked' => false, 'category_id' => 1],
            ['name' => 'Bebidas', 'checked' => false, 'category_id' => 1],
            ['name' => 'Doces e Sobremesas', 'checked' => false, 'category_id' => 1],
            ['name' => 'Carnes, Aves e Peixe', 'checked' => false, 'category_id' => 1],
            ['name' => 'Feira', 'checked' => false, 'category_id' => 1],

            ['name' => 'Medicamentos', 'checked' => false, 'category_id' => 2],
            ['name' => 'Higiene e Cuidados Pessoais', 'checked' => false, 'category_id' => 2],
            ['name' => 'Bebês', 'checked' => false, 'category_id' => 2],

            ['name' => 'Alimentação', 'checked' => false, 'category_id' => 3],

            ['name' => 'Higiene e Limpeza', 'checked' => false, 'category_id' => 4],
            ['name' => 'Medicina e Saúde', 'checked' => false, 'category_id' => 4],
            ['name' => 'Rações', 'checked' => false, 'category_id' => 4],
            ['name' => 'Acessórios', 'checked' => false, 'category_id' => 4],

            ['name' => 'Escolar', 'checked' => false, 'category_id' => 5],
            ['name' => 'Escritório', 'checked' => false, 'category_id' => 5],
            ['name' => 'Outros', 'checked' => false, 'category_id' => 5],

        ]);
    }
}
