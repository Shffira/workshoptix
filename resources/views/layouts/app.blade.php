<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'WorkshopTix') - WorkshopTix</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --color-primary: #1b2a4a;
            --color-primary-dark: #111d35;
            --color-primary-light: #e4e8ef;
            --color-gray-50: #f9fafb;
            --color-gray-100: #f3f4f6;
            --color-gray-200: #e5e7eb;
            --color-gray-300: #d1d5db;
            --color-gray-400: #9ca3af;
            --color-gray-500: #6b7280;
            --color-gray-600: #4b5563;
            --color-gray-700: #374151;
            --color-gray-800: #1f2937;
            --color-gray-900: #111827;
            --color-green-50: #ecfdf5;
            --color-green-100: #d1fae5;
            --color-green-500: #10b981;
            --color-green-600: #059669;
            --color-green-700: #047857;
            --color-red-50: #fef2f2;
            --color-red-500: #ef4444;
            --color-red-600: #dc2626;
            --color-yellow-50: #fffbeb;
            --color-yellow-500: #f59e0b;
            --color-yellow-600: #d97706;
            --color-white: #ffffff;
            --shadow-sm: 0 1px 2px 0 rgb(0 0 0 / 0.05);
            --shadow: 0 1px 3px 0 rgb(0 0 0 / 0.1), 0 1px 2px -1px rgb(0 0 0 / 0.1);
            --shadow-md: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
            --shadow-lg: 0 10px 15px -3px rgb(0 0 0 / 0.1), 0 4px 6px -4px rgb(0 0 0 / 0.1);
            --radius: 8px;
            --radius-lg: 12px;
            --transition: 150ms ease;
        }

        body {
            font-family: 'Inter', sans-serif;
            font-size: 14px;
            line-height: 1.6;
            color: var(--color-gray-800);
            background-color: var(--color-gray-50);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        a { color: inherit; text-decoration: none; }

        /* ========== NAVBAR ========== */
        .navbar {
            background: var(--color-white);
            border-bottom: 1px solid var(--color-gray-200);
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .navbar-inner {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 24px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            height: 64px;
        }

        .navbar-brand {
            font-size: 20px;
            font-weight: 700;
            color: var(--color-gray-900);
            letter-spacing: -0.5px;
        }

        .navbar-brand span {
            color: var(--color-primary);
        }

        .navbar-nav {
            display: flex;
            align-items: center;
            gap: 4px;
            list-style: none;
        }

        .navbar-nav a {
            padding: 6px 12px;
            border-radius: var(--radius);
            font-weight: 500;
            color: var(--color-gray-600);
            transition: color var(--transition), background-color var(--transition);
            font-size: 14px;
        }

        .navbar-nav a:hover {
            color: var(--color-gray-900);
            background-color: var(--color-gray-100);
        }

        .navbar-nav a.active {
            color: var(--color-primary);
            background-color: var(--color-primary-light);
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            padding: 8px 16px;
            border-radius: var(--radius);
            font-size: 14px;
            font-weight: 500;
            border: 1px solid transparent;
            cursor: pointer;
            transition: all var(--transition);
            line-height: 1;
            white-space: nowrap;
        }

        .btn-primary {
            background-color: var(--color-primary);
            color: var(--color-white);
        }

        .btn-primary:hover {
            background-color: var(--color-primary-dark);
        }

        .btn-outline {
            background-color: transparent;
            border-color: var(--color-gray-300);
            color: var(--color-gray-700);
        }

        .btn-outline:hover {
            background-color: var(--color-gray-50);
            border-color: var(--color-gray-400);
        }

        .btn-danger {
            background-color: var(--color-red-600);
            color: var(--color-white);
        }

        .btn-danger:hover {
            background-color: #b91c1c;
        }

        .btn-success {
            background-color: var(--color-green-600);
            color: var(--color-white);
        }

        .btn-success:hover {
            background-color: var(--color-green-700);
        }

        .btn-sm {
            padding: 5px 10px;
            font-size: 12px;
        }

        .btn-lg {
            padding: 12px 24px;
            font-size: 15px;
        }

        .btn-block {
            width: 100%;
        }

        /* ========== CONTAINER ========== */
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 24px;
        }

        .container-sm {
            max-width: 640px;
            margin: 0 auto;
            padding: 0 24px;
        }

        /* ========== ALERT ========== */
        .alert {
            padding: 12px 16px;
            border-radius: var(--radius);
            font-size: 14px;
            border: 1px solid transparent;
            margin-bottom: 16px;
        }

        .alert-success {
            background-color: var(--color-green-50);
            border-color: var(--color-green-100);
            color: var(--color-green-700);
        }

        .alert-error {
            background-color: var(--color-red-50);
            border-color: #fecaca;
            color: var(--color-red-600);
        }

        .alert-info {
            background-color: var(--color-primary-light);
            border-color: #c3d6ff;
            color: var(--color-primary-dark);
        }

        .alert-warning {
            background-color: var(--color-yellow-50);
            border-color: #fde68a;
            color: var(--color-yellow-600);
        }

        /* ========== CARD ========== */
        .card {
            background: var(--color-white);
            border: 1px solid var(--color-gray-200);
            border-radius: var(--radius-lg);
            overflow: hidden;
        }

        .card-body {
            padding: 24px;
        }

        .card-header {
            padding: 16px 24px;
            border-bottom: 1px solid var(--color-gray-100);
        }

        /* ========== FORM ========== */
        .form-group {
            margin-bottom: 16px;
        }

        .form-label {
            display: block;
            font-size: 13px;
            font-weight: 500;
            color: var(--color-gray-700);
            margin-bottom: 6px;
        }

        .form-control {
            width: 100%;
            padding: 9px 12px;
            font-size: 14px;
            border: 1px solid var(--color-gray-300);
            border-radius: var(--radius);
            color: var(--color-gray-800);
            background-color: var(--color-white);
            transition: border-color var(--transition), box-shadow var(--transition);
            font-family: inherit;
        }

        .form-control:focus {
            outline: none;
            border-color: var(--color-primary);
            box-shadow: 0 0 0 3px rgb(26 86 219 / 0.1);
        }

        .form-control.is-invalid {
            border-color: var(--color-red-500);
        }

        .invalid-feedback {
            font-size: 12px;
            color: var(--color-red-500);
            margin-top: 4px;
        }

        textarea.form-control {
            min-height: 100px;
            resize: vertical;
        }

        /* ========== BADGE ========== */
        .badge {
            display: inline-flex;
            align-items: center;
            padding: 2px 8px;
            border-radius: 999px;
            font-size: 11px;
            font-weight: 600;
            letter-spacing: 0.3px;
            text-transform: uppercase;
        }

        .badge-green {
            background-color: var(--color-green-100);
            color: var(--color-green-700);
        }

        .badge-yellow {
            background-color: #fef3c7;
            color: var(--color-yellow-600);
        }

        .badge-red {
            background-color: #fee2e2;
            color: var(--color-red-600);
        }

        .badge-blue {
            background-color: var(--color-primary-light);
            color: var(--color-primary);
        }

        .badge-gray {
            background-color: var(--color-gray-100);
            color: var(--color-gray-600);
        }

        /* ========== TABLE ========== */
        .table-wrapper {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 14px;
        }

        th {
            text-align: left;
            padding: 10px 16px;
            font-size: 11px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: var(--color-gray-500);
            border-bottom: 1px solid var(--color-gray-200);
        }

        td {
            padding: 12px 16px;
            border-bottom: 1px solid var(--color-gray-100);
            color: var(--color-gray-700);
        }

        tr:last-child td { border-bottom: none; }

        tr:hover td { background-color: var(--color-gray-50); }

        /* ========== UTILITY ========== */
        .text-muted { color: var(--color-gray-500); }
        .text-sm { font-size: 12px; }
        .text-xs { font-size: 11px; }
        .text-lg { font-size: 16px; }
        .text-xl { font-size: 20px; }
        .text-2xl { font-size: 24px; }
        .font-medium { font-weight: 500; }
        .font-semibold { font-weight: 600; }
        .font-bold { font-weight: 700; }
        .mt-4 { margin-top: 16px; }
        .mt-6 { margin-top: 24px; }
        .mt-8 { margin-top: 32px; }
        .mb-2 { margin-bottom: 8px; }
        .mb-4 { margin-bottom: 16px; }
        .mb-6 { margin-bottom: 24px; }
        .mb-8 { margin-bottom: 32px; }
        .gap-2 { gap: 8px; }
        .gap-4 { gap: 16px; }
        .flex { display: flex; }
        .flex-col { flex-direction: column; }
        .items-center { align-items: center; }
        .items-start { align-items: flex-start; }
        .justify-between { justify-content: space-between; }
        .justify-end { justify-content: flex-end; }
        .flex-1 { flex: 1; }
        .grid { display: grid; }
        .grid-2 { grid-template-columns: repeat(2, 1fr); gap: 24px; }
        .grid-3 { grid-template-columns: repeat(3, 1fr); gap: 24px; }
        .grid-4 { grid-template-columns: repeat(4, 1fr); gap: 16px; }
        .w-full { width: 100%; }
        .truncate { overflow: hidden; text-overflow: ellipsis; white-space: nowrap; }
        .divider { border: none; border-top: 1px solid var(--color-gray-200); margin: 24px 0; }
        .page-header { padding: 32px 0 24px; }
        .page-title { font-size: 22px; font-weight: 700; color: var(--color-gray-900); letter-spacing: -0.5px; }
        .page-subtitle { font-size: 14px; color: var(--color-gray-500); margin-top: 4px; }

        /* ========== PAGINATION ========== */
        .pagination { display: flex; gap: 4px; list-style: none; padding: 24px 0 0; justify-content: center; }
        .pagination a, .pagination span {
            padding: 6px 12px;
            border-radius: var(--radius);
            font-size: 13px;
            font-weight: 500;
            border: 1px solid var(--color-gray-200);
            color: var(--color-gray-600);
            background: var(--color-white);
        }
        .pagination a:hover { background: var(--color-gray-50); }
        .pagination .active span {
            background: var(--color-primary);
            border-color: var(--color-primary);
            color: var(--color-white);
        }
        .pagination .disabled span { color: var(--color-gray-300); }

        /* ========== FOOTER ========== */
        footer {
            margin-top: auto;
            background: var(--color-white);
            border-top: 1px solid var(--color-gray-200);
            padding: 24px 0;
        }

        footer .footer-inner {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 24px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        footer .footer-brand {
            font-weight: 700;
            font-size: 15px;
            color: var(--color-gray-800);
        }

        footer .footer-brand span { color: var(--color-primary); }

        footer p {
            font-size: 13px;
            color: var(--color-gray-500);
        }

        @media (max-width: 768px) {
            .grid-3, .grid-4 { grid-template-columns: 1fr; }
            .grid-2 { grid-template-columns: 1fr; }
            .navbar-inner { padding: 0 16px; }
            .container { padding: 0 16px; }
            .hide-mobile { display: none; }
        }
    </style>
    @stack('styles')
</head>
<body>
    <nav class="navbar">
        <div class="navbar-inner">
            <a href="{{ route('workshops.index') }}" class="navbar-brand">Workshop<span>Tix</span></a>

            <ul class="navbar-nav">
                <li><a href="{{ route('workshops.index') }}" class="{{ request()->routeIs('workshops.*') ? 'active' : '' }}">Workshop</a></li>

                @auth
                    @if(auth()->user()->isAdmin())
                        <li><a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.*') ? 'active' : '' }}">Dashboard Admin</a></li>
                    @else
                        <li><a href="{{ route('registrations.index') }}" class="{{ request()->routeIs('registrations.*') ? 'active' : '' }}">Pendaftaran Saya</a></li>
                    @endif

                    <li>
                        <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                            @csrf
                            <button type="submit" class="btn btn-outline btn-sm">Keluar</button>
                        </form>
                    </li>
                @else
                    <li><a href="{{ route('login') }}">Masuk</a></li>
                    <li><a href="{{ route('register') }}" class="btn btn-primary btn-sm">Daftar</a></li>
                @endauth
            </ul>
        </div>
    </nav>

    <main style="flex: 1; padding: 0 0 48px;">
        @if(session('success'))
            <div class="container" style="padding-top: 16px;">
                <div class="alert alert-success">{{ session('success') }}</div>
            </div>
        @endif

        @if(session('error'))
            <div class="container" style="padding-top: 16px;">
                <div class="alert alert-error">{{ session('error') }}</div>
            </div>
        @endif

        @if(session('info'))
            <div class="container" style="padding-top: 16px;">
                <div class="alert alert-info">{{ session('info') }}</div>
            </div>
        @endif

        @yield('content')
    </main>

    <footer>
        <div class="footer-inner">
            <span class="footer-brand">Workshop<span>Tix</span></span>
            <p>&copy; {{ date('Y') }} WorkshopTix. Semua hak dilindungi.</p>
        </div>
    </footer>

    @stack('scripts')
</body>
</html>
