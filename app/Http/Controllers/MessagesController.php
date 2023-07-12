<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;

class MessagesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $messages = Message::all();
        return view('messages', compact('messages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('user_message');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'm_title' => 'required',
            'm_body' => 'required',
            'm_photo' => 'max:1999',
            'm_username' => 'required',
        ]);

        $message = new Message();
        $message->m_title = $request->input('m_title');
        $message->m_body = $request->input('m_body');
        $message->m_username = $request->input('m_username');
        $message->m_photo = $request->input('img');
        $message->save();

        return redirect('/messages/create')->with('success', 'Thanks for the Message!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
