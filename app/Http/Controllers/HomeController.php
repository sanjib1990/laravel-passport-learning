<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;

/**
 * Class HomeController
 *
 * @package App\Http\Controllers
 */
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('auth')->only('index');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function redirect()
    {
        $query = http_build_query([
            'client_id' => '4',
            'redirect_uri' => 'http://localhost:8000/auth/callback',
            'response_type' => 'code',
            'scope' => '',
        ]);

        return redirect('http://laravel55.dev/oauth/authorize?'.$query);
    }

    public function callback()
    {
        $http = new Client();

        $response = $http->post('http://laravel55.dev/oauth/token', [
            'form_params' => [
                'grant_type' => 'authorization_code',
                'client_id' => '4',
                'client_secret' => 'NgrkRVvRMkPF6aELAEIb9hfiaTRXmoZsqqZY1VPI',
                'redirect_uri' => 'http://localhost:8000/auth/callback',
                'code' => request()->code,
            ],
        ]);

        return json_decode((string) $response->getBody(), true);
    }

    public function implicitRedirect()
    {
        $query = http_build_query([
            'client_id' => '5',
            'redirect_uri' => 'http://localhost:8000/auth/implicit/callback',
            'response_type' => 'token',
            'scope' => '',
        ]);

        return redirect('http://laravel55.dev/oauth/authorize?'.$query);
    }

    public function implicitCallback()
    {
        dd(request()->getUri());
    }

    public function generatePersonalToken()
    {
        $this->validate(request(), [
            'scopes' => 'required',
            'token_name' => 'required'
        ]);
        $scopes = collect(explode(',', request('scopes', "")))->map(function ($item) {
            return trim($item);
        });

        return response()->json([
            'token' => auth()->user()->createToken(request('token_name'), $scopes->toArray())->accessToken
        ]);
    }
}
