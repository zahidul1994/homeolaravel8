<?php

namespace App\Observers;

use App\Models\Disease;
use App\Models\Superadmin;
use Illuminate\Support\Facades\Auth;
use App\Notifications\Superadminnotification;

class DiseaseObserver
{
    /**
     * Handle the Disease "created" event.
     *
     * @param  \App\Models\Disease  $disease
     * @return void
     */
    public function created(Disease $disease)
    {
        $data = [
            
            'superadminboady' =>'<a class="black-text"  href="'. url('/superadmin/editdisease/'.$disease->id) . '">'.Auth::user()->name .' create ' .$disease->diseasename. '</a>',
  ];
      $superAdmins = Superadmin::first();
     
          $superAdmins->notify(new Superadminnotification($data));
    }

    /**
     * Handle the Disease "updated" event.
     *
     * @param  \App\Models\Disease  $disease
     * @return void
     */
    public function updated(Disease $disease)
    {
        $data = [
            
            'superadminboady' =>'<a class="black-text"  href="'. url('/superadmin/editdisease/'.$disease->id) . '">'.Auth::user()->name .' Update ' .$disease->diseasename. '</a>',
  ];
      $superAdmins = Superadmin::first();
     
          $superAdmins->notify(new Superadminnotification($data));
    }

    /**
     * Handle the Disease "deleted" event.
     *
     * @param  \App\Models\Disease  $disease
     * @return void
     */
    public function deleted(Disease $disease)
    {
        $data = [
            
            'superadminboady' =>'<a class="black-text"  href="'. url('/superadmin/editdisease/'.$disease->id) . '">'.Auth::user()->name .' delete ' .$disease->diseasename. '</a>',
  ];
      $superAdmins = Superadmin::first();
     
          $superAdmins->notify(new Superadminnotification($data));
    }

    /**
     * Handle the Disease "restored" event.
     *
     * @param  \App\Models\Disease  $disease
     * @return void
     */
    public function restored(Disease $disease)
    {
        //
    }

    /**
     * Handle the Disease "force deleted" event.
     *
     * @param  \App\Models\Disease  $disease
     * @return void
     */
    public function forceDeleted(Disease $disease)
    {
        //
    }
}
