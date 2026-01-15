<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Museum;
use App\Models\Topic;
use Illuminate\Http\JsonResponse;

class ApiMuseumController extends Controller
{

    private int $perPage = 5;

    //Obtener la lista de museos paginada
    public function museums(int $page): JsonResponse
    {
        // Si la pagina es menor que 1, error 404
        if ($page < 1) {
            abort(404);
        }

        //Obtener total de museos y calcular la última página
        $total = Museum::count();
        $lastPage = (int)ceil($total / $this->perPage); //calcula la última página i redondea hacia arriba

        // Si no hay museos, la página 1 es la única válida
        if ($total === 0) {
            abort(404);
        }

        // Si la página selectionada es mayor que la última página, error 404
        if ($page > $lastPage) {
            abort(404);
        }

        //Obtener los museos de la página solicitada
        $items = Museum::query()
            ->orderBy('id')
            ->skip(($page - 1) * $this->perPage)
            ->take($this->perPage)
            ->get();

        //Devolvemos los la lista de museos de la pagina solicitada en formato JSON
        //Me he tomado la libertad de añadir el total y la última página para facilitar la paginación para la api
        return response()->json([
            'page' => $page,
            'last_page' => $lastPage,
            'total' => $total,
            'museums' => $items
        ]);
    }

    public function museum(int $id): JsonResponse
    {
        $museum = Museum::with('topics')->find($id); // Obtenemos el museo con sus temáticas
        // Si no existe, error 404
        if (!$museum) {
            abort(404);
        }
        // Devolvemos el museo en formato JSON
        return response()->json([$museum]);
    }

    public function topic(int $id, int $page): JsonResponse
    {
        //Si la pagina es menor que 1, error 404
        if ($page < 1) {
            abort(404);
        }

        //Obtener la temática
        $topic = Topic::find($id);

        //Si no existe la temática, error 404
        if (!$topic) {
            abort(404);
        }
        //Obtener total de museos de la temática para calcular la última página
        $total = $topic->museums()->count();
        $lastPage = (int)ceil($total / $this->perPage);

        //Si no hay museos en la temática, error 404
        if ($total === 0) {
            abort(404);
        }

        //Si la página seleccionada es mayor que la última página, error 404
        if ($page > $lastPage) {
            abort(404);
        }

        //Obtener los museos de la temática en la página indicada
        $items = $topic->museums()
            ->select('museums.id', 'museums.name', 'museums.city') // Seleccionamos solo los campos necesarios
            ->orderBy('museums.id')
            ->skip(($page - 1) * $this->perPage) // Satlamos los museos de las páginas anteriores
            ->take($this->perPage) // Obtemenos  los museos de la página actual
            ->get();

        //Devolvemos los museos de la temática en la página solicitada en formato JSON
        //Me he tomado la libertad de añadir el total y la última página para facilitar la paginación para la api
        return response()->json([
            'page' => $page,
            'last_page' => $lastPage,
            'total' => $total,
            'topic' => [
                'id' => $topic->id,
                'name' => $topic->name,
            ],
            'museums' => $items, //lista de museos
        ]);
    }
}
