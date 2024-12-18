<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSupplierRequest;
use App\Http\Requests\UpdateSupplierRequest;
use App\Http\Resources\SupplierResource;
use App\Repositories\SupplierRepositoryInterface;
use Illuminate\Http\Request;
use Inertia\Inertia;

class SupplierController extends Controller
{
    protected $supplierRepository;

    public function __construct(SupplierRepositoryInterface $supplierRepository)
    {
        $this->supplierRepository = $supplierRepository;
    }

    public function index(Request $request)
    {
        $suppliers = $this->supplierRepository->getAllPaginated(10);
        return Inertia::render('Suppliers/Index', [
            'suppliers' => SupplierResource::collection($suppliers),
        ]);
    }

    public function create()
    {
        return Inertia::render('Suppliers/Create');
    }

    public function store(StoreSupplierRequest $request)
    {
        $supplier = $this->supplierRepository->create($request->toArray());

        return redirect()->route('suppliers.index')
                         ->with('success', 'Supplier created successfully.');
    }

    public function edit($id)
    {
        $supplier = $this->supplierRepository->findById($id);

        if (!$supplier) {
            return redirect()->route('suppliers.index')
                             ->with('error', 'Supplier not found.');
        }
        
        return Inertia::render('Suppliers/Edit', [
            'supplier' => new SupplierResource($supplier),
        ]);
    }

    public function update(UpdateSupplierRequest $request, $id)
    {
        $supplier = $this->supplierRepository->update($id, $request->validated());

        if (!$supplier) {
            return redirect()->route('suppliers.index')
                             ->with('error', 'Supplier not found.');
        }

        return redirect()->route('suppliers.index')->with('success', 'Fornecedor atualizado com sucesso!');

    }

    public function destroy($id)
    {
        $deleted = $this->supplierRepository->delete($id);

        if ($deleted) {
            return redirect()->route('suppliers.index')
                             ->with('success', 'Supplier deleted successfully.');
        }

        return redirect()->route('suppliers.index')
                         ->with('error', 'Supplier not found.');
    }
}
