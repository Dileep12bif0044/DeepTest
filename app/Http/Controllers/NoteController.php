<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\NoteRequest;
use App\Models\Note;
use App\User;
Use Auth;
use Bitly;
use App\Events\UserViewNote;

class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $front_url = 'http://127.0.0.1:8000';

    public function index()
    {
        $notes = Note::latest('updated_at', 'DESC')->limit(5)->get();
        return view('welcome', compact('notes', $notes));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('note.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(NoteRequest $request)
    {
        $note = new Note();
        $note->user_id = auth()->id();
        $note->title = $request->title;
        $note->note = $request->note;
        $note->short_url = Bitly::getUrl($this->front_url.'/'.$request->title);
        $note->slug = str_slug($request->title, '-');
        if($note->save()) {
            session()->flash('message', 'Your Note has been Created !!');
            return redirect()->route('notes.create');
        }
        redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id, $slug='')
    {
        if ($id || $slug) {
            event(new UserViewNote($id, $slug));
            $note = Note::join('users', 'users.id', '=', 'notes.user_id')
                        ->where('notes.id', $id)
                        ->orWhere('notes.slug', $slug)
                        ->select('notes.*', 'users.name')
                        ->get();
            if (count($note)) {
                return view('note.show', compact('note', $note));
            }
            return view('not-found');
        }
        else {
            return view('not-found');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $note = Note::find($id);
        return view('note.edit', compact('note', $note));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(NoteRequest $request, $id)
    {
        $note = Note::find($id);
        $note->user_id = auth()->id();
        $note->title = $request->title;
        $note->note = $request->note;
        if($note->save()) {
            session()->flash('message', 'Your Note has been edited');
            return redirect()->route('home.index');
        }
        redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $note = Note::find($id);
        $note->delete();
        session()->flash('message', 'Your Note has been Deleted !');
        return redirect()->route('home.index');
    }
}
