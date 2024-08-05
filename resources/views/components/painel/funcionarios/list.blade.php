@php
    $order_name = 'DESC';
    if (isset($_GET['name']) && $_GET['name'] == 'DESC') {
        $order_name = 'ASC';
    }
    if (isset($_GET['buscanome'])) {
        $busca_nome = $_GET['buscanome'];
    }
@endphp

<div class="card">
  <div class="card-body">
    <div class="row">
      <div class="col-12 d-flex justify-content-end mb-3">
        <a href="{{ route('funcionario-insert') }}" class="btn btn-sm btn-success" > 
          <i class="ri-add-line align-bottom me-1"></i> Adicionar 
        </a>
      </div>
    </div>

    @if (session('funcionario-success'))
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('funcionario-success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    @endif
    @if (session('funcionario-error'))
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('funcionario-error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    @endif

    <div class="table-responsive" style="min-height: 25vh">
      <table class="table table-responsive table-striped align-middle table-nowrap mb-0">
      <thead>
        <tr>
          <th scope="col"></th>
          <th scope="col">
            <input type="text" class="form-control form-control-sm"
              onkeypress="search(event, window.location.href, 'buscanome')"
              placeholder="Buscar por nome" value="{{ $busca_nome ?? null }}">
            </th>
          <th scope="col"></th>
          <th scope="col"></th>
          <th scope="col"></th>
        </tr>
      </thead>

      <thead>
        <tr>
          <th scope="col" class="d-none d-sm-table-cell" style="width: 1%; white-space: nowrap;">ID</th>
          <th scope="col">
            <a href="{{ route('funcionario-index', ['name' => $order_name]) }}">
              {!! $order_name == 'ASC' ? '<i class="ri-arrow-up-s-line"></i>' : '<i class="ri-arrow-down-s-line"></i>' !!}
              &nbsp Nome
            </a>
          </th>
          <th scope="col">Cargo</th>
          <th scope="col">Função</th>
          <th scope="col">Situação</th>
          <th scope="col"></th>
        </tr>
      </thead>
      <tbody>
        @forelse ($funcionarios as $funcionario)
          <tr>
            <th scope="row" class="d-none d-sm-table-cell">
              <a href="{{ route('funcionario-insert', ['funcionario' => $funcionario->uid]) }}" class="fw-medium">
                  #{{ substr($funcionario->uid, 7) }} 
                </a>
              </th>
            <td>{{$funcionario->nome}}</td>
            <td>{{ Str::title($funcionario->cargo) }}</td>
            <td>{{ Str::title($funcionario->funcao) }}</td>
            <td>{{ Str::upper($funcionario->situacao) }}</td>
            <td>
              <div class="dropdown">
                <a href="#" role="button" id="dropdownMenuLink1" data-bs-toggle="dropdown" aria-expanded="false">
                  <i class="ph-dots-three-outline-vertical" style="font-size: 1.5rem" 
                    data-bs-toggle="tooltip" data-bs-placement="top" title="Detalhes e edição"></i>
                </a>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink1">
                  <li><a class="dropdown-item" href="{{route('funcionario-insert', ['funcionario' => $funcionario->uid])}}">Editar</a></li>
                  <li><a class="dropdown-item" href="{{route('lancamento-ponto-index', ['funcionario' => $funcionario->uid])}}">Ponto</a></li>
                  <li>
                    <form method="POST" action="{{ route('funcionario-delete', $funcionario->uid) }}">
                      @csrf
                      <button class="dropdown-item" type="submit">Deletar</button>
                    </form>
                  </li>
                </ul>
              </div>

            </td>
          </tr>
        @empty
          <tr>
            <td colspan="6" class="text-center" > Não há funcionarios na base. </td>
          </tr>
        @endforelse
      </tbody>
      </table>
    </div>

  </div>
</div>