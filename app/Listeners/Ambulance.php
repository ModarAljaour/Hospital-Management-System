<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class Ambulance
{

    public function __construct()
    {
        //
    }

    public function handle($ambulance)
    {
        foreach ($ambulance as $a){
           dd($a->id);
        }
    }

}
