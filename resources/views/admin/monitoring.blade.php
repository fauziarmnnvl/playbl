@extends('layouts.admin')

@section('title', 'Monitoring Playbox — BoxPlay.id')
@section('breadcrumb', 'Menu Utama / Monitoring Playbox')

@section('content')
    <div class="page-header">
        <div>
            <h1>Monitoring Playbox</h1>
            <p>Pantau status mesin Playbox secara real-time</p>
        </div>
    </div>

    <div class="empty-state">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="2" y="3" width="20" height="14" rx="2" ry="2"/><line x1="8" y1="21" x2="16" y2="21"/><line x1="12" y1="17" x2="12" y2="21"/></svg>
        <h3>Segera Hadir</h3>
        <p>Fitur monitoring real-time sedang dalam pengembangan.</p>
    </div>
@endsection
