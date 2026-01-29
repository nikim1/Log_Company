<nav class="navbar navbar-expand-lg navbar-dark shadow-sm" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
    <div class="container">
        <a class="navbar-brand fw-bold d-flex align-items-center" href="{{ url('/') }}">
            <i class="bi bi-box-seam fs-4 me-2"></i>
            <span class="fs-5">Logistics Co.</span>
        </a>

        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto align-items-lg-center">
                @auth
                @if(Auth::user()->hasRole(['courier', 'office']))
                <a href="{{ route('reports') }}" class="nav-link">
                    Справки
                </a>
                @endif
                <a href="/dashboard" class="nav-link">
                    Начало
                </a>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown">
                        <div class="bg-white rounded-circle p-1 shadow-lg" style="width: 50px; height: 50px;">
                            @if(Auth::user()->profile_image)
                            <img src="{{ asset('storage/' . Auth::user()->profile_image) }}" class="rounded-circle w-100 h-100 object-fit-cover">
                            @else
                            <div class="bg-primary bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center w-100 h-100">
                                <i class="bi bi-person-fill fs-1 text-primary"></i>
                            </div>
                            @endif
                        </div>
                        <span class="ms-1">{{ auth()->user()->name }}</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end shadow border-0 mt-2">
                        <li>
                            <a class="dropdown-item" href="{{ route('profile') }}">
                                <i class="bi bi-person me-2"></i>Профил
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                @csrf
                                <button class="dropdown-item text-danger" type="submit">
                                    <i class="bi bi-box-arrow-right me-2"></i>Изход
                                </button>
                            </form>
                        </li>
                    </ul>
                </li>
                @else
                <li class="nav-item">
                    <a class="nav-link px-3" href="{{ route('login') }}">
                        <i class="bi bi-box-arrow-in-right me-1"></i>Вход
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link btn btn-light text-dark px-4 ms-lg-2 rounded-3" href="{{ route('register') }}">
                        <i class="bi bi-person-plus me-1"></i>Регистрация
                    </a>
                </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>