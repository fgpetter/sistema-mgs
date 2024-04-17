<?php

namespace App\Http\Controllers;

use App\Models\ItemFolha;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;


class ItemFolhaController extends Controller
{

  /**
   * Gera pagina de listagem de itens de folha
   *
   * @return View
   **/
  public function index(): View
  {
    $itensFolha = ItemFolha::all();
    return view('painel.item-folha.index', ['itensFolha' => $itensFolha]);
  }

  /**
   * Tela de edição de item de folha
   *
   * @param ItemFolha $itemFolha
   * @return View
   **/
  public function insert(ItemFolha $itemFolha): View|RedirectResponse
  {
    return view('painel.item-folha.insert', ['itemFolha' => $itemFolha]);
  }

  /**
   * Adiciona item de folha
   *
   * @param Request $request
   * @return RedirectResponse
   **/
  public function create(Request $request): RedirectResponse
  {
    $data = Arr::add($request->all() ,'uid', config('hashing.uid'));

    $itemFolha = ItemFolha::create($data);

    if(!$itemFolha){
      return back()->with('error', 'Ocorreu um erro!');
    }

    return redirect()->route('item-folha-index')->with('success', 'Item cadastrado com sucesso');
  }

  /**
   * Edita item de folha
   *
   * @param Request $request
   * @param Beneficio $unidade
   * @return RedirectResponse
   **/
  public function update(Request $request, ItemFolha $itemFolha): RedirectResponse
  {
    $itemFolha->update($request->all());

    return back()->with('success', 'Item atualizado com sucesso');

  }

  /**
   * Remove item de folha
   *
   * @param Beneficio $user
   * @return RedirectResponse
   **/
  public function delete(ItemFolha $itemFolha): RedirectResponse
  {
    $itemFolha->delete();

    return redirect()->back()->with('success', 'Item removido');
  }

}