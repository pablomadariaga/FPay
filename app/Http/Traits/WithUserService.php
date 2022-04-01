<?php

namespace App\Http\Traits;

use Illuminate\Support\Facades\Http;

trait WithUserService
{
    /**
     * Get user list
     *
     * @return mixed
     */
    private function getUserList(){
        $response = Http::get(config('app.user_api'));
        if ($response->successful()) {
            return json_decode($response->body());
        }
        if ($response->failed()) {
            $response->throw();
        }
    }

    /**
     * Create a new user
     *
     * @param string $name
     * @param string $avatar
     * @return void
     */
    private function createUser(string $name,string $avatar){
        $response = Http::post(config('app.user_api'),[
            'name' => $name,
            'avatar' => $avatar
        ]);
        if ($response->successful()) {
            return json_decode($response->body());
        }
        if ($response->failed()) {
            $response->throw();
        }
    }
}
