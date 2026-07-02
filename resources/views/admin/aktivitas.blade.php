@extends('layouts.admin')

@section('title', 'Riwayat Aktivitas — BoxPlay.id')
@section('page_title', 'Riwayat Aktivitas')
@section('page_description', 'Audit Trail Sistem')
@section('breadcrumb', 'Pengaturan / Riwayat Aktivitas')

@section('content')
  
    {{-- FILTER BAR --}}
    <div class="table-card" style="margin-bottom: 24px; padding: 20px;">
        <form method="GET" action="{{ route('admin.aktivitas') }}" id="filterForm">
            <div style="display: flex; gap: 16px; flex-wrap: wrap; align-items: flex-end;">
                
                {{-- Dropdown User --}}
                <div style="flex: 1; min-width: 200px;">
                    <label style="display: block; margin-bottom: 8px; font-weight: 500; font-size: 0.875rem; color: #475569;">User</label>
                    <select name="user_filter" onchange="document.getElementById('filterForm').submit()" style="width: 100%; height: 42px; border: 1px solid #e2e8f0; border-radius: 8px; padding: 0 12px; outline: none; background: #fff; font-family: inherit;">
                        <option value="semua" {{ request('user_filter') === 'semua' ? 'selected' : '' }}>Semua User</option>
                        @foreach ($userList as $user)
                            <option value="{{ $user->id }}" {{ request('user_filter') == $user->id ? 'selected' : '' }}>
                                {{ $user->nama }}
                            </option>
                        @endforeach
                        <option value="sistem" {{ request('user_filter') === 'sistem' ? 'selected' : '' }}>Sistem</option>
                    </select>
                </div>

                {{-- Input Search --}}
                <div style="flex: 2; min-width: 250px;">
                    <label style="display: block; margin-bottom: 8px; font-weight: 500; font-size: 0.875rem; color: #475569;">Pencarian</label>
                    <input type="text" name="search" placeholder="Cari aktivitas..." value="{{ request('search') }}" onkeyup="clearTimeout(window.activitySearch); window.activitySearch = setTimeout(() => { document.getElementById('filterForm').submit(); }, 500);" style="width: 100%; height: 42px; border: 1px solid #e2e8f0; border-radius: 8px; padding: 0 12px; outline: none; font-family: inherit;">
                </div>
            </div>
        </form>
    </div>

    {{-- TIMELINE --}}
    @if ($aktivitasList->count() > 0)
        <div class="table-card" style="padding: 24px;">
            <div class="activity-timeline">
                @foreach ($aktivitasList as $activity)
                    @php
                        $desc = strtolower($activity->description);
                        $bulletColor = '#64748B'; // Default Slate

                        if ($activity->causer_id === null) {
                            $bulletColor = '#9CA3AF'; // Gray for system
                        } elseif (str_contains($desc, 'create') || str_contains($desc, 'created') || str_contains($desc, 'tambah') || str_contains($desc, 'menambahkan')) {
                            $bulletColor = '#10B981'; // Green
                        } elseif (str_contains($desc, 'update') || str_contains($desc, 'updated') || str_contains($desc, 'ubah') || str_contains($desc, 'mengubah')) {
                            $bulletColor = '#3B82F6'; // Blue
                        } elseif (str_contains($desc, 'delete') || str_contains($desc, 'deleted') || str_contains($desc, 'hapus') || str_contains($desc, 'menghapus')) {
                            $bulletColor = '#EF4444'; // Red
                        }
                    @endphp

                    <div class="timeline-item">
                        <div class="timeline-indicator"
                            style="background-color: {{ $bulletColor }};">
                        </div>

                        <div class="timeline-content">
                            <div class="timeline-row">
                                <div class="timeline-main">
                                    <div class="timeline-description">
                                        {{ $activity->description }}
                                    </div>

                                    <div class="timeline-meta-simple">
                                        @if($activity->causer)
                                            {{ $activity->causer->nama }}
                                            •
                                            {{ ucfirst($activity->causer->role) }}
                                        @else
                                            Sistem
                                        @endif

                                    </div>
                                </div>

                                <div class="timeline-time">
                                    {{ $activity->created_at->diffForHumans() }}
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div style="padding-top: 20px; margin-top: 10px; border-top: 1px solid #e2e8f0;">
                {{ $aktivitasList->links() }}
            </div>
        </div>
    @else
        <div class="empty-state">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"></polyline></svg>
            <h3>Belum ada aktivitas tercatat</h3>
            <p>Aktivitas sistem akan muncul di sini setelah pengguna melakukan tindakan.</p>
        </div>
    @endif

@endsection
