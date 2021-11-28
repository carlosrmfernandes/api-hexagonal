<?php

namespace Tests\Unit\Register;

use App\Models\Product;
use Tests\TestCase;

class ProductTest extends TestCase {

    /**
     * A basic unit test example.
     *
     * @return void
     */
    use \App\Service\V1\User\Traits\RuleTrait;
    use \Illuminate\Foundation\Testing\DatabaseTransactions;

    function test_create() {
        $product = factory(Product::class)->create();
        $expcetedProductId = Product::find($product->id);
        $this->assertEquals($expcetedProductId->id, $product->id);
    }



}
