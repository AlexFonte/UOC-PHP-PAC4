<?php

namespace App\Http\Controllers;

use App\Models\Museum;
use App\Http\Controllers\Controller;
class MuseumController extends Controller
{
    //pagina principal obtener 5 museos
    public function home()
    {
        // 2 fijos (los 2 creados en Actividad 3)
        $fixed = Museum::orderBy('id')->take(2)->get();

        // 3 aleatorios, excluyendo los fijos
        $random = Museum::whereNotIn('id', $fixed->pluck('id'))
            ->inRandomOrder()
            ->take(3)
            ->get();

        //concatenar colecciones de museos
        $museums = $fixed->concat($random);

        //devolver vista con museos
        return view('home', compact('museums'));
    }

    public function show(int $id)
    {
        //obterner museo por id, con sus temcaticas
        $museum = Museum::with('topics')->findOrFail($id);
        //devolver vista con museo
        return view('museum.show', compact('museum'));
    }
}
