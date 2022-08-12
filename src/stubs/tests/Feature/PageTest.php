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
    public function check_if_a_page_in_the_protected_function_assert_database_count_table_int_count_connection_null_()
    {
        // create a page called 'foo'
        $page = Page::create([
            'title' => 'foo',
            'link' => 'foo'
        ]);

        // check if the page is in the database
        $this->assertDatabaseHas('pages', [
            'title' => 'foo',
            'link' => 'foo'
        ]);

        dump(Page::all()->count());

        //assert page with title 'foo' is in the database
        $this->assertDatabaseHas('pages', [
            'title' => 'foo'
        ]);
    }
}
