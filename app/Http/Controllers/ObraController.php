<?php

namespace App\Http\Controllers;

use App\Models\Obra;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;


class ObraController extends Controller
{
    /**
     * Gera pagina de listagem de obras
     *
     * @return View
     **/
    public function index(): View
    {
        return view('painel.obras.index', ['obras' => Obra::all()]);
    }

    /**
     * Adiciona obra
     *
     * @param Request $request
     * @return RedirectResponse
     **/
    public function create(Request $request, Obra $obra): RedirectResponse
    {
        Obra::updateOrCreate([
            'id' => $obra->id
        ],[
            'nome' => $request->nome
        ]);

        return back()->with('obra-success', 'Obra cadastrada com sucesso');
    }

    /**
     * Remove obra
     *
     * @param Obra $obra
     * @return RedirectResponse
     **/
    public function delete(Obra $obra): RedirectResponse
    {
        return back()->with('obra-success', 'Obra removidaa com sucesso');
    }
}
