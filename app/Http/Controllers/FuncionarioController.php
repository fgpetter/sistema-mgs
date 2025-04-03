<?php

namespace App\Http\Controllers;

use App\Models\Obra;
use App\Models\Funcionario;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use App\Models\FuncionarioEpi;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\FuncionarioRequest;
use Illuminate\Database\Eloquent\Builder;
use App\Actions\GenerateDocAdimissaoAction;


class FuncionarioController extends Controller
{
    /**
   * Gera pagina de listagem de usuários
   *
   * @return View
   **/
  public function index(Request $request): View
  {
    $name = $request->name;
    $busca_nome = $request->buscanome;


    $funcionarios = Funcionario::select()
      ->when($name, function (Builder $query, $name) {
        $query->orderBy('nome', $name);
      }, function (Builder $query) {
        $query->orderBy('nome');
      })
      ->when($busca_nome, function (Builder $query, $busca_nome) {
        $query->where('nome', 'LIKE', "%$busca_nome%");
      })
      ->get();

    return view('painel.funcionarios.index', ['funcionarios' => $funcionarios]);
  }

  /**
   * Adiciona usuários na base
   *
   * @param FuncionarioRequest $request
   * @return RedirectResponse
   **/
  public function create(FuncionarioRequest $request): RedirectResponse
  {
    $validated = $request->validated();
    
    $validated = Arr::add($validated,'uid', config('hashing.uid'));

    $funcionario = Funcionario::create($validated);

    if(!$funcionario){
      return back()->with('funcionario-error', 'Ocorreu um erro! Revise os dados e tente novamente');
    }

    return redirect()->route('funcionario-insert', $funcionario)->with('funcionario-success', 'Funcionario cadastrado com sucesso');
  }

  /**
   * Tela de edição de usuário
   *
   * @param Funcionario $funcionario
   * @return View
   **/
  public function insert(Funcionario $funcionario): View|RedirectResponse
  {
    $funcionario['funcoes'] = DB::table('funcionarios')->distinct()->get(['funcao']);
    return view('painel.funcionarios.insert', ['funcionario' => $funcionario, 'obras' => Obra::all()]);
  }

  /**
   * Edita dados de usuário
   *
   * @param FuncionarioRequest $request
   * @param Funcionario $user
   * @return RedirectResponse
   **/
  public function update(FuncionarioRequest $request, Funcionario $funcionario): RedirectResponse
  {
    $funcionario->update($request->validated());

    return redirect()->back()->with('funcionario-success', 'Funcionario atualizado com sucesso');
  }

  /**
   * Remove usuário
   *
   * @param User $user
   * @return RedirectResponse
   **/
    public function delete(Funcionario $funcionario): RedirectResponse
    {
      $funcionario->delete();
      return redirect()->route('funcionario-index')->with('funcionario-success', 'Funcionario removido');
    }

    public function generateDocAdimissao(Funcionario $funcionario)
    {
      $generateDocAdimissaoAction = new GenerateDocAdimissaoAction();
      $filename = $generateDocAdimissaoAction->execute($funcionario);

      return response()->download(storage_path('app/public/docs/' . $filename));
    }

}