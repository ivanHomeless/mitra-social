<?php


namespace App\Http\Responses;

use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;



class LoginResponse implements LoginResponseContract
{
    /**
     * Create an HTTP response that represents the object.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function toResponse($request): \Symfony\Component\HttpFoundation\Response
    {
        return $request->wantsJson()
            ? response()->json(['two_factor' => false])
            : response()->json(['hello' => false]);
    }
}
