<?php

namespace App\Services;

use App\Http\Filters\FiltersAppointmentSearch;
use App\Models\Appointment;
use App\Models\Service;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Pagination\LengthAwarePaginator;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class ServiceService
{
    public function findAll($fields = [], $paginate = true)
    {
        if (empty($fields)) {
            $fields = ['services.*', 'type_of_services.name as type_of_service_name'];
        }

        $query = QueryBuilder::for(Service::class)
            ->select($fields)
            ->allowedFilters(['name']);

        $query = $query
            ->join('type_of_services', 'services.type_of_service_id', '=', 'type_of_services.id');

        if ($paginate === true) {
            $result = $query->paginate(15);
        }
        else {
            $result = $query->get();
        }
        return $result;
    }

    public function findAllForAdmin()
    {
        $fields = ['services.id', 'services.name', 'services.price',
            'type_of_services.name as type_of_service_name'];

        $query = QueryBuilder::for(Service::class)
            ->select($fields)
            ->allowedFilters(['name']);

        $result = $query
            ->join('type_of_services', 'services.type_of_service_id', '=', 'type_of_services.id')
            ->paginate(15);

        return $result;
    }

    public function findById($id)
    {
        $service = Service::select('services.*', 'type_of_services.name as type_of_service_name')
            ->join('type_of_services', 'services.type_of_service_id', '=', 'type_of_services.id')
            ->where('services.id', '=', $id)
            ->firstOrFail();

        return $service;
    }

    public function create(array $data) : Service
    {
        try {
            $service = Service::create($data);

        } catch (ModelNotFoundException $e) {

        }
        catch (\Exception $e) {

        }

        return $service;
    }

    public function update(array $data, Service $service): Service
    {
        $service->update($data);
        return $service;
    }

    public function deleteById(int $id): void
    {
        $service = Service::find($id);
        $service->delete();
    }
}
