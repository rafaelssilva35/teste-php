<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\SupplierResource;
use App\Models\Supplier;
use App\Repositories\SupplierRepositoryInterface;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    protected $supplierRepository;

    public function __construct(SupplierRepositoryInterface $supplierRepository)
    {
        $this->supplierRepository = $supplierRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $suppliers = $this->supplierRepository->getAllPaginated();
        return SupplierResource::collection($suppliers);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $supplier = $this->supplierRepository->create($request->json()->all());

        return (new SupplierResource($supplier))
                    ->response()
                    ->setStatusCode(201);
    }

    /**
     * Display the specified resource.
     */
    public function show($supplier)
    {
        $supplier = $this->supplierRepository->findById($supplier);

        if (!$supplier) {
            return response()->json(['message' => 'Supplier not found.'], 404);
        }

        return new SupplierResource($supplier);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $supplierId)
    {
        $supplier = $this->supplierRepository->update($supplierId, $request->toArray());

        if (!$supplier) {
            return response()->json(['message' => 'Supplier not found.'], 404);
        }

        return new SupplierResource($supplier);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($supplier)
    {
        $deleted = $this->supplierRepository->delete($supplier);

        if (!$deleted) {
            return response()->json(['message' => 'Supplier not found.'], 404);
        }

        return response()->json(['message' => 'Supplier deleted successfully.'], 200);
    }
}
