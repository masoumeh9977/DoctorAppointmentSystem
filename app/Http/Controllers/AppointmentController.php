<?php

namespace App\Http\Controllers;

use App\Http\Requests\AppointmentRequest;
use App\Jobs\NotifyUserAppointmentWasRegisteredJob;
use App\Mail\RegisteredAppointmentMail;
use App\Models\Appointment;
use App\Models\Image;
use App\Models\Schedule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class AppointmentController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $appointments = [];

        if (Auth::user()->is_doctor) {
            $appointments = Appointment::all();
        } else {
            $appointments = Appointment::all()->where('user_id', '=', Auth::user()->id);
        }

        return view('appointment.index', ['appointments' => $appointments]);
    }


    public function create($scheduleId)
    {
        $this->authorize('create', Appointment::class);
        return view('appointment.create', ['user' => Auth::user(), 'schedule' => Schedule::findOrFail($scheduleId)]);
    }


    public function store(AppointmentRequest $request, $scheduleId)
    {
        $this->authorize('create', Appointment::class);

        $params = $request->validated();
        $params['user_id'] = $request->user()->id;
        $params['schedule_id'] = $scheduleId;
        $appointment = Appointment::create($params);

        if ($request->hasFile('symptom_image')) {
            $fname = $request->file('symptom_image')->storeAs('images/symptom_images/' . $request->user()->id . $scheduleId, $request->file('symptom_image')->getClientOriginalName());
            $appointment->image()->save(
                Image::make(['src' => $fname])
            );
        }

        //Send Email to the Patient By Background Processing

        // 1.First Implementation
        // Mail::to($appointment->user)->queue(
        //     new RegisteredAppointmentMail($appointment)
        // );

        //2. Second Implementation (Using Custom Job)
        NotifyUserAppointmentWasRegisteredJob::dispatch($appointment);

        return redirect()->route('appointment.index');
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $appointment = Appointment::findOrFail($id);
        $this->authorize('update', [Appointment::class, $appointment]);

        return view('appointment.edit', [
            'appointment' => $appointment
        ]);
    }

    public function update(AppointmentRequest $request, $id)
    {
        $appointment = Appointment::findOrFail($id);
        $this->authorize('update', [Appointment::class, $appointment]);

        $appointment->fill($request->validated());
        if ($request->hasFile('symptom_image')) {
            if ($appointment->image) {
                Storage::delete($appointment->image->src);
                $appointment->image->src = $request->file('symptom_image')->storeAs('images/symptom_images/' . $request->user()->id . $appointment->schedule_id, $request->file('symptom_image')->getClientOriginalName());
                $appointment->image->save();
            } else {
                $fname = $request->file('symptom_image')->storeAs('images/symptom_images/' . $request->user()->id . $appointment->schedule_id, $request->file('symptom_image')->getClientOriginalName());
                $appointment->image()->save(
                    Image::make(['src' => $fname])
                );
            }
        }
        $appointment->save();

        return redirect()->route('appointment.index');
    }

    public function destroy($id)
    {
        $appointment = Appointment::findOrFail($id);
        $this->authorize('delete', [Appointment::class, $appointment]);

        $appointment->delete();
        return redirect()->route('appointment.index');
    }
}
