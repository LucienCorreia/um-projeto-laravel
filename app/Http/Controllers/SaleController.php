<?php

namespace App\Http\Controllers;

use App\Http\Repositories\SaleRepository;
use App\Http\Requests\StoreSaleRequest;
use App\Http\Requests\UpdateSaleRequest;
use App\Http\Resources\SaleResource;
use App\Models\Sale;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sales = Sale::with('products')->paginate();

        return SaleResource::collection($sales);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSaleRequest $request, SaleRepository $saleRepository)
    {
        $sale = $saleRepository->save($request->all());

        return new SaleResource($sale);
    }

    /**
     * Display the specified resource.
     */
    public function show(Sale $sale)
    {
        $sale->load('products');

        return new SaleResource($sale);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sale $sale)
    {
        //
    }

    /**
     * Cancel the specified resource from storage.
     */
    public function cancel(Sale $sale)
    {
        $sale->update(['cancelled' => true]);

        return new SaleResource($sale);
    }
}
