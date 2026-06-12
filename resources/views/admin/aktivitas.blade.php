@extends('layouts.admin')

@section('title', 'Riwayat Aktivitas — BoxPlay.id')
@section('breadcrumb', 'Pengaturan / Riwayat Aktivitas')

@section('content')
    <div class="page-header">
        <div>
            <h1>Riwayat Aktivitas</h1>
            <p>Audit trail — catatan perubahan data oleh pengguna sistem</p>
        </div>
    </div>

    <div class="empty-state">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
        <h3>Segera Hadir</h3>
        <p>Fitur riwayat aktivitas sedang dalam pengembangan.</p>
    </div>
@endsection
