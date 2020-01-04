<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Auth0IndexController extends Controller
{
    /**
    * Redirect to the Auth0 hosted login page
    *
    * @return mixed
    */
    public function login()
    {
        $authorize_params = [
        'domain' => env('AUTH0_DOMAIN'),
        'client_id' => env('AUTH0_CLIENT_ID'),
        'client_secret' => 'rirPM1UaDu0eLlfI3cU88ETOndbqVxj1Dflu5T56xowVxKpBYA7xSn1OlCq7urNA',
        'redirect_uri' => 'http://127.0.0.1:8000',
        'scope' => 'openid profile email',
        ];
        return \App::make('auth0')->login(null, null, $authorize_params);
    }

    /**
    * Log out of Auth0
    *
    * @return mixed
    */
    public function logout()
    {
        \Auth::logout();
        $logoutUrl = sprintf(
        'https://%s/v2/logout?client_id=%s&returnTo=%s',
        env('AUTH0_DOMAIN'),
        env('AUTH0_CLIENT_ID'),
        env('APP_URL'));
        return  \Redirect::intended($logoutUrl);
    }
}
