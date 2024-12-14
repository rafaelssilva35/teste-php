<?php

namespace App\Repositories;

use App\Models\Supplier;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

class SupplierRepository implements SupplierRepositoryInterface
{
    /**
     * {@inheritdoc}
     */
    public function getAllPaginated($perPage = 10): LengthAwarePaginator
    {
        return Supplier::with(['documents', 'addresses', 'contacts'])->paginate($perPage);
    }

    /**
     * {@inheritdoc}
     */
    public function create(array $data): Supplier
    {
        return DB::transaction(function () use ($data) {
            $supplier = Supplier::create([
                'name' => $data['name'],
                'email' => $data['email'] ?? null,
            ]);

            if (isset($data['documents']) && is_array($data['documents'])) {
                $supplier->documents()->createMany($data['documents']);
            }

            if (isset($data['addresses']) && is_array($data['addresses'])) {
                $supplier->addresses()->createMany($data['addresses']);
            }

            if (isset($data['contacts']) && is_array($data['contacts'])) {
                $supplier->contacts()->createMany($data['contacts']);
            }

            return $supplier->load(['documents', 'addresses', 'contacts']);
        });
    }

    /**
     * {@inheritdoc}
     */
    public function findById(int $id): ?Supplier
    {
        return Supplier::with(['documents', 'addresses', 'contacts'])->find($id);
    }

    /**
     * {@inheritdoc}
     */
    public function update(int $id, array $data): ?Supplier
    {
        return DB::transaction(function () use ($id, $data) {
            $supplier = Supplier::find($id);
            if (!$supplier) {
                return null;
            }

            $supplier->update([
                'name' => $data['name'] ?? $supplier->name,
                'email' => $data['email'] ?? $supplier->email,
            ]);

            if (isset($data['documents']) && is_array($data['documents'])) {
                foreach ($data['documents'] as $documentData) {
                    if (isset($documentData['id'])) {
                        $document = $supplier->documents()->find($documentData['id']);
                        if ($document) {
                            $document->update($documentData);
                        }
                    } else {
                        $supplier->documents()->create($documentData);
                    }
                }
            }

            if (isset($data['addresses']) && is_array($data['addresses'])) {
                foreach ($data['addresses'] as $addressData) {
                    if (isset($addressData['id'])) {
                        $address = $supplier->addresses()->find($addressData['id']);
                        if ($address) {
                            $address->update($addressData);
                        }
                    } else {
                        $supplier->addresses()->create($addressData);
                    }
                }
            }

            if (isset($data['contacts']) && is_array($data['contacts'])) {
                foreach ($data['contacts'] as $contactData) {
                    if (isset($contactData['id'])) {
                        $contact = $supplier->contacts()->find($contactData['id']);
                        if ($contact) {
                            $contact->update($contactData);
                        }
                    } else {
                        $supplier->contacts()->create($contactData);
                    }
                }
            }

            return $supplier->load(['documents', 'addresses', 'contacts']);
        });
    }

    /**
     * {@inheritdoc}
     */
    public function delete($id): bool
    {
        $supplier = Supplier::find($id);
        if ($supplier) {
            return $supplier->delete();
        } 
        return false;
    }
}
