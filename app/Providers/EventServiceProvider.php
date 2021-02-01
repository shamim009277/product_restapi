<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use App\Events\BrandCreated;
use App\Events\BrandUpdated;
use App\Events\BrandDeleted;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
use App\Listeners\BrandCashListener;

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
        BrandCreated::class => [
            BrandCashListener::class,
        ],
        BrandUpdated::class => [
            BrandCashListener::class,
        ],
        BrandDeleted::class => [
            BrandCashListener::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
