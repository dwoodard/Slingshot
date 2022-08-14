<?php

namespace Tests\Feature;

use App\Models\Page;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PageTest extends TestCase
{
    use RefreshDatabase;


    /** @test */
    public function check_if_page_is_created()
    {
        $this->withoutExceptionHandling();
        $this->seed();
        Page::create([
            'title' => 'Test Page',
            'link' => 'test-page'
        ]);
        $this->assertDatabaseHas('pages', [
            'title' => 'Test Page',
            'link' => 'test-page'
        ]);

        // next assert that the page that is created can be loaded via the browser
        $this->get('/test-page')
            ->assertOk();




    }

    /** @test */
    public function check_fake_page()
    {
        //a non existing page should return a 404
        $this->get('/fake-page')
            ->assertStatus(404);
    }

}
