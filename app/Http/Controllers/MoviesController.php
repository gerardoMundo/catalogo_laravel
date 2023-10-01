<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use function Webmozart\Assert\Tests\StaticAnalysis\validArrayKey;

class MoviesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
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

    /**
     * Store a newly created resource in storage.
     */
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

    /**
     * Display the specified resource.
     */
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
