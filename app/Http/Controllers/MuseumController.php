<?php

namespace App\Http\Controllers;

use App\Models\Museum;
use App\Http\Controllers\Controller;
class MuseumController extends Controller
{
    //

    public function home()
    {
        // 2 fijos (los 2 creados en Actividad 3)
        $fixed = Museum::orderBy('id')->take(2)->get();

        // 3 aleatorios, excluyendo los fijos
        $random = Museum::whereNotIn('id', $fixed->pluck('id'))
            ->inRandomOrder()
            ->take(3)
            ->get();

        $museums = $fixed->concat($random);

        return view('home', compact('museums'));
    }

    public function show(int $id)
    {
        $museum = Museum::findOrFail($id);
        $museum->load('topics'); // para mostrar temáticas

        return view('museum.show', compact('museum'));
    }
}
