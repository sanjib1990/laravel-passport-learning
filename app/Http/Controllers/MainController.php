<?php

namespace App\Http\Controllers;

use App\Models\Main;

/**
 * Class MainController
 *
 * @package App\Http\Controllers
 */
class MainController extends Controller
{
    /**
     * @var Main
     */
    private $main;

    /**
     * MainController constructor.
     *
     * @param Main $main
     */
    public function __construct(Main $main)
    {
        $this->main = $main;
    }

    /**
     * Get all resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        if (request()->main) {
            return $this->show();
        }

        $data = $this->main->getList(request()->all());

        return response()->json($data);
    }

    /**
     * Create a resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store()
    {
        return response()->json($this->main->create(['main' => request()->get('main')]));
    }

    /**
     * Update a resource.
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function update()
    {
        request()->main->update(['main' => request()->get('mains')]);

        return response(null, 205);
    }

    /**
     * Delete a resource.
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function destroy()
    {
        request()->main->delete();

        return response(null, 204);
    }

    /**
     * Get a specific Resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    private function show()
    {
        return response()->json(request()->main);
    }
}
