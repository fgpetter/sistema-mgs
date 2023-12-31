<?php

namespace App\Http\Controllers;

use App\Models\Beneficio;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use App\Models\CadastroBeneficio;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;


class BeneficioController extends Controller
{

  /**
   * Gera pagina de listagem de beneficios
   *
   * @return View
   **/
  public function index(): View
  {
    $beneficios = CadastroBeneficio::all();
    return view('painel.beneficios.index', ['beneficios' => $beneficios]);
  }

  /**
   * Tela de edição de beneficio
   *
   * @param CadastroBeneficio $beneficio
   * @return View
   **/
  public function insert(CadastroBeneficio $beneficio): View|RedirectResponse
  {
    return view('painel.beneficios.insert', ['beneficio' => $beneficio]);
  }

  /**
   * Adiciona beneficio
   *
   * @param Request $request
   * @return RedirectResponse
   **/
  public function create(Request $request): RedirectResponse
  {
    $data = Arr::add($request->all() ,'uid', config('hashing.uid'));

    $beneficio = CadastroBeneficio::create($data);

    if(!$beneficio){
      return back()->with('error', 'Ocorreu um erro!');
    }

    return redirect()->route('beneficio-index')->with('beneficio-success', 'Benefício cadastrado com sucesso');
  }

  /**
   * Edita beneficio
   *
   * @param Request $request
   * @param Beneficio $unidade
   * @return RedirectResponse
   **/
  public function update(Request $request, CadastroBeneficio $beneficio): RedirectResponse
  {
    $beneficio->update($request->all());

    return back()->with('beneficio-success', 'Benefício atualizado com sucesso');

  }

  /**
   * Remove conta
   *
   * @param Beneficio $user
   * @return RedirectResponse
   **/
  public function delete(CadastroBeneficio $beneficio): RedirectResponse
  {
    $beneficio->delete();

    return redirect()->back()->with('beneficio-success', 'Benefício removido');
  }

}