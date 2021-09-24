<?php

namespace App\Providers;
use App\Models\Blog;
use App\Models\User;
use App\Models\Admin;
use App\Models\Contact;
use App\Models\Disease;
use App\Models\Category;
use App\Models\Medicine;
use App\Models\Disemedicine;
use App\Observers\BlogObserver;
use App\Observers\UserObserver;
use App\Observers\AdminObserver;
use App\Observers\ContactObserver;
use App\Observers\DiseaseObserver;
use App\Models\Medicineinformation;
use App\Observers\CategoryObserver;
use App\Observers\MedicineObserver;
use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Registered;
use App\Observers\DisemedicineObserver;
use App\Observers\MedicineinformationObserver;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        Admin::observe(AdminObserver::class);
        User::observe(UserObserver::class);
        Category::observe(CategoryObserver::class);
        Contact::observe(ContactObserver::class);
        Disease::observe(DiseaseObserver::class);
        Disemedicine::observe(DisemedicineObserver::class);
        Medicineinformation::observe(MedicineinformationObserver::class);
       Medicine::observe(MedicineObserver::class);
        Blog::observe(BlogObserver::class);
     
    }
}
