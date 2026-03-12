<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class GetUnreadMessageCounts extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        return User::query()
            ->withUnreadMessagesFor(auth('web')->id())
            ->get(['id'])
            ->mapWithKeys(fn($user) => [
                $user->id => $user->unread_count
            ]);
    }
}
