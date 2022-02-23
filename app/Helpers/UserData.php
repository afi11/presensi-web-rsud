<?php

use App\Models\User;
use Illuminate\Support\Facades\Session;

function isLogin() {
    $state = false;
    if(Session::get('userid') != null){
        $state = true;
    }
    return $state;
}
