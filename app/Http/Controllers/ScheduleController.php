<?php

namespace App\Http\Controllers;

use App\Http\Requests\ScheduleRequest;
use App\Models\Schedule;

class ScheduleController extends Controller
{

    public function index()
    {
        $this->authorize('viewAny', Schedule::class);
        return view('schedule.index', ['schedules' => Schedule::latestSchedule()->get()]);
    }

    public function create()
    {
    }


    public function store(ScheduleRequest $request)
    {
        $this->authorize('create', Schedule::class);
        Schedule::create($request->validated());
        return redirect()->route('schedule.index');
    }

    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $schedule = Schedule::findOrFail($id);
        $this->authorize('update', [Schedule::class, $schedule]);
        return view('schedule.edit', ['schedule' => $schedule]);
    }


    public function update(ScheduleRequest $request, $id)
    {
        $schedule = Schedule::findOrFail($id);
        $this->authorize('update', [Schedule::class, $schedule]);

        $params = $request->validated();

        if (!array_key_exists('is_available', $params)) {
            $params['is_available'] = false;
        }

        $schedule->fill($params);
        $schedule->save();

        return redirect()->route('schedule.index');
    }

    public function destroy($id)
    {
        $schedule = Schedule::findOrFail($id);
        $this->authorize('delete', [Schedule::class, $schedule]);

        $schedule->delete();
        return redirect()->route('schedule.index');
    }
}
