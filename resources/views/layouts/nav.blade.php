 <nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
     id="layout-navbar">
     <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
         <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
             <i class="bx bx-menu bx-sm"></i>
         </a>
     </div>

     <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
         <!-- Search -->
         {{-- <div class="navbar-nav align-items-center">
             <div class="nav-item d-flex align-items-center">
                 <i class="bx bx-search fs-4 lh-0"></i>
                 <input type="text" class="form-control border-0 shadow-none"
                     placeholder="Search{{ asset('') }}sneat." aria-label="Search{{ asset('') }}sneat." />
             </div>
         </div> --}}
         <!-- /Search -->

         <h4 class="fw-bold mt-3">
             {{--  Dashboard  --}}
         </h4>

         <ul class="navbar-nav flex-row align-items-center ms-auto">
             <ul class="navbar-nav ms-lg-auto">
                 <li class="nav-item">
                     <a class="nav-link" href="javascript:void(0)">
                         Welcome, <b>{{ auth()->user()->username }}</b> </a>
                 </li>
             </ul>

             <!-- User -->
             <li class="nav-item navbar-dropdown dropdown-user dropdown">
                 <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                     <div class="avatar avatar-online">
                         <img src="{{ url('') }}/logo/userbg2.png" alt class="w-px-40 h-auto rounded-circle" />
                     </div>
                 </a>
                 <ul class="dropdown-menu dropdown-menu-end">
                     {{--  <li>
                         <a class="dropdown-item" href="#">
                             <div class="d-flex">
                                 <div class="flex-shrink-0 me-3">
                                     <div class="avatar avatar-online">
                                         <img src="{{ asset('') }}sneat/assets/img/avatars/1.png" alt
                                             class="w-px-40 h-auto rounded-circle" />
                                     </div>
                                 </div>
                                 <div class="flex-grow-1">
                                     <span class="fw-semibold d-block">John Doe</span>
                                     <small class="text-muted">Admin</small>
                                 </div>
                             </div>
                         </a>
                     </li>  --}}
                     <li>
                         <div class="dropdown-divider"></div>
                     </li>
                     <li>
                         <a class="dropdown-item" href="{{ route('user.index') }}">
                             <i class="bx bx-cog me-2"></i>
                             <span class="align-middle">Ganti Password</span>
                         </a>
                     </li>
                     <li>
                         <div class="dropdown-divider"></div>
                     </li>
                     <li>
                         <a class="dropdown-item" href="{{ route('logout') }}">
                             <i class="bx bx-power-off me-2"></i>
                             <span class="align-middle">Log Out</span>
                         </a>
                     </li>
                 </ul>
             </li>
             <!--/ User -->
         </ul>
     </div>
 </nav>
