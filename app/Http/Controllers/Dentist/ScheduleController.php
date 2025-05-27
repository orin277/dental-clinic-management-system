<?php

namespace App\Http\Controllers\Dentist;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dentist\Schedule\StoreScheduleRequest;
use App\Http\Requests\Dentist\Schedule\UpdateScheduleRequest;
use App\Models\Schedule;
use App\Services\DentistService;
use App\Services\ScheduleService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ScheduleController extends Controller
{
    public function __construct(private ScheduleService $scheduleService)
    {

    }

    public function index(Request $request) {
        try {
            $schedules = $this->scheduleService->findAllForDentist(Auth::user()->dentist->id);
            $dayOfWeeks = $this->scheduleService->getDayOfWeeks();
        } catch (\Exception $e) {
            return back()->withError($e->getMessage())->withInput();
        }

        return view('dentist/schedule/index', compact('schedules', 'dayOfWeeks'));
    }

    public function create() {
        try {
            $dayOfWeeks = $this->scheduleService->findDayOfWeeks();
        } catch (\Exception $e) {
            return back()->withError($e->getMessage())->withInput();
        }

        return view('dentist/schedule/create', compact('dayOfWeeks'));
    }

    public function store(StoreScheduleRequest $request) {
        try {
            $validated = $request->validated();
            $this->scheduleService->create($validated);
        } catch (\Exception $e) {
            return back()->withError($e->getMessage())->withInput();
        }

        return redirect()->route('dentist.schedules.index');
    }

    public function edit(Schedule $schedule) {
        try {
            $dayOfWeeks = $this->scheduleService->findDayOfWeeks();
            $schedule = $this->scheduleService->findById($schedule->id);
        } catch (\Exception $e) {
            return back()->withError($e->getMessage())->withInput();
        }

        return view('dentist/schedule/edit', compact('schedule', 'dayOfWeeks'));
    }

    public function update(UpdateScheduleRequest $request, Schedule $schedule) {
        try {
            $validated = $request->validated();
            $this->scheduleService->update($validated, $schedule);
        } catch (\Exception $e) {
            return back()->withError($e->getMessage())->withInput();
        }

        return redirect()->route('dentist.schedules.edit', $schedule->id);
    }

    public function destroy(Schedule $schedule) {
        try {
            $this->scheduleService->deleteById($schedule->id);
        } catch (\Exception $e) {
            return back()->withError($e->getMessage())->withInput();
        }

        return redirect()->route('dentist.schedules.index');
    }
}
