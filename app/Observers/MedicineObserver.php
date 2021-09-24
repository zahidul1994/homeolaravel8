<?php

namespace App\Observers;

use App\Models\Medicine;
use App\Models\Superadmin;
use Illuminate\Support\Facades\Auth;
use App\Notifications\Superadminnotification;

class MedicineObserver
{
    /**
     * Handle the Medicine "created" event.
     *
     * @param  \App\Models\Medicine  $medicine
     * @return void
     */
    public function created(Medicine $medicine)
    {
        $data = [
            
            'superadminboady' =>'<a class="black-text"  href="'. url('/superadmin/editmedicineinformation/'.$medicine->id) . '">'.Auth::user()->name .' create ' .$medicine->medicine. '</a>',
  ];
      $superAdmins = Superadmin::first();
     
          $superAdmins->notify(new Superadminnotification($data));
    }

    /**
     * Handle the Medicine "updated" event.
     *
     * @param  \App\Models\Medicine  $medicine
     * @return void
     */
    public function updated(Medicine $medicine)
    {
        $data = [
            
            'superadminboady' =>'<a class="black-text"  href="'. url('/superadmin/editmedicineinformation/'.$medicine->id) . '">'.Auth::user()->name .' Update ' .$medicine->medicine. '</a>',
  ];
      $superAdmins = Superadmin::first();
     
          $superAdmins->notify(new Superadminnotification($data));
    }

    /**
     * Handle the Medicine "deleted" event.
     *
     * @param  \App\Models\Medicine  $medicine
     * @return void
     */
    public function deleted(Medicine $medicine)
    {
        $data = [
            
            'superadminboady' =>'<a class="black-text"  href="'. url('/superadmin/editmedicineinformation/'.$medicine->id) . '">'.Auth::user()->name .' Delete ' .$medicine->medicine. '</a>',
  ];
      $superAdmins = Superadmin::first();
     
          $superAdmins->notify(new Superadminnotification($data));
    }

    /**
     * Handle the Medicine "restored" event.
     *
     * @param  \App\Models\Medicine  $medicine
     * @return void
     */
    public function restored(Medicine $medicine)
    {
        //
    }

    /**
     * Handle the Medicine "force deleted" event.
     *
     * @param  \App\Models\Medicine  $medicine
     * @return void
     */
    public function forceDeleted(Medicine $medicine)
    {
        //
    }
}
