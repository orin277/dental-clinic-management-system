<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\Schedule\StoreScheduleRequest;
use App\Http\Requests\Admin\Schedule\UpdateScheduleRequest;
use App\Models\Schedule;
use App\Services\DentistService;
use App\Services\ScheduleService;
use Illuminate\Http\Request;

class ScheduleController
{
    public function __construct(private ScheduleService $scheduleService,
                                private DentistService $dentistService)
    {

    }

    public function index(Request $request) {
        try {
            $schedules = $this->scheduleService->findAllForAdmin();
        } catch (\Exception $e) {
            return back()->withError($e->getMessage())->withInput();
        }

        return view('admin/schedule/index', compact('schedules'));
    }

    public function create() {
        try {
            $dayOfWeeks = $this->scheduleService->findDayOfWeeks();
            $dentists = $this->dentistService->getDentistsForDropdownList();
        } catch (\Exception $e) {
            return back()->withError($e->getMessage())->withInput();
        }

        return view('admin/schedule/create', compact('dentists', 'dayOfWeeks'));
    }

    public function store(StoreScheduleRequest $request) {
        try {
            $validated = $request->validated();
            $this->scheduleService->create($validated);
        } catch (\Exception $e) {
            return back()->withError($e->getMessage())->withInput();
        }

        return redirect()->route('admin.schedules.index');
    }

    public function edit(Schedule $schedule) {
        try {
            $dayOfWeeks = $this->scheduleService->findDayOfWeeks();
            $dentists = $this->dentistService->getDentistsForDropdownList();
            $schedule = $this->scheduleService->findById($schedule->id);
        } catch (\Exception $e) {
            return back()->withError($e->getMessage())->withInput();
        }

        return view('admin/schedule/edit', compact('schedule',
            'dentists', 'dayOfWeeks'));
    }

    public function update(UpdateScheduleRequest $request, Schedule $schedule) {
        try {
            $validated = $request->validated();
            $this->scheduleService->update($validated, $schedule);
        } catch (\Exception $e) {
            return back()->withError($e->getMessage())->withInput();
        }

        return redirect()->route('admin.schedules.edit', $schedule->id);
    }

    public function destroy(Schedule $schedule) {
        try {
            $this->scheduleService->deleteById($schedule->id);
        } catch (\Exception $e) {
            return back()->withError($e->getMessage())->withInput();
        }

        return redirect()->route('admin.schedules.index');
    }

    public function getSchedules(Request $request) {
        $schedules = [];
        if ($request->has('dentist-id') and $request->has('day-of-week-id')) {
            $schedules = $this->scheduleService->findByDentistIdAndDayOfWeekId($request->query('dentist-id'),
                $request->query('day-of-week-id'));
        }

        return response()->json($schedules);
    }
}
