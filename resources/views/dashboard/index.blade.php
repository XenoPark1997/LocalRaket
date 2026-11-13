@extends('layouts.dashboard')

@section('title', 'Dashboard')

@section('content')
    <section class="welcome-banner">
        <p class="eyebrow">YOUR CAREER, IN MOTION</p>
        <h1>Good to have you here, {{ auth()->user()->username }}.</h1>
        <p>Your LocalRaket workspace is ready. Choose a section to get started.</p>
    </section>

    <div class="section-heading">
        <div>
            <p class="eyebrow">WORKSPACE</p>
            <h2>Explore your workspace</h2>
        </div>
    </div>

    <div class="feature-grid">
        <a class="feature-card" href="{{ route('file-maintenance') }}">
            <span class="feature-indicator" aria-hidden="true"></span>
            <h3>File Maintenance</h3>
            <p>Manage your career documents and records.</p>
        </a>
        <a class="feature-card" href="{{ route('profile') }}">
            <span class="feature-indicator" aria-hidden="true"></span>
            <h3>Profile</h3>
            <p>Review and update your profile.</p>
        </a>
        <a class="feature-card" href="{{ route('job-application') }}">
            <span class="feature-indicator" aria-hidden="true"></span>
            <h3>Job Application</h3>
            <p>Keep track of your applications.</p>
        </a>
        <a class="feature-card" href="{{ route('job-posting') }}">
            <span class="feature-indicator" aria-hidden="true"></span>
            <h3>Job Posting</h3>
            <p>Review and organize your offers.</p>
        </a>
        <a class="feature-card" href="{{ route('settings') }}">
            <span class="feature-indicator" aria-hidden="true"></span>
            <h3>Settings</h3>
            <p>Manage your account preferences.</p>
        </a>
    </div>
@endsection
