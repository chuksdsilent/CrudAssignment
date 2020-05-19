<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BookTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testGetBooksMethod()
    {
        $response = $this->getJson('/api/v1/books?name=ice and fire');
        $response->assertStatus(200);
    }

    public function testShowBooksMethod()
    {
        $response = $this->getJson('/api/v1/books/3');
        $response->assertStatus(200);
    }
    public function testReadBooksMethod()
    {
        $response = $this->getJson('/api/v1/books');
        $response->assertStatus(200);
    }

    
    public function testDeleteBooksMethod()
    {
        $response = $this->call('DELETE', '/api/v1/books/19');
        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testCreateBookMethod(){
        $response = $this->json('POST', '/api/v1/books', 
            [
                'name' => 'Sally',
                'authors' => ['Sam .R. Petters'],
                'isbn' => '345-3847384738',
                'number_of_pages' => '324',
                'publisher' => "MC Mobil",
                'country' => 'Nigeria',
                'release_date' => '1945-09-08'

            ]
        );

        $response
            ->assertJson([
                'status' => 'success',
            ]);
        $this->assertEquals(200, $response->getStatusCode());

    }

    
    public function testUpdateBookMethod(){
        $response = $this->json('PATCH', '/api/v1/books/4', 
            [
                'name' => 'Sally',
                'authors' => ['Sam .R. Petters'],
                'isbn' => '345-3847384738',
                'number_of_pages' => '324',
                'publisher' => "MC Mobil",
                'country' => 'Nigeria',
                'release_date' => '1945-09-08'

            ]
        );

        $response
            ->assertStatus(200)
            ->assertJson([
                'status' => 'success',
            ]);
    }
}
