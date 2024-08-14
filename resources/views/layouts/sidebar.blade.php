<!-- ========== App Menu ========== -->
<div class="app-menu navbar-menu">
  <!-- LOGO -->
  <div class="navbar-brand-box">
    <a href="index" class="logo logo-dark">
      <span class="logo-sm">
        <img src="{{ URL::asset('build/images/logo-mgs.png') }}" alt="" width="50">
      </span>
      <span class="logo-lg">
        <img src="{{ URL::asset('build/images/logo-mgs.png') }}" alt="" height="32">
      </span>
    </a>
    <a href="index" class="logo logo-light">
      <span class="logo-sm">
        <img src="{{ URL::asset('build/images/logo-mgs.png') }}" alt="" width="50">
      </span>
      <span class="logo-lg">
        <img src="{{ URL::asset('build/images/logo-mgs.png') }}" alt="" height="32">
      </span>
    </a>
    <button type="button" class="btn btn-sm p-0 fs-3xl header-item float-end btn-vertical-sm-hover"
      id="vertical-hover">
      <i class="ri-record-circle-line"></i>
    </button>
  </div>
  <div id="scrollbar">
    <div class="container-fluid">

      <div id="two-column-menu">
      </div>
      <ul class="navbar-nav" id="navbar-nav">
        {{-- // ADMINISTRAÇÃO // --}}
        <li class="menu-title"><span>ADMINISTRAÇÃO</span></li>

        {{-- Usuarios --}}
        <li class="nav-item">
          <a class="nav-link menu-link collapsed {{ request()->is('painel/user/*') ? 'active' : '' }}"
            href="#sidebarUsers" data-bs-toggle="collapse" role="button"
            aria-expanded="{{ request()->is('painel/user/*') ? 'true' : 'false' }}"
            aria-controls="sidebarUsers">
            <i class="ph-user-circle"></i> <span>USUÁRIOS</span>
          </a>
          <div class="collapse menu-dropdown {{ request()->is('painel/user/*') ? 'show' : '' }}"
            id="sidebarUsers">
            <ul class="nav nav-sm flex-column">
              <li class="nav-item">
                <a href="/painel/user/index"
                  class="nav-link {{ request()->is('painel/user/index') ? 'active' : '' }}"
                  role="button" data-key="t-signin">Listar</a>
              </li>
            </ul>
          </div>
        </li>

        {{-- Funcionários --}}
        <li class="nav-item">
          <a class="nav-link menu-link collapsed {{ in_array(request()->route()->getPrefix(),['painel/funcionario', 'painel/beneficio', 'painel/lancamentoPonto'])? 'active': '' }}"
            href="#sidebarPessoas" data-bs-toggle="collapse" role="button"
            aria-expanded="{{ in_array(request()->route()->getPrefix(),['painel/funcionario', 'painel/beneficio', 'painel/lancamentoPonto'])? 'true': 'false' }}"
            aria-controls="sidebarPessoas">
            <i class="ph-identification-card"></i> <span>FUNCIONÁRIOS</span>
          </a>
          <div class="collapse menu-dropdown {{ in_array(request()->route()->getPrefix(),['painel/funcionario', 'painel/beneficio', 'painel/lancamentoPonto'])? 'show': '' }}"
            id="sidebarPessoas">
            <ul class="nav nav-sm flex-column">
              <li class="nav-item">
                <a href="{{ route('funcionario-index') }}"
                  class="nav-link {{ request()->is('painel/funcionario/index') ? 'active' : '' }}"
                  role="button" data-key="t-signin">Funcionários
                </a>
              </li>

              <li class="nav-item">
                <a href="{{ route('relatorio-ponto') }}"
                  class="nav-link {{ request()->is('painel/lancamentoPonto/relatorio-ponto') ? 'active' : '' }}"
                  role="button" data-key="t-signin">Relatório de ponto
                </a>
              </li>

            </ul>
          </div>
        </li>

        {{-- Cadastros adicionais --}}
        <li class="nav-item">
          <a class="nav-link menu-link collapsed {{ in_array(request()->route()->getPrefix(),['painel/obra'])? 'active': '' }}"
            href="#sidebarAdicionais" data-bs-toggle="collapse" role="button"
            aria-expanded="{{ in_array(request()->route()->getPrefix(),['painel/obra'])? 'true': 'false' }}"
            aria-controls="sidebarAdicionais">
            <i class="ph-list-plus"></i> <span>CADASTROS ADICIONAIS</span>
          </a>
          <div class="collapse menu-dropdown {{ in_array(request()->route()->getPrefix(),['painel/obra'])? 'show': '' }}"
            id="sidebarAdicionais">
            <ul class="nav nav-sm flex-column">

              <li class="nav-item">
                <a href="{{ route('obra-index') }}"
                  class="nav-link {{ request()->is('painel/obra/index') ? 'active' : '' }}"
                  role="button" data-key="t-signin">Cadastro de Obras
                </a>
              </li>

            </ul>
          </div>
        </li>

        {{-- EPIs --}}
        <li class="nav-item">
          <a class="nav-link menu-link collapsed {{ in_array(request()->route()->getPrefix(),['painel/epi'])? 'active': '' }}"
            href="#sidebarEpi" data-bs-toggle="collapse" role="button"
            aria-expanded="{{ in_array(request()->route()->getPrefix(),['painel/obra'])? 'true': 'false' }}"
            aria-controls="sidebarEpi">
            <i class="ph-briefcase"></i> <span>EPIs</span>
          </a>
          <div class="collapse menu-dropdown {{ in_array(request()->route()->getPrefix(),['painel/epi'])? 'show': '' }}"
            id="sidebarEpi">
            <ul class="nav nav-sm flex-column">

              <li class="nav-item">
                <a href="{{ route('epi-index') }}"
                  class="nav-link {{ request()->is('painel/epi/index') ? 'active' : '' }}"
                  role="button" data-key="t-signin">Cadastro de EPI's
                </a>
              </li>

              <li class="nav-item">
                <a href="{{ route('epi-controle') }}"
                  class="nav-link {{ request()->is('painel/epi/controle') ? 'active' : '' }}"
                  role="button" data-key="t-signin">Controle de EPI's
                </a>
              </li>

            </ul>
          </div>
        </li>



        {{-- Folha --}}
        {{-- <li class="nav-item">
          <a class="nav-link menu-link collapsed {{ in_array(request()->route()->getPrefix(),['painel/folha'])? 'active': '' }}"
            href="#sidebarPonto" data-bs-toggle="collapse" role="button"
            aria-expanded="{{ in_array(request()->route()->getPrefix(),['painel/folha'])? 'true': 'false' }}"
            aria-controls="sidebarPonto">
            <i class="ph-identification-card"></i> <span>FOLHA</span>
          </a>
          <div class="collapse menu-dropdown {{ in_array(request()->route()->getPrefix(),['painel/folha'])? 'show': '' }}"
            id="sidebarPonto">
            <ul class="nav nav-sm flex-column">
              <li class="nav-item">
                <a href="{{ route('folha-index') }}"
                  class="nav-link {{ request()->is('painel/folha/index') ? 'active' : '' }}"
                  role="button" data-key="t-signin">Folha de pagamento
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('item-folha-index') }}"
                  class="nav-link {{ request()->is('painel/item-folha/index') ? 'active' : '' }}"
                  role="button" data-key="t-signin">Itens da folha
                </a>
              </li>
            </ul>
          </div>
        </li> --}}


      </ul>
    </div>
    <!-- Sidebar -->
  </div>

  <div class="sidebar-background"></div>
</div>
<!-- Left Sidebar End -->
<!-- Vertical Overlay-->
<div class="vertical-overlay"></div>
