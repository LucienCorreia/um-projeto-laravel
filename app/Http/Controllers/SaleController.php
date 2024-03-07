<?php

namespace App\Http\Controllers;

use App\Http\Repositories\SaleRepository;
use App\Http\Requests\AddProductsRequest;
use App\Http\Requests\StoreSaleRequest;
use App\Http\Requests\UpdateSaleRequest;
use App\Http\Resources\SaleProductResource;
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
     * Add products to the specified resource in storage.
     */

    public function addProducts(Sale $sale, AddProductsRequest $request, SaleRepository $saleRepository)
    {
        return new SaleResource($saleRepository->addProducts($sale, $request->all()));
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
