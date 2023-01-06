<?php

namespace App\Observers;

use App\Models\Appointment;
use Illuminate\Support\Facades\Storage;

class AppointmentObserver
{
    /**
     * Handle the Appointment "created" event.
     *
     * @param  \App\Models\Appointment  $appointment
     * @return void
     */
    public function created(Appointment $appointment)
    {
        //
    }

    /**
     * Handle the Appointment "updated" event.
     *
     * @param  \App\Models\Appointment  $appointment
     * @return void
     */
    public function updated(Appointment $appointment)
    {
        //
    }

    public function deleting(Appointment $appointment)
    {
        if ($appointment->image) {
            $imgSrc = $appointment->image->src;

            if (file_exists(public_path() . '/storage/' . $imgSrc)) {
                Storage::delete($imgSrc);
            }
            $appointment->image()->delete();
        }
    }
    public function deleted(Appointment $appointment)
    {
    }

    /**
     * Handle the Appointment "restored" event.
     *
     * @param  \App\Models\Appointment  $appointment
     * @return void
     */
    public function restored(Appointment $appointment)
    {
        //
    }

    /**
     * Handle the Appointment "force deleted" event.
     *
     * @param  \App\Models\Appointment  $appointment
     * @return void
     */
    public function forceDeleted(Appointment $appointment)
    {
        //
    }
}
