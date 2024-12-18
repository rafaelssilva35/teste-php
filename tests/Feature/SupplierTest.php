<?php

namespace Tests\Feature;

use App\Http\Controllers\SupplierController;
use App\Http\Requests\StoreSupplierRequest;
use App\Http\Requests\UpdateSupplierRequest;
use App\Http\Resources\SupplierResource;
use App\Models\Supplier;
use App\Repositories\SupplierRepositoryInterface;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Mockery;
use Tests\TestCase;

class SupplierTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->supplierRepository = Mockery::mock(SupplierRepositoryInterface::class);
        $this->controller = new SupplierController($this->supplierRepository);
    }

    public function test_create()
    {
        $response = $this->controller->create();

        $this->assertEquals(Inertia::render('Suppliers/Create'), $response);
    }

    public function test_update()
    {
        $validatedData = [
            'name' => 'Fornecedor Atualizado',
            'email' => 'email@exemplo.com',
            'phone' => '123456789',
        ];
    
        $mockedSupplier = new Supplier();
        $mockedSupplier->id = 1;
        $mockedSupplier->name = $validatedData['name'];
        $mockedSupplier->email = $validatedData['email'];
        $mockedSupplier->phone = $validatedData['phone'];
    
        $request = Mockery::mock(UpdateSupplierRequest::class);
        $request->shouldReceive('validated')->andReturn($validatedData);
    
        $this->supplierRepository
            ->shouldReceive('update')
            ->with(1, $validatedData)
            ->andReturn($mockedSupplier);
    
        $response = $this->controller->update($request, 1);
    
        $expectedResponse = redirect()
            ->route('suppliers.index')
            ->with('success', 'Fornecedor atualizado com sucesso!');
    
        $this->assertEquals($expectedResponse->getTargetUrl(), $response->getTargetUrl());
    }
    
    
    public function test_destroy()
    {
        $this->supplierRepository->shouldReceive('delete')->with(1)->andReturn(true);

        $response = $this->controller->destroy(1);

        $this->assertEquals(redirect()->route('suppliers.index')->with('success', 'Supplier deleted successfully.'), $response);
    }
}
