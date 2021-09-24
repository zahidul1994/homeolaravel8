<?php

namespace App\Observers;

use App\Models\Admin;
use App\Models\Superadmin;
use App\Mail\AdmininfoMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use App\Notifications\Superadminnotification;

class AdminObserver
{
    /**
     * Handle the Admin "created" event.
     *
     * @param  \App\Models\Admin  $admin
     * @return void
     */
    public function created(Admin $admin)
    {
        $data = [
            'name' => $admin['name'],
            'superadminboady' => $admin['name'].' Want to Admin',
    ];
    $superAdmins = Superadmin::first();

        $superAdmins->notify(new Superadminnotification($data));
    $maildata= array(
             
            'name'=> $admin->name,
            'subject'=>'Verify Your Email',
            'message' => 'Your Request Has Been Submit Succesfully. Please  use the code '. $admin->status .  ' for email varification or Click the link '  .'<a target="_blank"  href="'. url('/login/adminvarificationlink/'. $admin->email.'/'. $admin->status) . '">Varify Now</a>'. ' .Thank You',
             );
           
              Mail::to($admin)->send(new AdmininfoMail($maildata));
           
    }

    
}
