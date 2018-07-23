<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Note;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function home()
    {
        session()->flash('message', 'You are loggedIn !!');
        return view('home');
    }

    /*
        Index function is for authenticate user's to listing all himself notes
    */
    public function index()
    {
        $notes = Note::where('user_id', auth()->id())->latest(/*'updated_at', 'DESC'*/)->get();
        return view('all-notes', compact('notes', $notes));
    }
}
