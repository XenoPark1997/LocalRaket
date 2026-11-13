@extends('layouts.dashboard')

@section('title', $title)

@section('content')
    <section class="welcome-banner">
        <p class="eyebrow">LOCALRAKET WORKSPACE</p>
        <h1>{{ $title }}</h1>
        <p>This section is ready for its LocalRaket features.</p>
    </section>
@endsection
