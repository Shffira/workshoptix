
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Admin Dashboard | WorkshopTIX</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        :root {
            --navy: #252942;
            --teal: #07546a;
            --cream: #f3f4f2;
            --yellow: #f3b957;
            --text: #252942;
            --muted: #89909c;
        }

        * {
            font-family: 'Inter', sans-serif;
        }

        body {
            background: #e9edef;
            color: var(--text);
        }

        .dashboard-wrapper {
            display: flex;
            min-height: 100vh;
            max-width: 1600px;
            margin: auto;
            padding: 25px;
            gap: 20px;
        }

        .sidebar {
            width: 235px;
            min-width: 235px;
            background: var(--navy);
            border-radius: 24px;
            padding: 0 15px 20px;
            color: white;
            display: flex;
            flex-direction: column;
        }

        .profile {
            background: var(--teal);
            padding: 30px 15px;
            margin: 0 -15px 20px;
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
            margin: auto auto 12px;
            font-size: 28px;
        }

        .profile h6 {
            margin-bottom: 5px;
            font-weight: 700;
        }

        .profile small {
            color: #d0e0e5;
            font-size: 11px;
        }

        .sidebar-menu {
            display: flex;
            flex-direction: column;
            gap: 9px;
        }

        .sidebar-menu a {
            color: #e2e5ee;
            text-decoration: none;
            padding: 13px 15px;
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
            color: var(--teal);
            font-weight: 700;
        }

        .sidebar-menu i {
            font-size: 17px;
        }

        .sidebar-footer {
            margin-top: auto;
            padding-top: 25px;
        }

        .sidebar-footer button {
            width: 100%;
            border: none;
            background: transparent;
            color: white;
            text-align: left;
            padding: 12px;
        }

        .main-content {
            flex: 1;
            min-width: 0;
        }

        .topbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 22px;
        }

        .topbar h4 {
            font-weight: 800;
            margin: 0;
        }

        .topbar p {
            font-size: 12px;
            color: var(--muted);
            margin: 5px 0 0;
        }

        .admin-badge {
            background: white;
            padding: 10px 15px;
            border-radius: 30px;
            font-size: 12px;
            font-weight: 600;
        }

        .stat-card {
            border: none;
            border-radius: 13px;
            padding: 20px;
            height: 125px;
            color: white;
            box-shadow: 0 3px 8px #00000012;
        }

        .stat-card.teal {
            background: var(--teal);
        }

        .stat-card.yellow {
            background: var(--yellow);
            color: #303044;
        }

        .stat-card.navy {
            background: var(--navy);
        }

        .stat-card.light {
            background: white;
            color: var(--navy);
        }

        .stat-heading {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 12px;
        }

        .stat-icon {
            background: #ffffffdc;
            color: var(--teal);
            width: 32px;
            height: 32px;
            display: grid;
            place-items: center;
            border-radius: 50%;
        }

        .stat-value {
            font-size: 23px;
            font-weight: 800;
            margin-top: 9px;
        }

        .stat-footer {
            font-size: 10px;
            opacity: .75;
            margin-top: 4px;
        }

        .panel {
            background: white;
            border-radius: 17px;
            padding: 20px;
            height: 100%;
            box-shadow: 0 2px 8px #00000008;
        }

        .panel-title {
            font-weight: 700;
            font-size: 15px;
            margin-bottom: 18px;
        }

        .registration-item {
            border: 1px solid #edf0f1;
            border-radius: 10px;
            padding: 12px;
            margin-bottom: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 10px;
        }

        .registration-item h6 {
            font-size: 12px;
            font-weight: 700;
            margin: 0 0 5px;
        }

        .registration-item small {
            color: var(--muted);
            font-size: 10px;
        }

        .status {
            font-size: 10px;
            padding: 6px 9px;
            border-radius: 20px;
            font-weight: 700;
            white-space: nowrap;
        }

        .status.paid {
            background: #d9f5e7;
            color: #168453;
        }

        .status.pending {
            background: #fff0d4;
            color: #b77916;
        }

        .status.cancelled {
            background: #ffe1e1;
            color: #c03939;
        }

        .category-item {
            margin-bottom: 19px;
        }

        .category-info {
            display: flex;
            justify-content: space-between;
            font-size: 12px;
            margin-bottom: 8px;
        }

        .progress {
            height: 8px;
            background: #edf0f1;
            border-radius: 20px;
        }

        .progress-bar {
            background: var(--yellow);
            border-radius: 20px;
        }

        .chart-panel {
            min-height: 320px;
        }

        .quick-link {
            display: flex;
            align-items: center;
            gap: 13px;
            padding: 15px 5px;
            border-bottom: 1px solid #edf0f1;
            color: var(--navy);
            text-decoration: none;
            font-size: 12px;
            font-weight: 600;
        }

        .quick-link:last-child {
            border-bottom: none;
        }

        .quick-icon {
            width: 35px;
            height: 35px;
            background: #e8f1f3;
            color: var(--teal);
            display: grid;
            place-items: center;
            border-radius: 9px;
        }

        .view-link {
            color: var(--teal);
            text-decoration: none;
            font-size: 12px;
            font-weight: 700;
        }

        @media(max-width: 992px) {
            .dashboard-wrapper {
                padding: 12px;
            }

            .sidebar {
                width: 190px;
                min-width: 190px;
            }
        }

        @media(max-width: 768px) {
            .dashboard-wrapper {
                flex-direction: column;
            }

            .sidebar {
                width: 100%;
                min-width: 0;
            }

            .sidebar-menu {
                display: grid;
                grid-template-columns: repeat(2, 1fr);
            }

            .sidebar-footer {
                margin-top: 10px;
            }

            .topbar h4 {
                font-size: 18px;
            }
        }
        .chart-panel canvas {
    height: 240px !important;
}
    </style>
</head>

<body>

<div class="dashboard-wrapper">

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

            <a href="{{ route('admin.dashboard') }}" class="active">
                <i class="bi bi-grid-fill"></i>
                Dashboard
            </a>

            <a href="{{ route('admin.workshops.index') }}">
                <i class="bi bi-easel"></i>
                Data Workshop
            </a>

            <a href="{{ route('admin.registrations.index') }}">
                <i class="bi bi-clipboard-check"></i>
                Pendaftaran
            </a>

            <a href="{{ route('admin.registrations.index') }}">
                <i class="bi bi-people"></i>
                Peserta
            </a>

            <a href="{{ route('admin.registrations.index') }}">
                <i class="bi bi-ticket-perforated"></i>
                Tiket Digital
            </a>

            <a href="{{ route('admin.registrations.index') }}">
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

        <div class="topbar">
            <div>
                <h4>Admin Dashboard</h4>
                <p>Overview of your workshop management system.</p>
            </div>

            <div class="admin-badge">
                <i class="bi bi-person-circle me-2"></i>
                Administrator
            </div>
        </div>

        <!-- STATISTICS -->
        <div class="row g-3 mb-4">

            <div class="col-6 col-xl-3">
                <div class="stat-card teal">
                    <div class="stat-heading">
                        Total Peserta
                        <span class="stat-icon">
                            <i class="bi bi-people"></i>
                        </span>
                    </div>
                    <div class="stat-value">
                        {{ number_format($totalParticipants) }}
                    </div>
                    <div class="stat-footer">
                        Seluruh akun peserta
                    </div>
                </div>
            </div>

            <div class="col-6 col-xl-3">
                <div class="stat-card yellow">
                    <div class="stat-heading">
                        Tiket Terjual
                        <span class="stat-icon">
                            <i class="bi bi-ticket-perforated"></i>
                        </span>
                    </div>
                    <div class="stat-value">
                        {{ number_format($totalTickets) }}
                    </div>
                    <div class="stat-footer">
                        Pendaftaran lunas
                    </div>
                </div>
            </div>

            <div class="col-6 col-xl-3">
                <div class="stat-card teal">
                    <div class="stat-heading">
                        Total Pendapatan
                        <span class="stat-icon">
                            <i class="bi bi-wallet2"></i>
                        </span>
                    </div>
                    <div class="stat-value" style="font-size:19px">
                        Rp {{ number_format($totalRevenue, 0, ',', '.') }}
                    </div>
                    <div class="stat-footer">
                        Pembayaran berhasil
                    </div>
                </div>
            </div>

            <div class="col-6 col-xl-3">
                <div class="stat-card navy">
                    <div class="stat-heading">
                        Total Workshop
                        <span class="stat-icon">
                            <i class="bi bi-easel"></i>
                        </span>
                    </div>
                    <div class="stat-value">
                        {{ number_format($totalWorkshops) }}
                    </div>
                    <div class="stat-footer">
                        Workshop terdaftar
                    </div>
                </div>
            </div>

        </div>

        <!-- REGISTRATIONS AND CATEGORIES -->
        <div class="row g-3 mb-4">

            <div class="col-lg-7">
                <div class="panel">

                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h6 class="panel-title mb-0">
                            Pendaftaran Terbaru
                        </h6>

                        <a href="{{ route('admin.registrations.index') }}"
                           class="view-link">
                            Lihat Semua
                        </a>
                    </div>

                    @forelse($latestRegistrations as $registration)

                        <div class="registration-item">

                            <div>
                                <h6>
                                    {{ $registration->user->name ?? 'Peserta' }}
                                </h6>

                                <small>
                                    {{ $registration->workshop->title ?? 'Workshop' }}
                                </small>

                                <br>

                                <small>
                                    {{ $registration->created_at->format('d M Y, H:i') }}
                                </small>
                            </div>

                            <span class="status {{ $registration->status }}">
                                {{ ucfirst($registration->status) }}
                            </span>

                        </div>

                    @empty

                        <div class="text-center py-5 text-muted">
                            <i class="bi bi-inbox fs-2"></i>
                            <p class="small mt-2">
                                Belum ada pendaftaran.
                            </p>
                        </div>

                    @endforelse

                </div>
            </div>

            <div class="col-lg-5">
                <div class="panel">

                    <h6 class="panel-title">
                        Statistik Kategori Workshop
                    </h6>

                    @forelse($categoryStats as $category => $total)

                        <div class="category-item">

                            <div class="category-info">
                                <span>{{ $category }}</span>
                                <strong>{{ $total }} Pendaftar</strong>
                            </div>

                            <div class="progress">
                                <div class="progress-bar"
                                     style="width: {{ $totalRegistrations > 0 ? ($total / $totalRegistrations) * 100 : 0 }}%">
                                </div>
                            </div>

                        </div>

                    @empty

                        <p class="text-muted small">
                            Belum ada data kategori.
                        </p>

                    @endforelse

                    <hr>

                    <div class="d-flex justify-content-between">
                        <span class="small text-muted">
                            Menunggu pembayaran
                        </span>

                        <strong>{{ $pendingPayments }}</strong>
                    </div>

                </div>
            </div>

        </div>

        <!-- CHART AND QUICK LINKS -->
        <div class="row g-3">

            <div class="col-lg-8">
                <div class="panel chart-panel">

                    <h6 class="panel-title">
                        Grafik Pendaftaran
                    </h6>

                    <canvas id="registrationChart"></canvas>

                </div>
            </div>

            <div class="col-lg-4">
                <div class="panel">

                    <h6 class="panel-title">
                        Quick Access
                    </h6>

                    <a href="{{ route('admin.workshops.create') }}"
                       class="quick-link">

                        <span class="quick-icon">
                            <i class="bi bi-plus-lg"></i>
                        </span>

                        Tambah Workshop
                    </a>

                    <a href="{{ route('admin.registrations.index') }}"
                       class="quick-link">

                        <span class="quick-icon">
                            <i class="bi bi-person-lines-fill"></i>
                        </span>

                        Kelola Pendaftaran
                    </a>

                    <a href="{{ route('admin.registrations.index') }}"
                       class="quick-link">

                        <span class="quick-icon">
                            <i class="bi bi-ticket-detailed"></i>
                        </span>

                        Kelola Tiket Digital
                    </a>

                    <a href="{{ route('admin.registrations.index') }}"
                       class="quick-link">

                        <span class="quick-icon">
                            <i class="bi bi-cash-stack"></i>
                        </span>

                        Verifikasi Pembayaran
                    </a>

                </div>
            </div>

        </div>

    </main>

</div>

<script>
    const ctx = document.getElementById('registrationChart');

    new Chart(ctx, {
        type: 'line',

        data: {
            labels: @json($monthlyLabels),

            datasets: [{
                label: 'Jumlah Pendaftaran',

                data: @json($monthlyRegistrations),

                borderColor: '#07546a',

                backgroundColor: 'rgba(7, 84, 106, 0.08)',

                borderWidth: 2.5,

                tension: 0.4,

                fill: true,

                pointRadius: 4,

                pointBackgroundColor: '#f3b957'
            }]
        },

        options: {
            responsive: true,

            maintainAspectRatio: false,

            plugins: {
                legend: {
                    display: false
                }
            },

            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        precision: 0
                    }
                }
            }
        }
    });
</script>

</body>
</html>
