<header class="navbar navbar-expand-md d-none d-lg-flex d-print-none sticky-top bg-indigo-lt">
    <div class="container-xl">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu"
            aria-controls="navbar-menu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="navbar-nav flex-row order-md-last">
            <div class="d-none d-md-flex">
                {{-- @if (Auth::user()->role != 'operator')
                    @if ($_SERVER['SERVER_NAME'] == '127.0.0.1')
                        <div class="nav-link px-0" style="margin-right: 20px">
                            <a href="{{ url('lokal/mesinfinger') }}" class="btn btn-green"><i class="fa-solid fa-robot"
                                    style="margin-right: 7px; margin-bottom:3px"></i> Local Data</a>
                        </div>
                    @else
                        <div class="nav-link px-0" style="margin-right: 20px">
                            <a href="#" class="btn btn-green disabled">
                                <svg xmlns="http://www.w3.org/2000/svg" style="margin-right: 7px;" width="24"
                                    height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                    class="icon icon-tabler icons-tabler-outline icon-tabler-fingerprint-off">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M18.9 7a8 8 0 0 1 1.1 5v1a6 6 0 0 0 .8 3" />
                                    <path
                                        d="M8 11c0 -.848 .264 -1.634 .713 -2.28m2.4 -1.621a4 4 0 0 1 4.887 3.901l0 1" />
                                    <path d="M12 12v1a14 14 0 0 0 2.5 8" />
                                    <path d="M8 15a18 18 0 0 0 1.8 6" />
                                    <path
                                        d="M4.9 19a22 22 0 0 1 -.9 -7v-1a8 8 0 0 1 1.854 -5.143m2.176 -1.825a8 8 0 0 1 7.97 .018" />
                                    <path d="M3 3l18 18" />
                                </svg>
                                <s>Mesin Finger</s>
                            </a>
                        </div>
                    @endif
                @endif --}}
                @if (Auth::user()->role != 'operator')
                    <div class="nav-link px-0" style="margin-right: 20px">
                        <a href="{{ url('lokal/localabsence') }}" class="btn btn-green"><i class="fa-solid fa-robot"
                                style="margin-right: 7px; margin-bottom:3px"></i> Daftar Absen</a>
                    </div>
                @endif
                <a href="?theme=dark" class="nav-link px-0 hide-theme-dark" title="Enable dark mode"
                    data-bs-toggle="tooltip" data-bs-placement="bottom">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M12 3c.132 0 .263 0 .393 0a7.5 7.5 0 0 0 7.92 12.446a9 9 0 1 1 -8.313 -12.454z" />
                    </svg>
                </a>
                <a href="?theme=light" class="nav-link px-0 hide-theme-light" title="Enable light mode"
                    data-bs-toggle="tooltip" data-bs-placement="bottom">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M12 12m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" />
                        <path
                            d="M3 12h1m8 -9v1m8 8h1m-9 8v1m-6.4 -15.4l.7 .7m12.1 -.7l-.7 .7m0 11.4l.7 .7m-12.1 -.7l-.7 .7" />
                    </svg>
                </a>
                <div class="nav-item dropdown d-none d-md-flex me-3">
                    <a href="#" class="nav-link px-0" data-bs-toggle="dropdown" tabindex="-1"
                        aria-label="Show notifications">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                            viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path
                                d="M10 5a2 2 0 1 1 4 0a7 7 0 0 1 4 6v3a4 4 0 0 0 2 3h-16a4 4 0 0 0 2 -3v-3a7 7 0 0 1 4 -6" />
                            <path d="M9 17v1a3 3 0 0 0 6 0v-1" />
                        </svg>
                        <span class="badge bg-red"></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-end dropdown-menu-card">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Last updates</h3>
                            </div>
                            <div class="list-group list-group-flush list-group-hoverable">
                                <div class="list-group-item">
                                    <div class="row align-items-center">
                                        <div class="col-auto"><span
                                                class="status-dot status-dot-animated bg-red d-block"></span></div>
                                        <div class="col text-truncate">
                                            <a href="#" class="text-body d-block">Example 1</a>
                                            <div class="d-block text-muted text-truncate mt-n1">
                                                Change deprecated html tags to text decoration classes (#29604)
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <a href="#" class="list-group-item-actions">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon text-muted"
                                                    width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                                                    stroke="currentColor" fill="none" stroke-linecap="round"
                                                    stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path
                                                        d="M12 17.75l-6.172 3.245l1.179 -6.873l-5 -4.867l6.9 -1l3.086 -6.253l3.086 6.253l6.9 1l-5 4.867l1.179 6.873z" />
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="list-group-item">
                                    <div class="row align-items-center">
                                        <div class="col-auto"><span class="status-dot d-block"></span></div>
                                        <div class="col text-truncate">
                                            <a href="#" class="text-body d-block">Example 2</a>
                                            <div class="d-block text-muted text-truncate mt-n1">
                                                justify-content:between ⇒ justify-content:space-between (#29734)
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <a href="#" class="list-group-item-actions show">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon text-yellow"
                                                    width="24" height="24" viewBox="0 0 24 24"
                                                    stroke-width="2" stroke="currentColor" fill="none"
                                                    stroke-linecap="round" stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path
                                                        d="M12 17.75l-6.172 3.245l1.179 -6.873l-5 -4.867l6.9 -1l3.086 -6.253l3.086 6.253l6.9 1l-5 4.867l1.179 6.873z" />
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="list-group-item">
                                    <div class="row align-items-center">
                                        <div class="col-auto"><span class="status-dot d-block"></span></div>
                                        <div class="col text-truncate">
                                            <a href="#" class="text-body d-block">Example 3</a>
                                            <div class="d-block text-muted text-truncate mt-n1">
                                                Update change-version.js (#29736)
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <a href="#" class="list-group-item-actions">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon text-muted"
                                                    width="24" height="24" viewBox="0 0 24 24"
                                                    stroke-width="2" stroke="currentColor" fill="none"
                                                    stroke-linecap="round" stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path
                                                        d="M12 17.75l-6.172 3.245l1.179 -6.873l-5 -4.867l6.9 -1l3.086 -6.253l3.086 6.253l6.9 1l-5 4.867l1.179 6.873z" />
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="list-group-item">
                                    <div class="row align-items-center">
                                        <div class="col-auto"><span
                                                class="status-dot status-dot-animated bg-green d-block"></span></div>
                                        <div class="col text-truncate">
                                            <a href="#" class="text-body d-block">Example 4</a>
                                            <div class="d-block text-muted text-truncate mt-n1">
                                                Regenerate package-lock.json (#29730)
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <a href="#" class="list-group-item-actions">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon text-muted"
                                                    width="24" height="24" viewBox="0 0 24 24"
                                                    stroke-width="2" stroke="currentColor" fill="none"
                                                    stroke-linecap="round" stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path
                                                        d="M12 17.75l-6.172 3.245l1.179 -6.873l-5 -4.867l6.9 -1l3.086 -6.253l3.086 6.253l6.9 1l-5 4.867l1.179 6.873z" />
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="nav-item dropdown">
                <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown"
                    aria-label="Open user menu">
                    <?php
                    // $role = Auth::user()->role;
                    // $username = Auth::user()->username;
                    
                    // if ($role === 'admin') {
                    //     if ($username === 'alvin') {
                    //         $avatarUrl = asset('assets/static/avatars/1.jpg');
                    //     } elseif ($username === 'Brian') {
                    //         $avatarUrl = asset('assets/static/avatars/2.jpg');
                    //     } elseif ($username === 'felixjesse') {
                    //         $avatarUrl = asset('assets/static/avatars/3.jpg');
                    //     } else {
                    //         $avatarUrl = asset('assets/static/avatars/avatar.png');
                    //     }
                    // } elseif ($role === 'hrd') {
                    //     $avatarUrl = asset('assets/static/avatars/hrd.png');
                    // } elseif ($role === 'operator') {
                    //     $avatarUrl = asset('assets/static/avatars/operator.png');
                    // } else {
                    //     $avatarUrl = asset('assets/static/avatars/default.png');
                    // }
                    ?>
                    <span class="avatar avatar-sm rounded"
                        style="background-image: url('{{ asset('photo/pas/' . Auth::user()->userid . '.jpg') }}')"></span>

                    <div class="d-none d-xl-block ps-2">
                        <div style="text-transform: capitalize;">{{ Auth::user()->name }}</div>
                        <div class="mt-1 small text-muted" style="text-transform: capitalize;">
                            @if (Auth::user()->role != 'operator')
                                {{ Auth::user()->role }}
                            @else
                                @if (Auth::user()->admin == '3')
                                    Admin Gudang
                                @else
                                    Admin Unit {{ Auth::user()->admin }}
                                @endif
                            @endif
                        </div>
                    </div>
                </a>

                <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <a href="#" class="dropdown-item">Status</a>
                    <a href="./profile.html" class="dropdown-item">Profile</a>
                    <a href="#" class="dropdown-item">Feedback</a>
                    <div class="dropdown-divider"></div>
                    <a href="./settings.html" class="dropdown-item">Settings</a>
                    <a href="{{ route('logout') }}" class="dropdown-item">Logout</a>
                </div>
            </div>
        </div>
        <div class="collapse navbar-collapse" id="navbar-menu">
            <div>
                <form id="js-pencarian">
                    <div class="input-group">
                        <div class="input-icon">
                            <span class="input-icon-addon">
                            </span>
                            <input type="text" name="fieldPencarian" id="myInput" class="form-control"
                                placeholder="MENU:NAMA/STB" aria-label="Search in website" list="datalistOptions">
                        </div>
                        <button class="btn btn-primary btn-icon">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </button>
                    </div>
                </form>
                <datalist id="datalistOptions">
                    <option value="ABSENSI:"></option>
                    <option value="LEGALITAS:"></option>
                    <option value="CUTI:"></option>
                    <option value="PAYROLL:"></option>
                    <option value="BPJS:"></option>
                    <option value="DATA:"></option>
                </datalist>
            </div>
            <div style="margin-left: 5px">
                <select class="form-select" id="selectEntitas">
                    <option value="PINTEX">PINTEX</option>
                    <option value="TFI">TFI</option>
                </select>
            </div>
        </div>
    </div>
</header>
