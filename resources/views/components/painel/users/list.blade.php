  <div class="card">
    <div class="card-header">
      <h4 class="card-title mb-0">Usuários</h4>
    </div><!-- end card header -->
    <div class="card-body">
    @if (session('update-success'))
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('update-success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    @endif

    <div class="table-responsive" style="min-height: 25vh">
      <table class="table table-striped align-middle table-nowrap mb-0">
      <thead>
        <tr>
          <th scope="col">ID</th>
          <th scope="col">Nome</th>
          <th scope="col">Perfil</th>
          <th scope="col">Permissões</th>
          <th scope="col"></th>
        </tr>
      </thead>
      <tbody>
        @forelse ($users as $user)
          <tr>
            <th scope="row"><a href="{{ route('user-edit', ['user' => $user['id']]) }}" class="fw-medium"> #{{$user['id']}} </a></th>
            <td>{{$user['name']}}</td>
            <td>Usuário</td>
            <td class="text-wrap">Painel | Editar | Incluir | Área do cliente | Usuários</td>
            <td>
              <div class="dropdown">
                <a href="#" role="button" id="dropdownMenuLink1" data-bs-toggle="dropdown" aria-expanded="false">
                  <i class="ph-dots-three-outline-vertical" style="font-size: 1.5rem" 
                    data-bs-toggle="tooltip" data-bs-placement="top" title="Detalhes e edição"></i>
                </a>

                <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink1">
                  <li><a class="dropdown-item" href="{{route('user-edit', ['user' => $user['id']])}}">Edit</a></li>
                  <li>
                    <form method="POST" action="{{ route('user-delete', $user->id) }}">
                      @csrf
                      <button class="dropdown-item" type="submit">Delete</button>
                    </form>
                  </li>
                </ul>
              </div>

            </td>
          </tr>
        @empty
          <tr>
            <td colspan="5" class="text-center" > Não há usuários na base. </td>
          </tr>
        @endforelse
      </tbody>
      </table>
    </div>

    </div>
  </div>