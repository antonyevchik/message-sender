<?php

namespace App\Http\Controllers;

use App\Events\MessageSent;
use App\Models\Message;
use App\Models\User;
use App\Http\Requests\MessageStoreRequest;
use Inertia\Inertia;

class MessagesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(User $user)
    {
        return Inertia::render('messages/Index', [
            'user' => $user,
            'messages' => Message::between(auth()->id(), $user->id)
                ->take(100)
                ->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MessageStoreRequest $request, User $user)
    {
        $validated = $request->validated();
        $message = Message::create([
            'sender_id' => auth()->id(),
            'recipient_id' => $user->id,
            'body' => $validated['body']
        ]);

        MessageSent::dispatch($message);
    }
}
