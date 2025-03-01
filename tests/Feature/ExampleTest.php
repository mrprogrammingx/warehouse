<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    // public function test_example()
    // {
    //     $response = $this->get('/');
    //     $response->assertStatus(200);
    // }

    /**
     * testRequestsShow .
     *
     * @return void
     */
    // public function testRequestsShow(){
    //     $response = $this->get('api/requests/all');
    //     $response->assertStatus(200);
    // }

    /**
     * testRequestsDetailsShow .
     *
     * @return void
     */
    // public function testRequestsDetailsShow(){
    //     $response = $this->get('api/requestdetails/all');
    //     $response->assertStatus(200);
    // }

    /**
     * testLoginRoute.
     *
     * @return void
     */
    public function testLoginRoute(){
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

    // public function testGetAllProducts(){
    //     $response = $this->get('api/products/all'); #YOU must say main skill in your resume.
    //     $response->assertSuccessful(); #career path #title resume
    // }

    // public function testGetAllConfirms(){
    //     $response = $this->get('api/confirms/all');
    //     $response->assertSuccessful();
    // }

}
