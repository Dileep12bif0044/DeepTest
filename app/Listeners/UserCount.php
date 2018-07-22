<?php

namespace App\Listeners;

use App\Events\UserViewNote;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\Note;
use Auth;

class UserCount
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  UserViewNote  $event
     * @return void
     */
    public function handle(UserViewNote $event)
    {
        $note = Note::where('notes.id', $event->id)
                    ->orWhere('notes.slug', $event->slug)
                    ->first();

        $note2 = array();
        if (count(json_decode($note->users_views)) == 0) {
            $note2 [] = (string)auth()->id();
        }
        else {
            $note2 = json_decode($note->users_views);
            $flag = 0;
            foreach ($note2 as $a) {
                if ($a == (string)auth()->id()) {
                    $flag++;
                }
            }
            if (!$flag) {
                $note2 [] = (string)auth()->id();
            }
            /*if(in_array((string)auth()->id(), $note2)) {
                dd("dileep");
                $note2 [] = (string)auth()->id();
            }*/
                // dd("kumar");
        }

        $note->users_views = json_encode($note2);
        $note->save();
    }
}
