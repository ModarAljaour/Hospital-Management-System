<?php

use Illuminate\Support\Facades\Broadcast;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});


// private channel for doctor when create invoice ::
Broadcast::channel('create-invoice.{doctor_id}', function ($user, $doctor_id) {
    return (int) $user->id === (int) $doctor_id;
},
    ['guards' => ['web', 'admin', 'patient', 'doctor', 'ray_employee', 'laboratory_employee', 'api']]
);
//......................................................

Broadcast::channel('my-channel', function () {
    return true;
});

