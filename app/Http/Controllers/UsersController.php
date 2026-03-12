<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('users/Index', [
            'users' => User::query()
                ->withUnreadMessagesFor(auth()->id())
                ->paginate(50)
        ]);
    }
}
