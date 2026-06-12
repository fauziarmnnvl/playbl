@extends('layouts.admin')

@section('title', 'Riwayat Bermain — BoxPlay.id')
@section('breadcrumb', 'Laporan / Riwayat Bermain')

@section('content')
    <div class="page-header">
        <div>
            <h1>Riwayat Bermain</h1>
            <p>Arsip riwayat penggunaan Playbox oleh pelanggan</p>
        </div>
    </div>

    <div class="empty-state">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
        <h3>Segera Hadir</h3>
        <p>Fitur riwayat bermain sedang dalam pengembangan.</p>
    </div>
@endsection
