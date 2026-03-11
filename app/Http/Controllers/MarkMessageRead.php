<?php

namespace App\Http\Controllers;

use App\Models\Message;

class MarkMessageRead extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Message $message)
    {
        try {
            info("Message: ", $message->toArray());
            if ($message->recipient_id === auth()->id()) {
                $message->update([
                    'read_at' => now()
                ]);
            }
        } catch (\Exception $e) {
            report($e);
        }
    }
}
