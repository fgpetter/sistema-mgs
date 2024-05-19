<div class="card">
<div class="card-body">
    <div class="row">
    <div class="col-12 d-flex justify-content-end mb-3">
        <a class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#modal_epi_controle"> 
        <i class="ri-add-line align-bottom me-1"></i> Adicionar 
        </a>
    </div>
    </div>

    @if (session('epi-success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('epi-success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    @if (session('epi-error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('epi-error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <div class="table-responsive" style="min-height: 25vh">
    <table class="table table-responsive table-striped align-middle table-nowrap mb-0">
    <thead>
        <tr>
        <th scope="col">Data</th>
        <th scope="col">Funcionário</th>
        <th scope="col">EPI</th>
        <th scope="col">Tamanho</th>
        <th scope="col">Quantidade</th>
        <th scope="col"></th>
        </tr>
    </thead>
    <tbody>
        @forelse ($controles as $controle)
        <tr>              
            <td> {{ $controle->created_at->format('d/m/Y') }} </td>
            <td> {{ $controle->funcionario->nome }} </td>
            <td> {{ $controle->epi->nome }} </td>
            <td> {{ $controle->tamanho }} </td>
            <td> {{ $controle->quantidade }} </td>
            <td>
            <div class="dropdown">
                <a href="#" role="button" id="dropdownMenuLink1" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="ph-dots-three-outline-vertical" style="font-size: 1.5rem" 
                    data-bs-toggle="tooltip" data-bs-placement="top" title="Detalhes e edição"></i>
                </a>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink1">
                <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="{{"#modal_epi_$controle->id"}}">Editar</a></li>
                <li>
                    <form method="POST" action="{{ route('remove-entrega-epi', $controle->id) }}">
                    @csrf
                    <button class="dropdown-item" type="submit">Deletar</button>
                    </form>
                </li>
                </ul>
            </div>

            </td>
        </tr>
        <x-painel.epis.modal-entregas :controle="$controle" />
        @empty
        <tr>
            <td colspan="6" class="text-center" > Não há registro de entrega de EPIs </td>
        </tr>
        @endforelse
    </tbody>
    </table>
    <x-painel.epis.modal-entregas />
    </div>

</div>
</div>