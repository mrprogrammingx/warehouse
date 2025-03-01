<?php

namespace Tests\Unit;

use App\Models\Product;
use Database\Factories\ProductFactory;
use Tests\TestCase;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
class ProductTest extends TestCase
{

    public function setUp(): void
    {
        parent::setUp();
        $this->initDatabase();
    }

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_example()
    {
        $this->assertTrue(true);
    }

    /**
     * A test for show products.
     * 
     * @return void
     */
    public function test_showProducts(){
        // $ProductController = new ProductController(ProductRepository $productRepository);
        // $ProductController->getAllProducts();
        // $products = Product::where(['id'=>1])->get();
        //var_dump($products);die;
        $this->assertTrue(true);
    }

    /**
     * A test for create in products.
     * 
     * @return void
     */
    public function test_createProduct(){
        // $product = new Product();
        // $product->Attributes=1;
        // $product->worn=1;
        // $product->descriptions=1;
        // $product->file_id=1;
        // $product->category_id=1;
        // $product->rayvarz_id=1;
        // $product->technical_index_id=1;
        // $product = $product->create($product);
        $this->assertTrue(true);
    }

    // public function tearDown(): void
    // {
    //     $this->resetDatabase();
    //     parent::tearDown();
    // }

    public function true_is_true(){
        $this->assertTrue(true);
    }

}
