<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTransactionRequest;
use App\Http\Requests\UpdateTransactionRequest;
use App\Models\Transaction;
use App\Support\InvalidRequestResponse;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\Enums\FilterOperator;
use Spatie\QueryBuilder\QueryBuilder;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {

            // show all transactions
            $transactions = QueryBuilder::for(Transaction::class)
                ->allowedFilters([
                    AllowedFilter::exact('id'),
                    AllowedFilter::operator('amount', FilterOperator::DYNAMIC),
                    AllowedFilter::operator('created_at', FilterOperator::DYNAMIC),
                    'category.label'
                ])
                ->allowedIncludes(['category'])
                ->allowedSorts(['id', 'amount', 'created_at'])
                ->get();

            return $transactions;
        } catch (Exception $e) {
            Log::error($e, request()->query());
            return InvalidRequestResponse::notAllowed();
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTransactionRequest $request)
    {
        $validated = $request->validated();

        $transaction = Transaction::create($validated);

        return $transaction;
    }

    /**
     * Display the specified resource.
     */
    public function show(Transaction $transaction)
    {
        return $transaction;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTransactionRequest $request, Transaction $transaction)
    {
        $validated = $request->validated();

        $transaction->update($validated);

        return $transaction;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transaction $transaction)
    {
        $transaction->delete();
    }
}
