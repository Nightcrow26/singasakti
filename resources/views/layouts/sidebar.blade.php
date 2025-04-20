  <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
      <div class="app-brand demo" style="height: 200px;margin-top: 40px;">
          <a href="#" class="app-brand-link">
              <img src="{{ asset('') }}logo/b.png" style="width: 100%;margin-left: auto;" alt="homepage"
                  class="dark-logo center" />
          </a>
          <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
              <i class="bx bx-chevron-left bx-sm align-middle"></i>
          </a>
      </div>

      {{-- <div class="menu-inner-shadow"></div> --}}

      <ul class="menu-inner" style="margin-top: 40px;">
          <!-- Dashboard -->
          @if (Auth::user()->hasRole('admin'))
              <li class="menu-item {{ set_active('home.admin') }}">
                  <a href="{{ route('home.admin') }}" class="menu-link">
                      <i class="menu-icon tf-icons bx bx-home-circle"></i>
                      <div data-i18n="Analytics">Dashboard</div>
                  </a>
              </li>

              <!-- Layouts -->

              <li class="menu-header small text-uppercase">
                  <span class="menu-header-text">Monev</span>
              </li>
              <li class="menu-item {{ set_active('admin.monev.index') }}">
                  <a href="{{ route('admin.monev.index') }}" class="menu-link">
                      <i class="menu-icon tf-icons bx bx-collection"></i>
                      <div data-i18n="Basic">Paket Pekerjaan</div>
                  </a>
              </li>

              <li class="menu-item {{ set_active('admin.monev.pengawasan.index') }}">
                  <a href="{{ route('admin.monev.pengawasan.index') }}" class="menu-link">
                      <i class="menu-icon tf-icons bx bx-collection"></i>
                      <div data-i18n="Basic">Pengawasan Rutin</div>
                  </a>
              </li>

              <li class="menu-item {{ set_active('admin.monev.table.index') }}">
                  <a href="{{ route('admin.monev.table.index') }}" class="menu-link">
                      <i class="menu-icon tf-icons bx bx-collection"></i>
                      <div data-i18n="Basic">Pengawasan Teknis</div>
                  </a>
              </li>

              <li class="menu-item {{ set_active('under_construction') }}">
                  <a href="{{ route('under_construction') }}" class="menu-link">
                      <i class="menu-icon tf-icons bx bx-collection"></i>
                      <div data-i18n="Basic">Pengawasan Insidental</div>
                  </a>
              </li>

              <li class="menu-header small text-uppercase">
                  <span class="menu-header-text">Master</span>
              </li>
              <li class="menu-item {{ set_active('skpd.index') }}">
                  <a href="{{ route('skpd.index') }}" class="menu-link">
                      <i class="menu-icon tf-icons bx bx-collection"></i>
                      <div data-i18n="Basic">SOPD</div>
                  </a>
              </li>

              <li class="menu-item {{ set_active('master.user.index') }}">
                  <a href="{{ route('master.user.index') }}" class="menu-link">
                      <i class="menu-icon tf-icons bx bx-collection"></i>
                      <div data-i18n="Basic">USER</div>
                  </a>
              </li>

              <li class="menu-item {{ set_active('urusan.index') }}">
                  <a href="{{ route('urusan.index') }}" class="menu-link">
                      <i class="menu-icon tf-icons bx bx-collection"></i>
                      <div data-i18n="Basic">URUSAN</div>
                  </a>
              </li>

              <li class="menu-item {{ set_active('bidang.index') }}">
                  <a href="{{ route('bidang.index') }}" class="menu-link">
                      <i class="menu-icon tf-icons bx bx-collection"></i>
                      <div data-i18n="Basic">BIDANG</div>
                  </a>
              </li>

              <li class="menu-item {{ set_active('program.index') }}">
                  <a href="{{ route('program.index') }}" class="menu-link">
                      <i class="menu-icon tf-icons bx bx-collection"></i>
                      <div data-i18n="Basic">PROGRAM</div>
                  </a>
              </li>

              <li class="menu-item {{ set_active('kegiatan.index') }}">
                  <a href="{{ route('kegiatan.index') }}" class="menu-link">
                      <i class="menu-icon tf-icons bx bx-collection"></i>
                      <div data-i18n="Basic">KEGIATAN</div>
                  </a>
              </li>

              <li class="menu-item {{ set_active('sub.index') }}">
                  <a href="{{ route('sub.index') }}" class="menu-link">
                      <i class="menu-icon tf-icons bx bx-collection"></i>
                      <div data-i18n="Basic">SUB KEGIATAN</div>
                  </a>
              </li>

              {{-- <li class="menu-item {{ set_active('nomen.index') }}">
                  <a href="{{ route('nomen.index') }}" class="menu-link">
                      <i class="menu-icon tf-icons bx bx-collection"></i>
                      <div data-i18n="Basic">NOMENKLATUR</div>
                  </a>
              </li> --}}
          @endif

          @if (Auth::user()->hasRole('skpd'))
              <li class="menu-item {{ set_active('home.admin') }}">
                  <a href="{{ route('home.admin') }}" class="menu-link">
                      <i class="menu-icon tf-icons bx bx-home-circle"></i>
                      <div data-i18n="Analytics">Dashboard</div>
                  </a>
              </li>

              <!-- Layouts -->

              <li class="menu-header small text-uppercase">
                  <span class="menu-header-text">Monev</span>
              </li>
              <li class="menu-item {{ set_active('admin.monev.index') }}">
                  <a href="{{ route('admin.monev.index') }}" class="menu-link">
                      <i class="menu-icon tf-icons bx bx-collection"></i>
                      <div data-i18n="Basic">Paket Pekerjaan</div>
                  </a>
              </li>

              <li class="menu-item {{ set_active('admin.monev.pengawasan.index') }}">
                  <a href="{{ route('admin.monev.pengawasan.index') }}" class="menu-link">
                      <i class="menu-icon tf-icons bx bx-collection"></i>
                      <div data-i18n="Basic">Pengawasan Rutin</div>
                  </a>
              </li>

              <li class="menu-item {{ set_active('admin.monev.table.index') }}">
                  <a href="{{ route('admin.monev.table.index') }}" class="menu-link">
                      <i class="menu-icon tf-icons bx bx-collection"></i>
                      <div data-i18n="Basic">Pengawasan Teknis</div>
                  </a>
              </li>


              <li class="menu-item {{ set_active('admin.monev.k01a.index') }}">
                <a href="{{ route('admin.monev.k01a.index') }}" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-collection"></i>
                    <div data-i18n="Basic">K.01.A</div>
                </a>
            </li>

            <li class="menu-item {{ set_active('admin.monev.k01b.index') }}">
                <a href="{{ route('admin.monev.k01b.index') }}" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-collection"></i>
                    <div data-i18n="Basic">K.01.B</div>
                </a>
            </li>
            
              <li class="menu-item {{ set_active('admin.monev.k02.index') }}">
                <a href="{{ route('admin.monev.k02.index') }}" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-collection"></i>
                    <div data-i18n="Basic">Rekapitulasi K.02</div>
                </a>
              </li>

              <li class="menu-item {{ set_active('admin.monev.k03.index') }}">
                <a href="{{ route('admin.monev.k03.index') }}" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-collection"></i>
                    <div data-i18n="Basic">Rekapitulasi K.03</div>
                </a>
              </li>

              <li class="menu-item {{ set_active('admin.monev.k04.index') }}">
                <a href="{{ route('admin.monev.k04.index') }}" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-collection"></i>
                    <div data-i18n="Basic">Rekapitulasi K.04</div>
                </a>
              </li>


              {{-- <li class="menu-header small text-uppercase">
                  <span class="menu-header-text">Master</span>
              </li> --}}
              {{-- <li class="menu-item {{ set_active('skpd.index') }}">
                  <a href="{{ route('skpd.index') }}" class="menu-link">
                      <i class="menu-icon tf-icons bx bx-collection"></i>
                      <div data-i18n="Basic">SOPD</div>
                  </a>
              </li> --}}
              {{--
              <li class="menu-item {{ set_active('urusan.index') }}">
                  <a href="{{ route('urusan.index') }}" class="menu-link">
                      <i class="menu-icon tf-icons bx bx-collection"></i>
                      <div data-i18n="Basic">URUSAN</div>
                  </a>
              </li>

              <li class="menu-item {{ set_active('bidang.index') }}">
                  <a href="{{ route('bidang.index') }}" class="menu-link">
                      <i class="menu-icon tf-icons bx bx-collection"></i>
                      <div data-i18n="Basic">BIDANG</div>
                  </a>
              </li>

              <li class="menu-item {{ set_active('program.index') }}">
                  <a href="{{ route('program.index') }}" class="menu-link">
                      <i class="menu-icon tf-icons bx bx-collection"></i>
                      <div data-i18n="Basic">PROGRAM</div>
                  </a>
              </li>

              <li class="menu-item {{ set_active('kegiatan.index') }}">
                  <a href="{{ route('kegiatan.index') }}" class="menu-link">
                      <i class="menu-icon tf-icons bx bx-collection"></i>
                      <div data-i18n="Basic">KEGIATAN</div>
                  </a>
              </li>

              <li class="menu-item {{ set_active('sub.index') }}">
                  <a href="{{ route('sub.index') }}" class="menu-link">
                      <i class="menu-icon tf-icons bx bx-collection"></i>
                      <div data-i18n="Basic">SUB KEGIATAN</div>
                  </a>
              </li> --}}

              {{-- <li class="menu-item {{ set_active('nomen.index') }}">
                  <a href="{{ route('nomen.index') }}" class="menu-link">
                      <i class="menu-icon tf-icons bx bx-collection"></i>
                      <div data-i18n="Basic">NOMENKLATUR</div>
                  </a>
              </li> --}}
          @endif
      </ul>
  </aside>
