<?php

namespace App\Services;

use App\Models\TypeOfService;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class TypeOfServiceService
{
    public function findAll($fields = [], $paginate = true)
    {
        if (empty($fields)) {
            $fields = ['type_of_services.*'];
        }

        $query = TypeOfService::select($fields);

        if ($paginate === true) {
            $result = $query->paginate(15);
        }
        else {
            $result = $query->get();
        }

        return $result;
    }

    public function findById($id)
    {
        $typeOfService = TypeOfService::select('type_of_services.*')
            ->where('type_of_services.id', '=', $id)
            ->firstOrFail();

        return $typeOfService;
    }

    public function create(array $data) : TypeOfService
    {
        try {
            $typeOfService = TypeOfService::create($data);

        } catch (ModelNotFoundException $e) {

        }
        catch (\Exception $e) {

        }

        return $typeOfService;
    }

    public function update(array $data, TypeOfService $typeOfService): TypeOfService
    {
        $typeOfService->update($data);
        return $typeOfService;
    }

    public function deleteById(int $id): void
    {
        $typeOfService = TypeOfService::find($id);
        $typeOfService->delete();
    }
}
