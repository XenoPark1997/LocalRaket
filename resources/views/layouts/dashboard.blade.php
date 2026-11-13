<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Dashboard') | LocalRaket</title>
    <link rel="stylesheet" href="{{ asset('css/localraket.css') }}">
</head>
<body class="app-page">
    <div class="app-shell">
        <aside class="sidebar">
            <a class="brand brand-dark" href="{{ route('dashboard') }}">
                <span class="brand-mark">L</span>
                <span>LocalRaket</span>
            </a>

            <p class="nav-caption">WORKSPACE</p>
            <nav class="main-nav" aria-label="Main navigation">
                <a class="nav-link {{ request()->routeIs('file-maintenance') ? 'active' : '' }}"
                   href="{{ route('file-maintenance') }}"
                   @if (request()->routeIs('file-maintenance')) aria-current="page" @endif>
                    File Maintenance
                </a>
                <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}"
                   href="{{ route('dashboard') }}"
                   @if (request()->routeIs('dashboard')) aria-current="page" @endif>
                    Dashboard
                </a>
                <a class="nav-link {{ request()->routeIs('profile') ? 'active' : '' }}"
                   href="{{ route('profile') }}"
                   @if (request()->routeIs('profile')) aria-current="page" @endif>
                    Profile
                </a>
                <a class="nav-link {{ request()->routeIs('job-application') ? 'active' : '' }}"
                   href="{{ route('job-application') }}"
                   @if (request()->routeIs('job-application')) aria-current="page" @endif>
                    Job Application
                </a>
                <a class="nav-link {{ request()->routeIs('job-posting') ? 'active' : '' }}"
                   href="{{ route('job-posting') }}"
                   @if (request()->routeIs('job-posting')) aria-current="page" @endif>
                    Job Posting
                </a>
                <a class="nav-link {{ request()->routeIs('settings') ? 'active' : '' }}"
                   href="{{ route('settings') }}"
                   @if (request()->routeIs('settings')) aria-current="page" @endif>
                    Settings
                </a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="nav-link logout-link" type="submit">Logout</button>
                </form>
            </nav>

            <div class="sidebar-bottom">
                <span class="avatar" aria-hidden="true">{{ mb_strtoupper(mb_substr(auth()->user()->username, 0, 1)) }}</span>
                <span class="sidebar-username">{{ auth()->user()->username }}</span>
            </div>
        </aside>

        <main class="dashboard-main">
            <header class="topbar">
                <span class="topbar-label">Your workspace</span>
                <span class="topbar-greeting">Welcome, {{ auth()->user()->username }}</span>
            </header>
            <div class="dashboard-content">
                @yield('content')
            </div>
        </main>
    </div>
</body>
</html>
