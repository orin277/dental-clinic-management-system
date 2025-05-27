<?php

namespace App\Services;

use App\Models\Weekend;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class WeekendService
{
    public function findAll($fields = [], $paginate = true)
    {
        if (empty($fields)) {
            $fields = ['weekends.*'];
        }

        $query = QueryBuilder::for(Weekend::class)
            ->select($fields)
            ->allowedFilters([
                AllowedFilter::scope('day')
            ]);

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
        $fields = ['weekends.id', 'weekends.day'];

        $query = QueryBuilder::for(Weekend::class)
            ->select($fields)
            ->allowedFilters([
                AllowedFilter::scope('day')
            ]);

        $result = $query->paginate(15);

        return $result;
    }

    public function findById($id)
    {
        $weekend = Weekend::select('weekends.*')
            ->where('weekends.id', '=', $id)
            ->firstOrFail();

        return $weekend;
    }

    public function create(array $data) : Weekend
    {
        try {
            $weekend = Weekend::create($data);

        } catch (ModelNotFoundException $e) {

        }
        catch (\Exception $e) {

        }

        return $weekend;
    }

    public function update(array $data, Weekend $weekend): Weekend
    {
        $weekend->update($data);
        return $weekend;
    }

    public function deleteById(int $id): void
    {
        $weekend = Weekend::find($id);
        $weekend->delete();
    }
}
