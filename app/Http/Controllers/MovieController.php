<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $movies = Movie::latest()->paginate(10);
        return view('movies.index', compact('movies'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255|unique:movies',
            'synopsis' => 'required|string',
            'genre' => 'required|string|max:100',
            'director' => 'required|string|max:150',
            'release_date' => 'required|date',
            'rating' => 'required|integer|min:1|max:5',
            'duration_minutes' => 'required|integer|min:1',
            'poster_image' => 'nullable|image',
        ]);

        if ($request->hasFile('poster_image')) {
            $imagePath = $request->file('poster_image')->store('posters', 'public');
            $validatedData['poster_image'] = $imagePath;
        }

        $validatedData['slug'] = Str::slug($validatedData['title']);
        Movie::create($validatedData);

        return redirect()->route('movies.index')->with('success', 'Movie added successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Movie $movie)
    {
        // This is correct for the fetch requests
        return response()->json($movie);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Movie $movie)
    {
        try {
            $validatedData = $request->validate([
                'title' => ['required','string','max:255', Rule::unique('movies')->ignore($movie->id)],
                'synopsis' => 'required|string',
                'genre' => 'required|string|max:100',
                'director' => 'required|string|max:150',
                'release_date' => 'required|date',
                'rating' => 'required|integer|min:1|max:5',
                'duration_minutes' => 'required|integer|min:1',
                'poster_image' => 'nullable|image',
            ]);

            if ($request->hasFile('poster_image')) {
                if ($movie->poster_image) {
                    Storage::disk('public')->delete($movie->poster_image);
                }
                $imagePath = $request->file('poster_image')->store('posters', 'public');
                $validatedData['poster_image'] = $imagePath;
            }

            $validatedData['slug'] = Str::slug($validatedData['title']);
            $movie->update($validatedData);

            return redirect()->route('movies.index')->with('success', 'Movie updated successfully!');

        } catch (\Illuminate\Validation\ValidationException $e) {
            // --- THIS IS THE FIX ---
            // If validation fails, redirect back with the form type and ID
            return redirect()->back()
                ->withErrors($e->errors())
                ->withInput()
                ->with('form_type', 'edit') // Tell the script it was an edit form
                ->with('movie_id', $movie->id); // Tell the script which movie
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Movie $movie)
    {
        if ($movie->poster_image) {
            Storage::disk('public')->delete($movie->poster_image);
        }
        $movie->delete();
        return redirect()->route('movies.index')->with('success', 'Movie deleted successfully.');
    }
}
