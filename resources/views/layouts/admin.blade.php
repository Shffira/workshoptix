
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title', 'Admin') | WorkshopTIX</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        :root {
            --color-primary: #07546a;
            --color-primary-dark: #064455;
            --color-navy: #252942;
            --color-yellow: #f3b957;
            --color-bg: #e9edef;
            --color-white: #ffffff;
            --color-gray-900: #252942;
            --color-gray-700: #50596a;
            --color-gray-600: #697386;
            --color-gray-500: #89909c;
            --color-gray-400: #aab1bb;
            --color-gray-200: #e5e9ec;
            --color-gray-100: #f1f3f4;
        }

        * {
            box-sizing: border-box;
            font-family: 'Inter', sans-serif;
        }

        body {
            margin: 0;
            background: var(--color-bg);
            color: var(--color-navy);
        }

        a {
            text-decoration: none;
        }

        .admin-wrapper {
            display: flex;
            min-height: 100vh;
            max-width: 1600px;
            margin: auto;
            padding: 25px;
            gap: 20px;
        }

        /* SIDEBAR */

        .sidebar {
            width: 250px;
            min-width: 250px;
            background: var(--color-navy);
            border-radius: 24px;
            padding: 0 15px 20px;
            color: white;
            display: flex;
            flex-direction: column;
        }

        .profile {
            background: var(--color-primary);
            margin: 0 -15px 20px;
            padding: 30px 15px;
            border-radius: 24px 24px 20px 20px;
            text-align: center;
        }

        .profile-icon {
            width: 65px;
            height: 65px;
            border: 3px solid white;
            border-radius: 50%;
            display: grid;
            place-items: center;
            margin: 0 auto 12px;
            font-size: 27px;
        }

        .profile h6 {
            font-size: 15px;
            margin: 0 0 8px;
            font-weight: 700;
        }

        .profile small {
            color: #d0e0e5;
            font-size: 11px;
            overflow-wrap: anywhere;
        }

        .sidebar-menu {
            display: flex;
            flex-direction: column;
            gap: 9px;
        }

        .sidebar-menu a {
            color: #e2e5ee;
            text-decoration: none;
            padding: 14px 15px;
            border-radius: 30px;
            display: flex;
            align-items: center;
            gap: 13px;
            font-size: 13px;
            transition: .2s;
        }

        .sidebar-menu a:hover,
        .sidebar-menu a.active {
            background: #edf1f1;
            color: var(--color-primary);
            font-weight: 700;
        }

        .sidebar-menu i {
            font-size: 17px;
            width: 20px;
        }

        .sidebar-footer {
            margin-top: auto;
            padding-top: 25px;
        }

        .sidebar-footer button {
            width: 100%;
            border: 0;
            background: transparent;
            color: white;
            text-align: left;
            padding: 12px;
            font-size: 13px;
            cursor: pointer;
        }

        /* MAIN */

        .main-content {
            flex: 1;
            min-width: 0;
        }

        .topbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 22px;
            gap: 15px;
        }

        .topbar h4 {
            font-size: 25px;
            font-weight: 800;
            margin: 0;
        }

        .topbar p {
            font-size: 12px;
            color: var(--color-gray-500);
            margin: 6px 0 0;
        }

        .admin-badge {
            background: white;
            padding: 11px 16px;
            border-radius: 30px;
            font-size: 12px;
            font-weight: 600;
            white-space: nowrap;
        }

        /* PAGE CONTENT */

        .page-content {
            width: 100%;
        }

        .page-toolbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 12px;
            margin-bottom: 18px;
        }

        .page-description {
            color: var(--color-gray-500);
            font-size: 12px;
        }

        .card {
            background: white;
            border: none;
            border-radius: 17px;
            box-shadow: 0 2px 8px #00000008;
            overflow: hidden;
            margin-bottom: 18px;
        }

        .card-header {
            padding: 20px 22px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid var(--color-gray-100);
            background: white;
        }

        .card-header h2,
        .card-header h3 {
            font-size: 15px;
            font-weight: 700;
            margin: 0;
        }

        .card-body {
            padding: 22px;
        }

        /* TABLE */

        .table-wrapper {
            width: 100%;
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            min-width: 700px;
        }

        thead th {
            background: #fafbfc;
            color: var(--color-gray-500);
            text-align: left;
            padding: 15px 16px;
            font-size: 10px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .4px;
            border-bottom: 1px solid var(--color-gray-200);
            white-space: nowrap;
        }

        tbody td {
            padding: 15px 16px;
            font-size: 12px;
            border-bottom: 1px solid #f0f1f3;
            vertical-align: middle;
        }

        tbody tr:last-child td {
            border-bottom: none;
        }

        tbody tr:hover {
            background: #fafcfc;
        }

        /* FORM */

        .form-group {
            margin-bottom: 19px;
        }

        .form-label {
            display: block;
            font-size: 12px;
            font-weight: 600;
            color: var(--color-gray-900);
            margin-bottom: 8px;
        }

        .form-control {
            width: 100%;
            min-height: 43px;
            border: 1px solid var(--color-gray-200);
            background: white;
            border-radius: 9px;
            padding: 11px 13px;
            font-size: 12px;
            color: var(--color-gray-900);
            outline: none;
            transition: .2s;
        }

        .form-control:focus {
            border-color: var(--color-primary);
            box-shadow: 0 0 0 3px #07546a15;
        }

        textarea.form-control {
            resize: vertical;
            line-height: 1.6;
        }

        input[type="checkbox"] {
            accent-color: var(--color-primary);
        }

        .form-hint {
            color: var(--color-gray-500);
            font-size: 10px;
            margin-top: 6px;
        }

        .grid-2 {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 15px;
        }

        /* BUTTON */

        .btn {
            display: inline-flex;
            justify-content: center;
            align-items: center;
            gap: 7px;
            padding: 10px 16px;
            border-radius: 9px;
            border: 1px solid transparent;
            font-size: 12px;
            font-weight: 600;
            cursor: pointer;
            transition: .2s;
            white-space: nowrap;
        }

        .btn-primary {
            background: var(--color-primary);
            color: white;
        }

        .btn-primary:hover {
            background: var(--color-primary-dark);
            color: white;
        }

        .btn-outline {
            background: white;
            color: var(--color-navy);
            border-color: var(--color-gray-200);
        }

        .btn-outline:hover {
            background: var(--color-gray-100);
        }

        .btn-danger {
            background: #dc4545;
            color: white;
        }

        .btn-danger:hover {
            background: #bd3030;
            color: white;
        }

        .btn-sm {
            padding: 7px 10px;
            font-size: 10px;
        }

        .btn-lg {
            padding: 12px 19px;
        }

        /* BADGES */

        .badge {
            display: inline-block;
            padding: 6px 10px;
            border-radius: 20px;
            font-size: 10px;
            font-weight: 700;
            white-space: nowrap;
        }

        .badge-green {
            background: #d9f5e7;
            color: #168453;
        }

        .badge-yellow {
            background: #fff0d4;
            color: #b77916;
        }

        .badge-red {
            background: #ffe1e1;
            color: #c03939;
        }

        .badge-gray {
            background: #edf0f1;
            color: #687080;
        }

        /* ALERT */

        .alert {
            padding: 14px 16px;
            border-radius: 10px;
            margin-bottom: 18px;
            font-size: 12px;
        }

        .alert-error {
            background: #ffe7e7;
            color: #bd3030;
        }

        .alert-success {
            background: #d9f5e7;
            color: #168453;
        }

        /* PAGINATION */

        .pagination {
            display: flex;
            justify-content: flex-end;
            align-items: center;
            gap: 5px;
            margin: 18px 0;
            list-style: none;
            padding: 0;
        }

        .pagination li a,
        .pagination li span {
            display: block;
            padding: 8px 12px;
            border-radius: 8px;
            background: white;
            color: var(--color-navy);
            font-size: 11px;
            border: 1px solid var(--color-gray-200);
        }

        .pagination li.active span {
            background: var(--color-primary);
            color: white;
            border-color: var(--color-primary);
        }

        .pagination li.disabled span {
            opacity: .45;
        }

        /* RESPONSIVE */

        @media(max-width: 992px) {
            .admin-wrapper {
                padding: 15px;
            }

            .sidebar {
                width: 210px;
                min-width: 210px;
            }
        }

        @media(max-width: 768px) {
            .admin-wrapper {
                flex-direction: column;
                padding: 12px;
            }

            .sidebar {
                width: 100%;
                min-width: 0;
            }

            .sidebar-menu {
                display: grid;
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }

            .sidebar-footer {
                margin-top: 10px;
            }

            .topbar h4 {
                font-size: 19px;
            }

            .grid-2 {
                grid-template-columns: 1fr;
                gap: 0;
            }

            .card-body {
                padding: 17px;
            }

            .topbar {
                align-items: flex-start;
            }
        }

        @media(max-width: 420px) {
            .sidebar-menu {
                grid-template-columns: 1fr;
            }

            .admin-badge {
                display: none;
            }
        }
    </style>

    @stack('styles')
</head>

<body>

<div class="admin-wrapper">

    <!-- SIDEBAR -->
    <aside class="sidebar">

        <div class="profile">
            <div class="profile-icon">
                <i class="bi bi-person"></i>
            </div>

            <h6>{{ auth()->user()->name }}</h6>
            <small>{{ auth()->user()->email }}</small>
        </div>

        <nav class="sidebar-menu">

            <a href="{{ route('admin.dashboard') }}"
               class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="bi bi-grid-fill"></i>
                Dashboard
            </a>

            <a href="{{ route('admin.workshops.index') }}"
               class="{{ request()->routeIs('admin.workshops.*') ? 'active' : '' }}">
                <i class="bi bi-easel"></i>
                Data Workshop
            </a>

            <a href="{{ route('admin.registrations.index') }}"
               class="{{ request()->routeIs('admin.registrations.*') ? 'active' : '' }}">
                <i class="bi bi-clipboard-check"></i>
                Pendaftaran
            </a>

            <a href="{{ route('admin.participants.index') }}"
               class="{{ request()->routeIs('admin.participants.*') ? 'active' : '' }}">
                <i class="bi bi-people"></i>
                Peserta
            </a>

            <a href="{{ route('admin.tickets.index') }}"
               class="{{ request()->routeIs('admin.tickets.*') ? 'active' : '' }}">
                <i class="bi bi-ticket-perforated"></i>
                Tiket Digital
            </a>

            <a href="{{ route('admin.payments.index') }}"
               class="{{ request()->routeIs('admin.payments.*') ? 'active' : '' }}">
                <i class="bi bi-credit-card"></i>
                Pembayaran
            </a>

        </nav>

        <div class="sidebar-footer">
            <form action="{{ route('logout') }}" method="POST">
                @csrf

                <button type="submit">
                    <i class="bi bi-box-arrow-left me-2"></i>
                    Logout
                </button>
            </form>
        </div>

    </aside>

    <!-- MAIN CONTENT -->
    <main class="main-content">

        <header class="topbar">
            <div>
                <h4>@yield('page-title', 'Admin Dashboard')</h4>

                <p>
                    @yield('page-description', 'Overview of your workshop management system.')
                </p>
            </div>

            <div class="admin-badge">
                <i class="bi bi-person-circle me-2"></i>
                Administrator
            </div>
        </header>

        <section class="page-content">

            @if(session('success'))
                <div class="alert alert-success">
                    <i class="bi bi-check-circle me-2"></i>
                    {{ session('success') }}
                </div>
            @endif

            @yield('content')

        </section>

    </main>

</div>

@stack('scripts')

</body>
</html>
