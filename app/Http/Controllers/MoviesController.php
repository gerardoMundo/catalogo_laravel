<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use function Webmozart\Assert\Tests\StaticAnalysis\validArrayKey;

class MoviesController extends Controller
{
    public function index()
    {
        $movies = DB::table('movies')->get();
        return response()->json($movies, 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }


    public function store(Request $request)
    {

        $request->validate([
            'title' => 'required|string|max:255',
            'synopsis' => 'required|string',
            'year' => 'required|integer',
            'cover' => 'required|string'
        ]);

        $newMovie = DB::table('movies')->insertGetId([
            'title' => $request->input('title'),
            'synopsis' => $request->input('synopsis'),
            'year' => $request->input('year'),
            'cover' => $request->input('cover'),
        ]);

        return response()->json(['message' => 'Película creada con éxito', 'id' => $newMovie], 201);
    }


    public function show(string $id)
    {
        $movieById = DB::table('movies')->where('id', $id)->first();

        if (!$movieById) {
            return response()->json(['error' => 'Película no encontrada'], 404); // Devuelve 404 si la película no existe
        }

        return response()->json($movieById, 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }


    public function update(Request $request, Movie $movie)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'synopsis' => 'required|string',
            'year' => 'required|integer',
            'cover' => 'required|string'
        ]);

        $movie->update([
            'title' => $request->input('title'),
            'synopsis' => $request->input('synopsis'),
            'year' => $request->input('year'),
            'cover' => $request->input('cover'),
        ]);

        return response()->json(['message' => 'Se actualizó el registro'], 201);
    }


    public function destroy(Movie $movie)
    {
        $movie->delete();
        return response()->json(['message' => 'Se eliminó el registro'], 201);
    }
}
