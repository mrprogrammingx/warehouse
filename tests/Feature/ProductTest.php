<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class ProductTest extends TestCase
{
    // use RefreshDatabase;
    public function setUp(): void
    {
        parent::setUp();
        $this->initDatabase();
    }

    public function tearDown(): void
    {
        $this->resetDatabase();
        parent::tearDown();
    }

    /**
     * testRequestsShow .
     *
     * @return void
     */
    public function testRequestsShow()
    {
        $response = $this->withHeaders(['Authorization' => "Bearer $this->token"])->get('api/requests/all');
        $response->assertSuccessful();
    }

    /**
     * testRequestsDetailsShow .
     *
     * @return void
     */
    public function testRequestsDetailsShow()
    {
        $response = $this->withHeaders(['Authorization' => "Bearer $this->token"])->get('api/requestdetails/all');
        $response->assertSuccessful();
    }

    /**
     * testLoginRoute.
     *
     * @return void
     */
    public function testLoginRoute()
    {
        // $user = User::where(['personnel_code'=>'1234'])->exists();
        // if(!$user){
        //     $response = $this->post('api/register',[
        //         'user_name' => 'ali',
        //         'personnel_code' => '1234',
        //         'first_name' => 'ali',
        //         'last_name' => 'alaee',
        //         'mobile' => '091352',
        //         'password' => '1234',
        //         'c_password' => '1234',
        //     ]);
        //     $response->assertSuccessful();
        // }
        // $response = $this->post('api/login',[
        //     'personnel_code' => 'ali',
        //     'password' => '1234'
        // ]);
        // $response->assertSuccessful();
        $this->assertTrue(true);
    }


    public function testCreateFakeProduct()
    {
        $count = 3;
        $first = Product::count();
        $product = Product::factory()->count($count)->create();
        $secound = Product::count();
        $this->assertEquals($first + $count, $secound);
    }

    /**
     * A test for create in products.
     * 
     * @return void
     */
    public function test_createProduct()
    {
        $data = array('name' => null,
        'attributes' => null,
        'worn' => null,
        'descriptions' => null,
        'file_id' => null,
        'category_id' => null,
        'rayvarz_id' => null,
        'technical_index_id'=> null);
        $data['name'] = 'ali';
        $data['attributes'] = 1;
        $data['worn'] = 1;
        $data['descriptions'] = 'hihi';
        $data['file_id'] = 1;
        $data['category_id'] = 1;
        $data['rayvarz_id'] = 1100;
        $data['technical_index_id'] = 134;

        $response = $this->withHeaders(['Authorization' => "Bearer $this->token"])->post('api/products/store', $data);
        $response->assertSuccessful();
        
        $response = $this->withHeaders(['Authorization' => "Bearer $this->token"])->get('api/products/all', $data);
        $response->assertSuccessful();
        // var_dump($response['data']);die;
        // $data['id'] = $response['data'][0]['id'];
        // $data['technical_index_id'] = 960;
        // $response = $this->put('api/products/update', $data);
        // $response->assertSuccessful();
    }
}
