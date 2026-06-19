@extends('layouts.admin')

@section('title', 'Monitoring Playbox — BoxPlay.id')
@section('page_title', 'Monitoring Playbox')
@section('page_description', 'Status real-time mesin Playbox cabang Anda')
@section('breadcrumb', 'Monitoring Playbox')

@section('content')
    <div class="kpi-grid" style="grid-template-columns: repeat(3, 1fr);">
        <div class="kpi-card">
            <div class="kpi-icon green">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="6" width="20" height="12" rx="2"/><circle cx="8" cy="12" r="1.5"/><circle cx="16" cy="12" r="1.5"/></svg>
            </div>
            <div class="kpi-info">
                <h3>Total Unit</h3>
                <span class="kpi-value">{{ $playboxList->count() }}</span>
            </div>
        </div>
        <div class="kpi-card">
            <div class="kpi-icon blue">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
            </div>
            <div class="kpi-info">
                <h3>Tersedia</h3>
                <span class="kpi-value">{{ $playboxList->where('status_unit', 'Tersedia')->count() }}</span>
            </div>
        </div>
        <div class="kpi-card">
            <div class="kpi-icon amber">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"/><line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>
            </div>
            <div class="kpi-info">
                <h3>Maintenance / Rusak</h3>
                <span class="kpi-value">{{ $playboxList->whereIn('status_unit', ['Maintenance', 'Rusak'])->count() }}</span>
            </div>
        </div>
    </div>

    @if ($playboxList->count() > 0)
        <div class="table-card">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Playbox</th>
                        <th>Cabang</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($playboxList as $i => $playbox)
                        <tr>
                            <td>{{ $i + 1 }}</td>
                            <td class="td-bold">{{ $playbox->nama_playbox }}</td>
                            <td>{{ $playbox->cabang->nama_cabang ?? '—' }}</td>
                            <td>
                                @php
                                    $statusMap = [
                                        'Tersedia'    => 'badge-green',
                                        'Maintenance' => 'badge-amber',
                                        'Rusak'       => 'badge-red',
                                    ];
                                    $badgeClass = $statusMap[$playbox->status_unit] ?? 'badge-default';
                                @endphp
                                <span class="badge {{ $badgeClass }}">{{ $playbox->status_unit }}</span>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="empty-state">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="2" y="6" width="20" height="12" rx="2"/><circle cx="8" cy="12" r="1.5"/><circle cx="16" cy="12" r="1.5"/></svg>
            <h3>Tidak Ada Playbox</h3>
            <p>Belum ada unit Playbox di cabang Anda.</p>
        </div>
    @endif
@endsection
