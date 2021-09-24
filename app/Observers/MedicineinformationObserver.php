<?php

namespace App\Observers;

use App\Models\Superadmin;
use App\Models\Medicineinformation;
use Illuminate\Support\Facades\Auth;
use App\Notifications\Superadminnotification;

class MedicineinformationObserver
{
    /**
     * Handle the Medicineinformation "created" event.
     *
     * @param  \App\Models\Medicineinformation  $medicineinformation
     * @return void
     */
    public function created(Medicineinformation $medicineinformation)
    {
        $data = [
            
            'superadminboady' =>'<a class="black-text"  href="'. url('/superadmin/editmedicineinformation/'.$medicineinformation->id) . '">'.Auth::user()->name .' create ' .$medicineinformation->title. '</a>',
  ];
      $superAdmins = Superadmin::first();
     
          $superAdmins->notify(new Superadminnotification($data));
    }

    /**
     * Handle the Medicineinformation "updated" event.
     *
     * @param  \App\Models\Medicineinformation  $medicineinformation
     * @return void
     */
    public function updated(Medicineinformation $medicineinformation)
    {
        $data = [
            
            'superadminboady' =>'<a class="black-text"  href="'. url('/superadmin/editmedicineinformation/'.$medicineinformation->id) . '">'.Auth::user()->name .' create ' .$medicineinformation->title. '</a>',
  ];
      $superAdmins = Superadmin::first();
     
          $superAdmins->notify(new Superadminnotification($data));
    }

    /**
     * Handle the Medicineinformation "deleted" event.
     *
     * @param  \App\Models\Medicineinformation  $medicineinformation
     * @return void
     */
    public function deleted(Medicineinformation $medicineinformation)
    {
        $data = [
            
            'superadminboady' =>'<a class="black-text"  href="'. url('/superadmin/editmedicineinformation/'.$medicineinformation->id) . '">'.Auth::user()->name .' Delete ' .$medicineinformation->title. '</a>',
  ];
      $superAdmins = Superadmin::first();
     
          $superAdmins->notify(new Superadminnotification($data));
    }

    /**
     * Handle the Medicineinformation "restored" event.
     *
     * @param  \App\Models\Medicineinformation  $medicineinformation
     * @return void
     */
    public function restored(Medicineinformation $medicineinformation)
    {
        //
    }

    /**
     * Handle the Medicineinformation "force deleted" event.
     *
     * @param  \App\Models\Medicineinformation  $medicineinformation
     * @return void
     */
    public function forceDeleted(Medicineinformation $medicineinformation)
    {
        //
    }
}
