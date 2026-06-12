<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'BoxPlay.id Admin')</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/css/admin.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body>
    <div class="admin-wrapper">
        {{-- ========== SIDEBAR ========== --}}
        <aside class="admin-sidebar" id="adminSidebar">
            <div class="sidebar-brand">
                <svg class="sidebar-brand-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <rect x="2" y="6" width="20" height="12" rx="2"/>
                    <circle cx="8" cy="12" r="1.5"/>
                    <circle cx="16" cy="12" r="1.5"/>
                    <path d="M9 2L12 6M15 2L12 6"/>
                </svg>
                <span>BoxPlay.id</span>
            </div>

            <nav class="sidebar-nav">
                {{-- MENU UTAMA --}}
                <div class="sidebar-group">
                    <span class="sidebar-group-label">Menu Utama</span>

                    <a href="{{ route('admin.dashboard') }}"
                       class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
                        <span>Dashboard</span>
                    </a>

                    <a href="{{ route('admin.monitoring') }}"
                       class="sidebar-link {{ request()->routeIs('admin.monitoring') ? 'active' : '' }}">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="3" width="20" height="14" rx="2" ry="2"/><line x1="8" y1="21" x2="16" y2="21"/><line x1="12" y1="17" x2="12" y2="21"/></svg>
                        <span>Monitoring Playbox</span>
                    </a>
                </div>

                {{-- DATA (MASTER) --}}
                <div class="sidebar-group">
                    <span class="sidebar-group-label">Data Master</span>

                    <a href="{{ route('admin.playbox.index') }}"
                       class="sidebar-link {{ request()->routeIs('admin.playbox.*') ? 'active' : '' }}">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="6" width="20" height="12" rx="2"/><line x1="6" y1="12" x2="6" y2="12"/><line x1="18" y1="10" x2="18" y2="10"/><line x1="18" y1="14" x2="18" y2="14"/><line x1="14" y1="12" x2="14" y2="12"/></svg>
                        <span>Manajemen Playbox</span>
                    </a>

                    <a href="{{ route('admin.game.index') }}"
                       class="sidebar-link {{ request()->routeIs('admin.game.*') ? 'active' : '' }}">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 7h-3a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2h3"/><path d="M4 7h3a2 2 0 0 1 2 2v6a2 2 0 0 1-2 2H4"/><rect x="9" y="4" width="6" height="16" rx="1"/></svg>
                        <span>Manajemen Game</span>
                    </a>

                    <a href="{{ route('admin.cabang.index') }}"
                       class="sidebar-link {{ request()->routeIs('admin.cabang.*') ? 'active' : '' }}">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 21h18"/><path d="M5 21V7l8-4v18"/><path d="M19 21V11l-6-4"/><path d="M9 9h1"/><path d="M9 13h1"/><path d="M9 17h1"/></svg>
                        <span>Manajemen Cabang</span>
                    </a>

                    <a href="{{ route('admin.promo.index') }}"
                       class="sidebar-link {{ request()->routeIs('admin.promo.*') ? 'active' : '' }}">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"/><line x1="7" y1="7" x2="7.01" y2="7"/></svg>
                        <span>Event & Promo</span>
                    </a>

                    <a href="{{ route('admin.pelanggan') }}"
                       class="sidebar-link {{ request()->routeIs('admin.pelanggan') ? 'active' : '' }}">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                        <span>Data Pelanggan</span>
                    </a>
                </div>

                {{-- LAPORAN --}}
                <div class="sidebar-group">
                    <span class="sidebar-group-label">Laporan</span>

                    <a href="{{ route('admin.riwayat') }}"
                       class="sidebar-link {{ request()->routeIs('admin.riwayat') ? 'active' : '' }}">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                        <span>Riwayat Bermain</span>
                    </a>

                    <a href="{{ route('admin.statistik') }}"
                       class="sidebar-link {{ request()->routeIs('admin.statistik*') ? 'active' : '' }}">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="20" x2="18" y2="10"/><line x1="12" y1="20" x2="12" y2="4"/><line x1="6" y1="20" x2="6" y2="14"/></svg>
                        <span>Laporan & Statistik</span>
                    </a>
                </div>

                {{-- PENGATURAN --}}
                <div class="sidebar-group">
                    <span class="sidebar-group-label">Pengaturan</span>

                    <a href="{{ route('admin.aktivitas') }}"
                       class="sidebar-link {{ request()->routeIs('admin.aktivitas') ? 'active' : '' }}">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                        <span>Riwayat Aktivitas</span>
                    </a>
                </div>
            </nav>

            {{-- LOGOUT --}}
            <div class="sidebar-footer">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="sidebar-link sidebar-logout">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>
                        <span>Logout</span>
                    </button>
                </form>
            </div>
        </aside>

        {{-- ========== MAIN CONTENT ========== --}}
        <div class="admin-main">
            {{-- Top Bar --}}
            <header class="admin-topbar">
                <div class="topbar-left">
                    <button class="sidebar-toggle" id="sidebarToggle" aria-label="Toggle sidebar">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <line x1="3" y1="12" x2="21" y2="12"/>
                            <line x1="3" y1="6" x2="21" y2="6"/>
                            <line x1="3" y1="18" x2="21" y2="18"/>
                        </svg>
                    </button>
                    <div class="topbar-title">
                        <h2>@yield('page_title', 'Dashboard')</h2>
                        <p>@yield('page_description', 'Ringkasan sistem dan operasional')</p>
                    </div>
                </div>
                <div class="topbar-right">
                    <button class="topbar-notification">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M18 8a6 6 0 0 0-12 0c0 7-3 9-3 9h18s-3-2-3-9"/>
                            <path d="M13.73 21a2 2 0 0 1-3.46 0"/>
                        </svg>
                    </button>
                    <div class="topbar-user">
                        <div class="user-avatar">
                            {{ strtoupper(substr(Auth::user()->nama ?? 'A',0,1)) }}
                        </div>
                        <div class="user-meta">
                            <strong>{{ Auth::user()->nama ?? 'Admin' }}</strong>
                        </div>
                    </div>
                </div>
            </header>

            {{-- Content Area --}}
            <main class="admin-content">
                {{-- Flash Messages --}}
                @if (session('success'))
                    <div class="alert alert-success" id="flashSuccess">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                        <span>{{ session('success') }}</span>
                        <button class="alert-close" onclick="this.parentElement.remove()">&times;</button>
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-error" id="flashError">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="15" y1="9" x2="9" y2="15"/><line x1="9" y1="9" x2="15" y2="15"/></svg>
                        <span>{{ session('error') }}</span>
                        <button class="alert-close" onclick="this.parentElement.remove()">&times;</button>
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>

    {{-- Sidebar toggle script --}}
    <script>
        document.getElementById('sidebarToggle')?.addEventListener('click', function() {
            document.getElementById('adminSidebar').classList.toggle('collapsed');
            document.querySelector('.admin-main').classList.toggle('expanded');
        });

        // Auto-dismiss flash messages after 5 seconds
        setTimeout(function() {
            document.getElementById('flashSuccess')?.remove();
            document.getElementById('flashError')?.remove();
        }, 5000);
    </script>

    @livewireScripts
</body>
</html>
