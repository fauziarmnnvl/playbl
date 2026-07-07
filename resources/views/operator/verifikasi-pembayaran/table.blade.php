<div class="table-responsive">
    <table class="verification-table">
        <thead>
            <tr>
                <th>ID Transaksi</th>
                <th>Pelanggan</th>
                <th>Detail Sesi</th>
                <th>Total Biaya</th>
                <th>Bukti Bayar</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($transaksiList as $transaksi)
                <tr>
                    <td>{{ $transaksi->kode_transaksi }}</td>
                    <td>
                        <strong>{{ $transaksi->pelanggan->nama_pelanggan }}</strong>
                        <span>{{ $transaksi->waktu_pembayaran?->format('d M Y H:i') }}</span>
                    </td>
                    <td>
                        <strong>{{ $transaksi->playbox->nama_playbox }}</strong>
                        <span>Sesi Fleksibel</span>
                    </td>
                    <td>
                        <strong>Rp {{ number_format($transaksi->total_harga, 0, ',', '.') }}</strong>
                    </td>
                    <td>
                        <button type="button" class="btn-view-proof"
                            onclick="openPaymentProofModal('{{ Storage::url($transaksi->bukti_pembayaran) }}', '{{ $transaksi->kode_transaksi }}')">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M2 12s3.5-7 10-7 10 7 10 7-3.5 7-10 7S2 12 2 12Z"/>
                                <circle cx="12" cy="12" r="3"/>
                            </svg>
                            Lihat Bukti
                        </button>
                    </td>
                    <td>
                        <span class="payment-status pending">
                            <i class="bi bi-clock"></i>
                            Menunggu
                        </span>
                    </td>
                    <td>
                        <div class="verification-actions">
                            <form id="approveForm-{{ $transaksi->id_transaksi }}"
                                action="{{ route('operator.verifikasi-pembayaran.approve', $transaksi) }}"
                                method="POST">
                                @csrf
                                @method('PATCH')

                                <button type="button" class="btn-approve" title="Setujui"
                                    onclick="openApproveModal(
                                        'approveForm-{{ $transaksi->id_transaksi }}',
                                        '{{ $transaksi->kode_transaksi }}',
                                        '{{ $transaksi->pelanggan->nama_pelanggan }}'
                                    )">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="m5 12 4 4L19 6"/>
                                    </svg>
                                </button>
                            </form>

                            <form id="rejectForm-{{ $transaksi->id_transaksi }}"
                                action="{{ route('operator.verifikasi-pembayaran.reject', $transaksi) }}"
                                method="POST">
                                @csrf
                                @method('PATCH')

                                <button type="button" class="btn-reject" title="Tolak"
                                    onclick="openRejectModal(
                                        'rejectForm-{{ $transaksi->id_transaksi }}',
                                        '{{ $transaksi->kode_transaksi }}',
                                        '{{ $transaksi->pelanggan->nama_pelanggan }}'
                                    )">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round">
                                        <path d="M18 6 6 18M6 6l12 12"/>
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7">
                        <div class="empty-state">
                            <h3>Tidak Ada Pembayaran</h3>
                            <p>Belum ada pembayaran sesi fleksibel yang menunggu verifikasi.</p>
                        </div>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
