<div id="layoutSidenav">
  <div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
      <div class="sb-sidenav-menu">
        <div class="nav">
          <div class="sb-sidenav-menu-heading">Dashboard</div>
          <a class="nav-link @if(Route::currentRouteName()=='admin.dashboard') {{'active'}} @endif" href="{{ route('admin.dashboard') }}">
            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
            Dashboard
          </a>

          @if(Auth:: guard('admin')->user()->can('manage-settings'))
          <div class="sb-sidenav-menu-heading">Manage Settings</div>
          <a class="nav-link @if(Route::currentRouteName()=='admin.settings') {{'active'}} @endif" href="{{ route('admin.settings') }}">
            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
            Settings
          </a>
          @endif

          {{--@if(Auth:: guard('admin')->user()->can('manage-subadmin')) --}}
          <div class="sb-sidenav-menu-heading">Manage User</div>
          <a class="nav-link collapsed @if(Route::currentRouteName()=='admin.add-user' || Route::currentRouteName()=='admin.user' || Route::currentRouteName()=='admin.edit-user') {{'active'}} @endif" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayoutssubadmin" aria-expanded="false" aria-controls="collapseLayouts">
            <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
            User
            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
          </a>
          <div class="collapse @if(Route::currentRouteName()=='admin.add-user' || Route::currentRouteName()=='admin.user' || Route::currentRouteName()=='admin.edit-user') {{'show'}} @endif" id="collapseLayoutssubadmin" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
            <nav class="sb-sidenav-menu-nested nav">
              <a class="nav-link @if(Route::currentRouteName()=='admin.add-user') {{'active'}} @endif" href="{{ route('admin.add-user') }}">Add User </a>
              <a class="nav-link @if(Route::currentRouteName()=='admin.user') {{'active'}} @endif" href="{{ route('admin.user') }}">User List</a>
            </nav>
          </div>
          {{--@endif --}}
          <div class="sb-sidenav-menu-heading">Manage Todo</div>
          <a class="nav-link collapsed @if(Route::currentRouteName()=='admin.add-todo' || Route::currentRouteName()=='admin.todo' || Route::currentRouteName()=='admin.edit-todo') {{'active'}} @endif" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayoutstodo" aria-expanded="false" aria-controls="collapseLayouts">
            <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
            TODO
            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
          </a>
          <div class="collapse @if(Route::currentRouteName()=='admin.add-todo' || Route::currentRouteName()=='admin.todo' || Route::currentRouteName()=='admin.edit-todo') {{'show'}} @endif" id="collapseLayoutstodo" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
            <nav class="sb-sidenav-menu-nested nav">
              <a class="nav-link @if(Route::currentRouteName()=='admin.add-todo') {{'active'}} @endif" href="{{ route('admin.add-todo') }}">Add TODO </a>
              <a class="nav-link @if(Route::currentRouteName()=='admin.todo') {{'active'}} @endif" href="{{ route('admin.todo') }}">TODO List</a>
            </nav>
          </div>
        </div>
      </div>
      <!-- <div class="sb-sidenav-footer">
              <div class="small">Logged in as:</div>
              Start Bootstrap
          </div> -->
    </nav>
  </div>
  <div id="layoutSidenav_content">
    <main>
      @yield('unique-content')
    </main>
    <footer class="py-4 bg-light mt-auto">
      <div class="container-fluid px-4">
        <div class="d-flex align-items-center justify-content-between small">
          <div class="text-muted">Copyright &copy; Your Website {{ date('Y')}}</div>
          <!-- <div>
            <a href="#">Privacy Policy</a>
            &middot;
            <a href="#">Terms &amp; Conditions</a>
          </div> -->
        </div>
      </div>
    </footer>
  </div>
</div>