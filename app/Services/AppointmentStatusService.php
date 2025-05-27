<?php

namespace App\Services;

use App\Models\AppointmentStatus;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class AppointmentStatusService
{
    public function findAll(): Collection
    {
        $appointmentStatuses = AppointmentStatus::select('id', 'name')
            ->get();

        return $appointmentStatuses;
    }

    public function findById($id)
    {
        $appointmentStatus = AppointmentStatus::select()
            ->where('appointment_statuses.id', '=', $id)
            ->firstOrFail();

        return $appointmentStatus;
    }

    public function create(array $data) : AppointmentStatus
    {
        try {
            $appointmentStatus = AppointmentStatus::create($data);

        } catch (ModelNotFoundException $e) {

        }
        catch (\Exception $e) {

        }

        return $appointmentStatus;
    }

    public function update(array $data, AppointmentStatus $appointmentStatus): AppointmentStatus
    {
        $appointmentStatus->update($data);
        return $appointmentStatus;
    }

    public function deleteById(int $id): void
    {
        $appointmentStatus = AppointmentStatus::find($id);
        $appointmentStatus->delete();
    }
}
