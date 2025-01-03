<?php

declare(strict_types=1);

namespace Tests\Feature\Http;

use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CategoryControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_can_list_all_categories()
    {
        Category::factory()->count(3)->create();

        $response = $this->getJson(route('api.categories.index'));

        $response
            ->assertOk()
            ->assertJsonCount(3);
    }

    public function test_it_can_store_a_category()
    {
        $data = [
            'label' => 'Test Category',
        ];

        $response = $this->postJson(route('api.categories.store'), $data);

        $response
            ->assertCreated()
            ->assertJsonFragment($data);

        $this->assertDatabaseHas('categories', $data);
    }

    public function test_it_can_show_a_category()
    {
        $category = Category::factory()->create();

        $response = $this->getJson(route('api.categories.show', $category));

        $response
            ->assertOk()
            ->assertJsonFragment([
                'id' => $category->id,
                'label' => $category->label,
            ]);
    }

    public function test_it_can_update_a_category()
    {
        $category = Category::factory()->create();

        $data = [
            'label' => 'Updated Category',
        ];

        $response = $this->putJson(route('api.categories.update', $category), $data);

        $response
            ->assertOk()
            ->assertJsonFragment($data);

        $this->assertDatabaseHas('categories', $data);
    }

    public function test_it_can_delete_a_category()
    {
        $category = Category::factory()->create();

        $response = $this->deleteJson(route('api.categories.destroy', $category));

        $response->assertOk();

        $this->assertDatabaseMissing('categories', [
            'id' => $category->id,
        ]);
    }
}
