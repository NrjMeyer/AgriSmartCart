<?php

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

if (! function_exists('customGetLocaleFunction')) {
    function customGetLocaleFunction()
    {
        return 'fr';
    }
}

if (! function_exists('getCurrentUser')) {
    function getcurrentuser()
    {
        $curr_user = User::find(Auth::id());
        return $curr_user;
    }
}