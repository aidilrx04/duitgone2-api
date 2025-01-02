<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TransactionControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_list_all_transactions()
    {
        Transaction::factory()->count(3)->create();

        $response = $this->getJson('/api/transactions');

        $response
            ->assertOk()
            ->assertJsonCount(3);
    }

    /** @test */
    public function it_can_store_a_transaction()
    {
        $data = [
            'amount' => 100.50,
            'date' => '2025-01-01',
        ];

        $response = $this->postJson('/api/transactions', $data);

        $response
            ->assertCreated();

        $this->assertDatabaseHas('transactions', $data);
    }

    /** @test */
    public function it_can_show_a_transaction()
    {
        $transaction = Transaction::factory()->create();

        $response = $this->getJson("/api/transactions/{$transaction->id}");

        $response
            ->assertOk()
            ->assertJsonFragment([
                'id' => $transaction->id,
                'amount' => $transaction->amount,
                'date' => $transaction->date,
            ]);
    }

    /** @test */
    public function it_can_update_a_transaction()
    {
        $transaction = Transaction::factory()->create();

        $data = [
            'amount' => 200.75,
            'date' => '2025-01-02',
        ];

        $response = $this->putJson("/api/transactions/{$transaction->id}", $data);

        $response
            ->assertOk();

        $this->assertDatabaseHas('transactions', $data);
    }

    /** @test */
    public function it_can_delete_a_transaction()
    {
        $transaction = Transaction::factory()->create();

        $response = $this->deleteJson("/api/transactions/{$transaction->id}");

        $response->assertNoContent(200);

        $this->assertDatabaseMissing('transactions', [
            'id' => $transaction->id,
        ]);
    }
}
