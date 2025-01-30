<?php 

if(!function_exists('moonshine_user')) {
    function moonshine_user() {
        return Illuminate\Support\Facades\Auth::user();
    }
}

if(!function_exists('moonshine_role')) {
    function moonshine_role() {
        return Illuminate\Support\Facades\Auth::user()->moonshineUserRole;
    }
}

if(!function_exists('moonshine_role_name')) {
    function moonshine_role_name() {
        if(Illuminate\Support\Facades\Auth::user()) {
            return Illuminate\Support\Facades\Auth::user()->moonshineUserRole->name;
        }

        return null;
    }
}