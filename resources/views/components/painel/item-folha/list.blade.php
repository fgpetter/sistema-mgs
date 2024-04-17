  <div class="card">
    <div class="card-body">
      <div class="row">
        <div class="col-12 d-flex justify-content-end mb-3">
          <a href="{{ route('item-folha-insert') }}" class="btn btn-sm btn-success" > 
            <i class="ri-add-line align-bottom me-1"></i> Adicionar 
          </a>
        </div>
      </div>

      @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          {{ session('success') }}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      @endif
      @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
          {{ session('error') }}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      @endif

      <div class="table-responsive" style="min-height: 25vh">
        <table class="table table-responsive table-striped align-middle table-nowrap mb-0">
        <thead>
          <tr>
            <th scope="col" class="d-none d-sm-table-cell" style="width: 1%; white-space: nowrap;">ID</th>
            <th scope="col">Nome</th>
            <th scope="col">Tipo</th>
            <th scope="col">Descricao</th>
            <th scope="col"></th>
          </tr>
        </thead>
        <tbody>
          @forelse ($itensFolha as $itemFolha)
            <tr>
              <th scope="row" class="d-none d-sm-table-cell">
                <a href="{{ route('item-folha-insert', ['itemFolha' => $itemFolha->uid]) }}" class="fw-medium">
                   #{{ substr($itemFolha->uid, 7) }} 
                  </a>
                </th>
              <td>{{ Str::title($itemFolha->nome) }}</td>
              <td>{{ Str::title($itemFolha->tipo_evento) }}</td>
              <td>{{ Str::title($itemFolha->descricao) }}</td>
              <td>
                <div class="dropdown">
                  <a href="#" role="button" id="dropdownMenuLink1" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="ph-dots-three-outline-vertical" style="font-size: 1.5rem" 
                      data-bs-toggle="tooltip" data-bs-placement="top" title="Detalhes e edição"></i>
                  </a>
                  <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink1">
                    <li><a class="dropdown-item" href="{{route('item-folha-insert', ['itemFolha' => $itemFolha->uid])}}">Editar</a></li>
                    <li>
                      <form method="POST" action="{{ route('item-folha-delete', $itemFolha->uid) }}">
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
              <td colspan="5" class="text-center" > Não há itens cadsatrados. </td>
            </tr>
          @endforelse
        </tbody>
        </table>
      </div>

    </div>
  </div>