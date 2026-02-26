<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Chirp;

class ChirpsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $dump_chirps = [
            ['id' => 1, 'author' => 'John Doe', 'message' => 'Hello World!', 'time'=> '1hour ago'],
            ['id' => 2, 'author' => 'Jane Doe', 'message' => 'Laravel is awesome!', 'time'=> '2hours ago'],
        ];

        $chirps = Chirp::with('user')
            ->latest()
            ->take(50)  // Limit to 50 most recent chirps
            ->get();

        return view('home', ['chirps' => $chirps]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validated = $request->validate([
            'message' => 'required|string|max:255|min:5',
        ], [
            'message.required' => 'The message field is required.',
            'message.string' => 'please use only a string.',
            'message.max' => 'Too many characters, the message may not be greater than 255 characters.',
            'message.min' => 'The message is short, must be at least 5 characters.',
        ]);

        // Chirp::create([
        //     'message' => $validated['message'],
        //     // 'user_id' => auth()->id(), // Associate chirp with authenticated user
        // ]);

        // funziona uguale a sopra
        // $chirp = new Chirp();
        // $chirp->message = $validated['message'];
        // //$chirp->user_id = auth()->id();
        // $chirp->save();

        // insert con id user associato
        auth()->user()->chirps()->create($validated);

        return redirect('/')->with('success', 'Chirp created successfully!');

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
    public function edit(Chirp $chirp)
    {
        // return view('chirps.edit', ['chirp' => $chirp]);
        return view('chirps.edit', compact('chirp') );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Chirp $chirp)
    {
        //
        //
        $validated = $request->validate([
            'message' => 'required|string|max:255|min:5',
        ], [
            'message.required' => 'The message field is required.',
            'message.string' => 'please use only a string.',
            'message.max' => 'Too many characters, the message may not be greater than 255 characters.',
            'message.min' => 'The message is short, must be at least 5 characters.',
        ]);

        
        // Update the existing chirp
        $chirp->update($validated);

        // $chirp->message = $validated['message'];
        // //$chirp->user_id = auth()->id();
        // $chirp->save();

        return redirect('/')->with('success', 'Chirp updated successfully!');


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Chirp $chirp)
    {
        $chirp->delete();
        return redirect('/')->with('success', 'Chirp deleted successfully!');
    }
}
