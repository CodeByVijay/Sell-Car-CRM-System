<?php

namespace App\Providers;

use App\Models\MailSetting;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Config;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $mailSetting = MailSetting::where('status', 1)->first();
        if ($mailSetting) {
            $data = [
                'driver' => $mailSetting->mailer,
                'host' => $mailSetting->host,
                'port' => $mailSetting->port,
                'encryption' => $mailSetting->encryption,
                'username' => $mailSetting->username,
                'password' => $mailSetting->password,
                'from' => [
                    'address' => $mailSetting->from_address,
                    'name' => $mailSetting->from_name
                ]
            ];
            Config::set('mail', $data);
        }
    }
}
