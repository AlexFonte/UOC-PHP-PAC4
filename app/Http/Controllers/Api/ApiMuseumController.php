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
        $lastPage = (int) ceil($total / $this->perPage); //calcula la última página i redondea hacia arriba

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
        $museum = Museum::with('topics')->find($id);

        if (!$museum) {
            abort(404);
        }

        return response()->json([$museum]);
    }

    public function topic(int $id, int $page): JsonResponse
    {
        if ($page < 1) {
            abort(404);
        }

        $topic = Topic::find($id);

        if (!$topic) {
            abort(404);
        }

        $total = $topic->museums()->count();
        $lastPage = (int) ceil($total / $this->perPage);

        if ($total === 0) {
            abort(404);
        }

        if ($page > $lastPage) {
            abort(404);
        }

        $items = $topic->museums()
            ->select('museums.id', 'museums.name', 'museums.city')
            ->orderBy('museums.id')
            ->skip(($page - 1) * $this->perPage)
            ->take($this->perPage)
            ->get();

        return response()->json([
            'page' => $page,
            'last_page' => $lastPage,
            'total' => $total,
            'topic' => [
                'id' => $topic->id,
                'name' => $topic->name,
            ],
            'museums' => $items,
        ]);
    }
}
