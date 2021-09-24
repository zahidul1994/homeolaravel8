<?php

namespace App\Observers;

use App\Models\Superadmin;
use App\Models\Disemedicine;
use Illuminate\Support\Facades\Auth;
use App\Notifications\Superadminnotification;

class DisemedicineObserver
{
    /**
     * Handle the Disemedicine "created" event.
     *
     * @param  \App\Models\Disemedicine  $disemedicine
     * @return void
     */
    public function created(Disemedicine $disemedicine)
    {
        $data = [
            
            'superadminboady' =>'<a class="black-text"  href="'. url('/superadmin/editdisemedicinelist/'.$disemedicine->id) . '">'.Auth::user()->name .' create ' .$disemedicine->medicine. '</a>',
  ];
      $superAdmins = Superadmin::first();
     
          $superAdmins->notify(new Superadminnotification($data));
    }

    /**
     * Handle the Disemedicine "updated" event.
     *
     * @param  \App\Models\Disemedicine  $disemedicine
     * @return void
     */
    public function updated(Disemedicine $disemedicine)
    {
        $data = [
            
            'superadminboady' =>'<a class="black-text"  href="'. url('/superadmin/editdisemedicinelist/'.$disemedicine->id) . '">'.Auth::user()->name .' Update ' .$disemedicine->medicine. '</a>',
  ];
      $superAdmins = Superadmin::first();
     
          $superAdmins->notify(new Superadminnotification($data));
    }

    /**
     * Handle the Disemedicine "deleted" event.
     *
     * @param  \App\Models\Disemedicine  $disemedicine
     * @return void
     */
    public function deleted(Disemedicine $disemedicine)
    {
        $data = [
            
            'superadminboady' =>'<a class="black-text"  href="'. url('/superadmin/editdisemedicinelist/'.$disemedicine->id) . '">'.Auth::user()->name .' Delete ' .$disemedicine->medicine. '</a>',
  ];
      $superAdmins = Superadmin::first();
     
          $superAdmins->notify(new Superadminnotification($data));
    }

    /**
     * Handle the Disemedicine "restored" event.
     *
     * @param  \App\Models\Disemedicine  $disemedicine
     * @return void
     */
    public function restored(Disemedicine $disemedicine)
    {
        //
    }

    /**
     * Handle the Disemedicine "force deleted" event.
     *
     * @param  \App\Models\Disemedicine  $disemedicine
     * @return void
     */
    public function forceDeleted(Disemedicine $disemedicine)
    {
        //
    }
}
