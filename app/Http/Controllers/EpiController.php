<?php

namespace App\Http\Controllers;

use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use App\Models\CadastroEpi;
use App\Models\ControleEpi;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;


class EpiController extends Controller
{

  /**
   * Gera pagina de listagem de epis
   *
   * @return View
   **/
  public function index(): View
  {
    $epis = CadastroEpi::all();
    return view('painel.epis.index', ['epis' => $epis]);
  }

  /**
   * Adiciona epi
   *
   * @param Request $request
   * @return RedirectResponse
   **/
  public function create(Request $request): RedirectResponse
  {
    $data = Arr::add($request->all() ,'uid', config('hashing.uid'));

    $epi = CadastroEpi::create($data);

    if(!$epi){
      return back()->with('error', 'Ocorreu um erro!');
    }

    return back()->with('epi-success', 'EPI cadastrado com sucesso');
  }

  /**
   * Edita epi
   *
   * @param Request $request
   * @param Epi $unidade
   * @return RedirectResponse
   **/
  public function update(Request $request, CadastroEpi $epi): RedirectResponse
  {
    $epi->update($request->all());

    return back()->with('epi-success', 'EPI atualizado com sucesso');

  }

  /**
   * Remove epi
   *
   * @param Epi $user
   * @return RedirectResponse
   **/
  public function delete(CadastroEpi $epi): RedirectResponse
  {
    $epi->delete();

    return redirect()->back()->with('epi-success', 'EPI removido');
  }


  /**
   * Gera pagina de controle de epis
   *
   * @return View
   **/
  public function controleEpi(): View
  {
    $controles = ControleEpi::orderBy('funcionario_id')->get();
    return view('painel.epis.controle', ['controles' => $controles]);
  }

  /**
   * Registra entrega de EPI
   *
   * @param Request $request
   * @param ControleEpi $controle
   * @return RedirectResponse
   **/
  public function registraEntregaEpi(Request $request, ControleEpi $controle){

    
    if(!$controle->id){
      $controle = ControleEpi::create($request->all());
      dd($controle);
    } else {
      $controle->update($request->all());
    }

    return redirect()->back()->with('epi-success', 'Entrega registrada');
  }

  /**
   * Registra entrega de EPI
   *
   * @param ControleEpi $controle
   * @return RedirectResponse
   **/
  public function removeEntregaEpi(ControleEpi $controle){

    $controle->delete();

    return redirect()->back()->with('epi-success', 'Entrega removida');

  }

}