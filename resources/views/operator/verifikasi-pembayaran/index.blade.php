@extends('layouts.admin')

@section('title', 'Verifikasi Pembayaran — BoxPlay.id')
@section('page_title', 'Verifikasi Pembayaran')
@section('page_description', 'Verifikasi pembayaran sesi fleksibel di cabang Anda')
@section('breadcrumb', 'Verifikasi Pembayaran')

@section('content')
    <div class="verification-table-card" id="paymentListContainer">
        @include('operator.verifikasi-pembayaran.table')
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

    // Polling Logic
    let lastCount = {{ $transaksiList->count() }};
    let lastId = {{ $transaksiList->first() ? $transaksiList->first()->id_transaksi : 'null' }};

    function checkPaymentChanges() {
        if (document.hidden) return;
        
        fetch('{{ route("operator.verifikasi-pembayaran.check") }}')
            .then(response => response.json())
            .then(data => {
                if (data.count !== lastCount || data.latest_id !== lastId) {
                    lastCount = data.count;
                    lastId = data.latest_id;
                    loadPayments();
                }
            })
            .catch(error => {
                // Silently ignore network errors to not interrupt the user
            });
    }

    function loadPayments() {
        fetch('{{ route("operator.verifikasi-pembayaran.table") }}')
            .then(response => response.text())
            .then(html => {
                document.getElementById('paymentListContainer').innerHTML = html;
            })
            .catch(error => {
                // Silently ignore
            });
    }

    // Interval checking every 10 seconds
    setInterval(checkPaymentChanges, 10000);

    // Immediate check when tab becomes visible
    document.addEventListener('visibilitychange', () => {
        if (!document.hidden) {
            checkPaymentChanges();
        }
    });
</script>
@endpush