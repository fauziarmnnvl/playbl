@extends('layouts.admin')

@section('title', 'Verifikasi Pembayaran — BoxPlay.id')
@section('page_title', 'Verifikasi Pembayaran')
@section('page_description', 'Verifikasi pembayaran sesi fleksibel di cabang Anda')
@section('breadcrumb', 'Verifikasi Pembayaran')

@section('content')
    <div class="verification-table-card">
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
    </div>
    <div id="paymentProofModal" class="payment-proof-modal">
        <div class="payment-proof-overlay" onclick="closePaymentProofModal()"></div>

        <div class="payment-proof-content">
            <div class="payment-proof-header">
                <div>
                    <h3>Bukti Pembayaran</h3>
                    <p id="paymentProofTransaction"></p>
                </div>

                <button type="button" class="payment-proof-close" onclick="closePaymentProofModal()">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round">
                        <path d="M18 6 6 18M6 6l12 12"/>
                    </svg>
                </button>
            </div>

            <div class="payment-proof-body">
                <img id="paymentProofImage" src="" alt="Bukti Pembayaran">
            </div>
        </div>
    </div>

    <div id="approvePaymentModal" class="payment-confirm-modal">
        <div class="payment-confirm-overlay" onclick="closeApproveModal()"></div>

        <div class="payment-confirm-content">
            <div class="payment-confirm-icon approve">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <path d="m5 12 4 4L19 6"/>
                </svg>
            </div>

            <h3>Setujui Pembayaran?</h3>
            <p>
                Pembayaran <strong id="approveTransactionCode"></strong> dari
                <strong id="approveCustomerName"></strong> akan disetujui.
            </p>

            <div class="payment-confirm-actions">
                <button type="button" class="btn-confirm-cancel" onclick="closeApproveModal()">
                    Batal
                </button>
                <button type="button" class="btn-confirm-approve" onclick="submitApprovePayment()">
                    Ya, Setujui
                </button>
            </div>
        </div>
    </div>

    <div id="rejectPaymentModal" class="payment-confirm-modal">
        <div class="payment-confirm-overlay" onclick="closeRejectModal()"></div>

        <div class="payment-confirm-content">
            <div class="payment-confirm-icon reject">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round">
                    <path d="M18 6 6 18M6 6l12 12"/>
                </svg>
            </div>

            <h3>Tolak Pembayaran?</h3>
            <p>
                Pembayaran <strong id="rejectTransactionCode"></strong> dari
                <strong id="rejectCustomerName"></strong> akan ditolak.
            </p>

            <div class="payment-confirm-actions">
                <button type="button" class="btn-confirm-cancel" onclick="closeRejectModal()">
                    Batal
                </button>
                <button type="button" class="btn-confirm-reject" onclick="submitRejectPayment()">
                    Ya, Tolak
                </button>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    function openPaymentProofModal(imageUrl, transactionCode){
        document.getElementById('paymentProofImage').src=imageUrl;
        document.getElementById('paymentProofTransaction').textContent=transactionCode;
        document.getElementById('paymentProofModal').classList.add('show');
        document.body.style.overflow='hidden';
    }

    function closePaymentProofModal(){
        document.getElementById('paymentProofModal').classList.remove('show');
        document.body.style.overflow='';
    }

    document.addEventListener('keydown', function(event){
        if(event.key==='Escape') closePaymentProofModal();
    });

    let approveFormId=null;
    function openApproveModal(formId, transactionCode, customerName){
        approveFormId=formId;
        document.getElementById('approveTransactionCode').textContent=transactionCode;
        document.getElementById('approveCustomerName').textContent=customerName;
        document.getElementById('approvePaymentModal').classList.add('show');
        document.body.style.overflow='hidden';
    }

    function closeApproveModal(){
        document.getElementById('approvePaymentModal').classList.remove('show');
        document.body.style.overflow='';
        approveFormId=null;
    }

    function submitApprovePayment(){
        if(approveFormId){
            document.getElementById(approveFormId).submit();
        }
    }

    let rejectFormId=null;
    function openRejectModal(formId, transactionCode, customerName){
        rejectFormId=formId;
        document.getElementById('rejectTransactionCode').textContent=transactionCode;
        document.getElementById('rejectCustomerName').textContent=customerName;
        document.getElementById('rejectPaymentModal').classList.add('show');
        document.body.style.overflow='hidden';
    }

    function closeRejectModal(){
        document.getElementById('rejectPaymentModal').classList.remove('show');
        document.body.style.overflow='';
        rejectFormId=null;
    }

    function submitRejectPayment(){
        if(rejectFormId){
            document.getElementById(rejectFormId).submit();
        }
    }
</script>
@endpush