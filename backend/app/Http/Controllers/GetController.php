<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class GetController extends Controller
{
    public function index(): int
    {
        $user = User::find(1);
        dump($user->birth->format('Y'));
    }
}
