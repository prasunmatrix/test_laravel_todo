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

          @if(Auth:: guard('admin')->user()->can('manage-category'))
          <div class="sb-sidenav-menu-heading">Manage Category</div>
          <a class="nav-link collapsed @if(Route::currentRouteName()=='admin.add-category' || Route::currentRouteName()=='admin.category' || Route::currentRouteName()=='admin.edit-category') {{'active'}} @endif" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
            <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
            Category
            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
          </a>
          <div class="collapse @if(Route::currentRouteName()=='admin.add-category' || Route::currentRouteName()=='admin.category' || Route::currentRouteName()=='admin.edit-category') {{'show'}} @endif" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
            <nav class="sb-sidenav-menu-nested nav">
              <a class="nav-link @if(Route::currentRouteName()=='admin.add-category') {{'active'}} @endif" href="{{ route('admin.add-category') }}">Add Category</a>
              <a class="nav-link @if(Route::currentRouteName()=='admin.category' || Route::currentRouteName()=='admin.edit-category') {{'active'}} @endif" href="{{ url('admin/category') }}">View Category</a>
            </nav>
          </div>
          @endif
          @if(Auth:: guard('admin')->user()->can('manage-cms'))
          <div class="sb-sidenav-menu-heading">Manage CMS</div>
          <a class="nav-link collapsed @if(Route::currentRouteName()=='admin.add-cms' || Route::currentRouteName()=='admin.cmslist' || Route::currentRouteName()=='admin.edit-cms') {{'active'}} @endif" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayoutsCMS" aria-expanded="false" aria-controls="collapseLayouts">
            <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
            CMS
            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
          </a>
          <div class="collapse @if(Route::currentRouteName()=='admin.add-cms' || Route::currentRouteName()=='admin.cmslist' || Route::currentRouteName()=='admin.edit-cms') {{'show'}} @endif" id="collapseLayoutsCMS" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
            <nav class="sb-sidenav-menu-nested nav">
              <a class="nav-link @if(Route::currentRouteName()=='admin.add-cms') {{'active'}} @endif" href="{{ route('admin.add-cms') }}">Add CMS</a>
              <a class="nav-link @if(Route::currentRouteName()=='admin.cmslist' || Route::currentRouteName()=='admin.edit-cms') {{'active'}} @endif" href="{{ route('admin.cmslist') }}">View CMS</a>
            </nav>
          </div>
          @endif

          @if(Auth:: guard('admin')->user()->can('manage-photo-gallery'))
          <div class="sb-sidenav-menu-heading">Manage Photo Gallery</div>
          <a class="nav-link collapsed @if(Route::currentRouteName()=='admin.add-photogallery' || Route::currentRouteName()=='admin.photogallerylist' || Route::currentRouteName()=='admin.edit-photogallery') {{'active'}} @endif" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayoutsPhotoGallery" aria-expanded="false" aria-controls="collapseLayouts">
            <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
            Photo Gallery
            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
          </a>
          <div class="collapse @if(Route::currentRouteName()=='admin.add-photogallery' || Route::currentRouteName()=='admin.photogallerylist' || Route::currentRouteName()=='admin.edit-photogallery') {{'show'}} @endif" id="collapseLayoutsPhotoGallery" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
            <nav class="sb-sidenav-menu-nested nav">
              <a class="nav-link @if(Route::currentRouteName()=='admin.add-photogallery') {{'active'}} @endif" href="{{ route('admin.add-photogallery') }}">Add Photo Gallery</a>
              <a class="nav-link @if(Route::currentRouteName()=='admin.photogallerylist' || Route::currentRouteName()=='admin.edit-photogallery') {{'active'}} @endif" href="{{ route('admin.photogallerylist') }}">View Photo Gallery</a>
            </nav>
          </div>
          @endif

          <!---Manage Permission---->
          @if(Auth:: guard('admin')->user()->can('manage-permission'))
          <div class="sb-sidenav-menu-heading">Manage Permission</div>
          <a class="nav-link collapsed @if(Route::currentRouteName()=='admin.add-permission' || Route::currentRouteName()=='admin.permissionlist' || Route::currentRouteName()=='admin.edit-permission') {{'active'}} @endif" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayoutsPermission" aria-expanded="false" aria-controls="collapseLayouts">
            <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
            Permission
            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
          </a>

          <div class="collapse @if(Route::currentRouteName()=='admin.add-permission' || Route::currentRouteName()=='admin.permissionlist' || Route::currentRouteName()=='admin.edit-permission') {{'show'}} @endif" id="collapseLayoutsPermission" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
            <nav class="sb-sidenav-menu-nested nav">
              <a class="nav-link @if(Route::currentRouteName()=='admin.permissionlist') {{'active'}} @endif" href="{{ route('admin.permissionlist') }}">Permission List</a>
            </nav>
          </div>
          @endif


          <!---Manage Role---->
          @if(Auth:: guard('admin')->user()->can('manage-role'))
          <div class="sb-sidenav-menu-heading">Manage Role</div>
          <a class="nav-link collapsed @if(Route::currentRouteName()=='admin.add-role' || Route::currentRouteName()=='admin.rolelist' || Route::currentRouteName()=='admin.edit-role') {{'active'}} @endif" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayoutsRole" aria-expanded="false" aria-controls="collapseLayouts">
            <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
            Role
            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
          </a>
          <div class="collapse @if(Route::currentRouteName()=='admin.add-role' || Route::currentRouteName()=='admin.rolelist' || Route::currentRouteName()=='admin.edit-role') {{'show'}} @endif" id="collapseLayoutsRole" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
            <nav class="sb-sidenav-menu-nested nav">
              <a class="nav-link @if(Route::currentRouteName()=='admin.rolelist') {{'active'}} @endif" href="{{ route('admin.rolelist') }}">Role List</a>
            </nav>
          </div>
          @endif

          <!---Manage Subadmin---->

          @if(Auth:: guard('admin')->user()->can('manage-subadmin'))
          <div class="sb-sidenav-menu-heading">Manage Subadmin</div>
          <a class="nav-link collapsed @if(Route::currentRouteName()=='admin.add-subadmin' || Route::currentRouteName()=='admin.subadmin' || Route::currentRouteName()=='admin.edit-subadmin') {{'active'}} @endif" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayoutssubadmin" aria-expanded="false" aria-controls="collapseLayouts">
            <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
            Subadmin
            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
          </a>
          <div class="collapse @if(Route::currentRouteName()=='admin.add-subadmin' || Route::currentRouteName()=='admin.subadmin' || Route::currentRouteName()=='admin.edit-subadmin') {{'show'}} @endif" id="collapseLayoutssubadmin" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
            <nav class="sb-sidenav-menu-nested nav">
              <a class="nav-link @if(Route::currentRouteName()=='admin.subadmin') {{'active'}} @endif" href="{{ route('admin.subadmin') }}">Subadmin List</a>
            </nav>
          </div>
          @endif
          @if(Auth:: guard('admin')->user()->can('manage-branch'))
          <div class="sb-sidenav-menu-heading">Manage Branch</div>
          <a class="nav-link collapsed @if(Route::currentRouteName()=='admin.add-branch' || Route::currentRouteName()=='admin.branchlist' || Route::currentRouteName()=='admin.edit-branch') {{'active'}} @endif" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayoutsBranch" aria-expanded="false" aria-controls="collapseLayouts">
            <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
            Branch
            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
          </a>
          <div class="collapse @if(Route::currentRouteName()=='admin.add-branch' || Route::currentRouteName()=='admin.branchlist' || Route::currentRouteName()=='admin.edit-branch') {{'show'}} @endif" id="collapseLayoutsBranch" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
            <nav class="sb-sidenav-menu-nested nav">
              <a class="nav-link @if(Route::currentRouteName()=='admin.add-branch') {{'active'}} @endif" href="{{ route('admin.add-branch') }}">Add Branch</a>
              <a class="nav-link @if(Route::currentRouteName()=='admin.branchlist' || Route::currentRouteName()=='admin.edit-branch') {{'active'}} @endif" href="{{ route('admin.branchlist') }}">View Branch</a>
            </nav>
          </div>
          @endif
          <!---Manage Knowledge Corner---->
          @if(Auth:: guard('admin')->user()->can('manage-knowledge-corner'))
          <div class="sb-sidenav-menu-heading">Knowledge Corner</div>
          <a class="nav-link collapsed @if(Route::currentRouteName()=='admin.add-knowledge-corner' || Route::currentRouteName()=='admin.knowledge-corner' || Route::currentRouteName()=='admin.edit-knowledge-corner') {{'active'}} @endif" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayoutsknowledge" aria-expanded="false" aria-controls="collapseLayouts">
            <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
            Knowledge Corner
            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
          </a>

          <div class="collapse @if(Route::currentRouteName()=='admin.add-knowledge-corner' || Route::currentRouteName()=='admin.knowledge-corner' || Route::currentRouteName()=='admin.edit-knowledge-corner') {{'show'}} @endif" id="collapseLayoutsknowledge" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
            <nav class="sb-sidenav-menu-nested nav">
              <a class="nav-link @if(Route::currentRouteName()=='admin.add-knowledge-corner') {{'active'}} @endif" href="{{ route('admin.add-knowledge-corner') }}">Add Knowledge Corner </a>
              <a class="nav-link @if(Route::currentRouteName()=='admin.knowledge-corner' || Route::currentRouteName()=='admin.edit-knowledge-corner') {{'active'}} @endif" href="{{ route('admin.knowledge-corner') }}">View Knowledge Corner</a>
            </nav>
          </div>
          @endif
          <!---Manage Notice---->
          @if(Auth:: guard('admin')->user()->can('manage-notice'))
          <div class="sb-sidenav-menu-heading">Manage Notice</div>
          <a class="nav-link collapsed @if(Route::currentRouteName()=='admin.add-notice' || Route::currentRouteName()=='admin.notice' || Route::currentRouteName()=='admin.edit-notice') {{'active'}} @endif" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayoutsnotice" aria-expanded="false" aria-controls="collapseLayouts">
            <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
            Notice
            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
          </a>

          <div class="collapse @if(Route::currentRouteName()=='admin.add-notice' || Route::currentRouteName()=='admin.notice' || Route::currentRouteName()=='admin.edit-notice') {{'show'}} @endif" id="collapseLayoutsnotice" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
            <nav class="sb-sidenav-menu-nested nav">
              <a class="nav-link @if(Route::currentRouteName()=='admin.add-notice') {{'active'}} @endif" href="{{ route('admin.add-notice') }}">Add Notice </a>
              <a class="nav-link @if(Route::currentRouteName()=='admin.notice' || Route::currentRouteName()=='admin.edit-notice') {{'active'}} @endif" href="{{ route('admin.notice') }}">View Notice</a>
            </nav>
          </div>
          @endif
          @if(Auth:: guard('admin')->user()->can('manage-eventcalendar'))
          <div class="sb-sidenav-menu-heading">Manage Event Calendar</div>
          <a class="nav-link @if(Route::currentRouteName()=='admin.eventcalendar') {{'active'}} @endif" href="{{ route('admin.eventcalendar') }}">
            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
            Event Calendar
          </a>
          @endif
          @if(Auth:: guard('admin')->user()->can('manage-organisation'))
          <div class="sb-sidenav-menu-heading">Organisation Chart</div>
          <a class="nav-link collapsed @if(Route::currentRouteName()=='admin.add-organisation-chart' || Route::currentRouteName()=='admin.organisation-chart' || Route::currentRouteName()=='admin.edit-organisation-chart') {{'active'}} @endif" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayoutsorganisation" aria-expanded="false" aria-controls="collapseLayouts">
            <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
            Organisation Chart
            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
          </a>
          <div class="collapse @if(Route::currentRouteName()=='admin.add-organisation-chart' || Route::currentRouteName()=='admin.organisation-chart' || Route::currentRouteName()=='admin.edit-organisation-chart') {{'show'}} @endif" id="collapseLayoutsorganisation" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
            <nav class="sb-sidenav-menu-nested nav">
              <a class="nav-link @if(Route::currentRouteName()=='admin.add-organisation-chart') {{'active'}} @endif" href="{{ route('admin.add-organisation-chart') }}">Add Chart </a>
              <a class="nav-link @if(Route::currentRouteName()=='admin.organisation-chart' || Route::currentRouteName()=='admin.edit-organisation-chart') {{'active'}} @endif" href="{{ route('admin.organisation-chart') }}">View Chart</a>
            </nav>
          </div>
          @endif
          @if(Auth:: guard('admin')->user()->can('manage-tender'))
          <div class="sb-sidenav-menu-heading">Manage Tender</div>
          <a class="nav-link collapsed @if(Route::currentRouteName()=='admin.add-tender' || Route::currentRouteName()=='admin.tender' || Route::currentRouteName()=='admin.edit-tender') {{'active'}} @endif" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayoutstender" aria-expanded="false" aria-controls="collapseLayouts">
            <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
            Tender
            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
          </a>

          <div class="collapse @if(Route::currentRouteName()=='admin.add-tender' || Route::currentRouteName()=='admin.tender' || Route::currentRouteName()=='admin.edit-tender') {{'show'}} @endif" id="collapseLayoutstender" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
            <nav class="sb-sidenav-menu-nested nav">
              <a class="nav-link @if(Route::currentRouteName()=='admin.add-tender') {{'active'}} @endif" href="{{ route('admin.add-tender') }}">Add Tender </a>
              <a class="nav-link @if(Route::currentRouteName()=='admin.tender' || Route::currentRouteName()=='admin.edit-tender') {{'active'}} @endif" href="{{ route('admin.tender') }}">View Tender</a>
            </nav>
          </div>
          @endif
          @if(Auth:: guard('admin')->user()->can('manage-employee'))
          <div class="sb-sidenav-menu-heading">Manage Employee</div>
          <a class="nav-link collapsed @if(Route::currentRouteName()=='admin.employee') {{'active'}} @endif" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayoutsemployee" aria-expanded="false" aria-controls="collapseLayouts">
            <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
            Employee
            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
          </a>

          <div class="collapse @if(Route::currentRouteName()=='admin.employee') {{'show'}} @endif" id="collapseLayoutsemployee" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
            <nav class="sb-sidenav-menu-nested nav">
              <!-- <a class="nav-link @if(Route::currentRouteName()=='admin.add-tender') {{'active'}} @endif" href="{{-- route('admin.add-tender') --}}">Add Tender </a> -->
              <a class="nav-link @if(Route::currentRouteName()=='admin.employee') {{'active'}} @endif" href="{{ route('admin.employee') }}">View Employee</a>
            </nav>
          </div>
          @endif
          <!-- <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                      <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                      Pages
                      <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                  </a>
                  <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                      <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                          <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseAuth" aria-expanded="false" aria-controls="pagesCollapseAuth">
                              Authentication
                              <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                          </a>
                          <div class="collapse" id="pagesCollapseAuth" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                              <nav class="sb-sidenav-menu-nested nav">
                                  <a class="nav-link" href="login.html">Login</a>
                                  <a class="nav-link" href="register.html">Register</a>
                                  <a class="nav-link" href="password.html">Forgot Password</a>
                              </nav>
                          </div>
                          <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseError" aria-expanded="false" aria-controls="pagesCollapseError">
                              Error
                              <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                          </a>
                          <div class="collapse" id="pagesCollapseError" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                              <nav class="sb-sidenav-menu-nested nav">
                                  <a class="nav-link" href="401.html">401 Page</a>
                                  <a class="nav-link" href="404.html">404 Page</a>
                                  <a class="nav-link" href="500.html">500 Page</a>
                              </nav>
                          </div>
                      </nav>
                  </div>
                  <div class="sb-sidenav-menu-heading">Addons</div>
                  <a class="nav-link" href="charts.html">
                      <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                      Charts
                  </a>
                  <a class="nav-link" href="tables.html">
                      <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                      Tables
                  </a> -->
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
          <div class="text-muted">Copyright &copy; Your Website 2022</div>
          <div>
            <a href="#">Privacy Policy</a>
            &middot;
            <a href="#">Terms &amp; Conditions</a>
          </div>
        </div>
      </div>
    </footer>
  </div>
</div>