<?php

namespace App\Http\Controllers;

use App\Models\Cabang;
use App\Models\Playbox;
use App\Models\Pelanggan;
use App\Models\Transaksi;
use App\Models\SesiBermain;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function info()
    {
        return view('bookings.info');
    }

    public function storeInfo(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:100',
            'no_hp' => [
                'required',
                'regex:/^08[0-9]{8,13}$/'
            ],
        ], [
            'nama.required' => 'Nama lengkap wajib diisi.',
            'no_hp.required' => 'Nomor WhatsApp wajib diisi.',
            'no_hp.regex' => 'Format nomor WhatsApp tidak valid.',
        ]);

        session([
            'booking' => [
                'nama' => $request->nama,
                'no_hp' => $request->no_hp,
            ]
        ]);

        return redirect()->route('booking.cabang');
    }

    // cabang
    public function cabang()
    {
        $cabangs = Cabang::all();
        return view('bookings.cabang', compact('cabangs'));
    }
    public function storeCabang(Request $request)
    {
        $request->validate([
            'branch'=>'required|exists:cabang,id_cabang'
        ]);

        $cabang=Cabang::where('id_cabang',$request->branch)
            ->where('status_buka',true)
            ->first();

        if(!$cabang)
            return back()->withErrors([
                'branch'=>'Cabang tidak tersedia.'
            ]);

        $booking = session('booking', []);
        $booking['id_cabang'] = $request->branch;
        session([
            'booking' => $booking,
        ]);

        return redirect()->route('booking.playbox');
    }

    // playbox
    public function playbox()
    {
        $booking = session('booking');

        // Pastikan user sudah mengisi informasi pemain
        if (!$booking || !isset($booking['nama']) || !isset($booking['no_hp'])) {
            return redirect()->route('booking.info');
        }

        // Pastikan user sudah memilih cabang
        if (!isset($booking['id_cabang'])) {
            return redirect()->route('booking.cabang');
        }

        $playboxes = Playbox::where('id_cabang', $booking['id_cabang'])
            ->orderBy('nama_playbox')
            ->get();

        return view('bookings.playbox', compact('playboxes'));
    }

    public function storePlaybox(Request $request)
    {
        $request->validate(['playbox' => 'required',]);

        $booking = session('booking', []);
        $playbox = Playbox::where('id_playbox', $request->playbox)
            ->where('id_cabang', $booking['id_cabang'])
            ->where('status_unit', 'Tersedia')
            ->first();
        if (!$playbox) {
            return back()->withErrors([
                'playbox' => 'Playbox tidak tersedia.'
            ]);
        }

        $booking['id_playbox'] = $playbox->id_playbox;
        session(['booking' => $booking,]);

        return redirect()->route('booking.durasi');
    }

    public function durasi()
    {
        $booking=session('booking');

        if(!$booking||!isset($booking['id_playbox']))
            return redirect()->route('booking.playbox');

        return view('bookings.durasi');
    }

    public function storeDurasi(Request $request)
    {
        $request->validate([
            'jenis_sesi'=>'required|in:tetap,fleksibel',
            'durasi'=>'required_if:jenis_sesi,tetap|nullable|in:60,120,180,240'
        ]);

        $booking=session('booking',[]);

        $booking['jenis_sesi']=$request->jenis_sesi;
        $booking['durasi']=$request->durasi;

        if($booking['jenis_sesi']=='tetap'){
            $booking['total_harga']=$booking['durasi']/60*15000;
            session(['booking'=>$booking]);
            return redirect()->route('booking.review');
        }

        $booking['total_harga']=null;
        session(['booking'=>$booking]);

        return redirect()->route('booking.review.flexible');
    }

    public function review()
    {
        $booking=session('booking');

        if(!$booking||!isset($booking['durasi']))
            return redirect()->route('booking.durasi');

        $booking['cabang']=Cabang::find($booking['id_cabang']);
        $booking['playbox']=Playbox::find($booking['id_playbox']);

        return view('bookings.review',compact('booking'));
    }

    public function reviewFlexible()
    {
        $booking=session('booking');

        if(!$booking||$booking['jenis_sesi']!='fleksibel')
            return redirect()->route('booking.durasi');

        $booking['cabang']=Cabang::find($booking['id_cabang']);
        $booking['playbox']=Playbox::find($booking['id_playbox']);

        return view('bookings.review-flexible',compact('booking'));
    }

    public function successFlexibleBooking()
    {
        $booking = session('booking');

        if (!$booking || !isset($booking['id_transaksi']) || $booking['jenis_sesi'] != 'fleksibel') {
            return redirect()->route('booking.review.flexible');
        }

        $booking['cabang'] = Cabang::find($booking['id_cabang']);
        $booking['playbox'] = Playbox::find($booking['id_playbox']);

        return view('bookings.success-flexible-booking', compact('booking'));
    }

    public function storeBookingFlexible()
    {
        $booking = session('booking');

        if (!$booking || $booking['jenis_sesi'] != 'fleksibel') {
            return redirect()->route('booking.info');
        }

        DB::transaction(function () use (&$booking) {
            $pelanggan = Pelanggan::firstOrCreate(
                ['no_hp' => $booking['no_hp']],
                [
                    'nama_pelanggan' => $booking['nama'],
                    'waktu_daftar' => now()
                ]
            );

            $pelanggan->update([
                'nama_pelanggan' => $booking['nama']
            ]);

            $transaksi = Transaksi::create([
                'kode_transaksi' => Transaksi::generateKodeTransaksi(),
                'id_pelanggan' => $pelanggan->id_pelanggan,
                'id_cabang' => $booking['id_cabang'],
                'id_playbox' => $booking['id_playbox'],
                'id_promo' => null,
                'durasi' => 0,
                'total_harga' => 0,
                'jenis_sesi' => 'Fleksibel',
                'tgl_transaksi' => now(),
            ]);

            SesiBermain::create([
                'id_transaksi' => $transaksi->id_transaksi,
                'waktu_mulai' => null,
                'waktu_selesai' => null,
                'sisa_waktu' => 0,
                'status_sesi' => 'Belum Mulai'
            ]);

            $booking['id_transaksi'] = $transaksi->id_transaksi;
            $booking['kode_transaksi'] = $transaksi->kode_transaksi;

            session(['booking' => $booking]);
        });
        return redirect()->route('booking.success.flexible.booking');
    }

    public function mulaiSesi()
    {
        $booking = session('booking');

        if ( !$booking || !isset($booking['id_transaksi']) || $booking['jenis_sesi'] != 'fleksibel') {
            return redirect()->route('booking.info');
        }

        DB::transaction(function () use ($booking) {

            $sesi = SesiBermain::where('id_transaksi', $booking['id_transaksi'])
                ->first();

            if (!$sesi)
                abort(404);

            $sesi->update([
                'waktu_mulai' => now(),
                'status_sesi' => 'Berjalan'
            ]);

            Playbox::where('id_playbox', $booking['id_playbox'])
                ->update([
                    'status_unit' => 'Digunakan'
                ]);
        });

        return redirect()->route('booking.session.flexible');
    }

    public function selesaiSesi()
    {
        $booking = session('booking');

        if ( !$booking || !isset($booking['id_transaksi']) || $booking['jenis_sesi'] != 'fleksibel' ) {
            return redirect()->route('booking.info');
        }

        $sesi = SesiBermain::where('id_transaksi', $booking['id_transaksi'])->firstOrFail();
        if (!$sesi->waktu_mulai) {
            return redirect()->route('booking.session.flexible');
        }
        DB::transaction(function () use (&$booking, $sesi) {

            
            $waktuSelesai = now();

            $durasiMenit = floor(
                $sesi->waktu_mulai->diffInSeconds($waktuSelesai) / 60
            );

            $tarifPerMenit = 395;
            $totalHarga = $durasiMenit * $tarifPerMenit;

            $sesi->update([
                'waktu_selesai' => $waktuSelesai,
                'sisa_waktu' => $durasiMenit,
                'status_sesi' => 'Selesai'
            ]);

            Transaksi::where(
                'id_transaksi',
                $booking['id_transaksi']
            )->update([
                'durasi' => $durasiMenit,
                'total_harga' => $totalHarga
            ]);

            Playbox::where(
                'id_playbox',
                $booking['id_playbox']
            )->update([
                'status_unit' => 'Tersedia'
            ]);

            $booking['durasi'] = $durasiMenit;
            $booking['total_harga'] = $totalHarga;

            session([
                'booking' => $booking
            ]);
        });

        return redirect()->route('booking.pembayaran.flexible');
    }

    public function pembayaranFlexible()
    {
        $booking = session('booking');

        if (!$booking) {
            return redirect()->route('booking.info');
        }

        $booking['cabang'] = Cabang::find($booking['id_cabang']);
        $booking['playbox'] = Playbox::find($booking['id_playbox']);

        return view('bookings.pembayaran-flexible', compact('booking'));
    }

    public function storePembayaranFlexible()
    {
        $booking = session('booking');

        if (!$booking || !isset($booking['id_transaksi']) || $booking['jenis_sesi'] != 'fleksibel') {
            return redirect()->route('booking.info');
        }

        return redirect()->route('booking.success.flexible');
    }

    public function successFlexible()
    {
        $booking = session('booking');

        if (!$booking || !isset($booking['id_transaksi']) || $booking['jenis_sesi'] != 'fleksibel') {
            return redirect()->route('booking.info');
        }

        $booking['cabang'] = Cabang::find($booking['id_cabang']);
        $booking['playbox'] = Playbox::find($booking['id_playbox']);

        return view('bookings.success-flexible', compact('booking'));
    }

    public function sessionFlexible()
    {
        $booking = session('booking');

        if (
            !$booking ||
            !isset($booking['id_transaksi']) ||
            $booking['jenis_sesi'] != 'fleksibel'
        ) {
            return redirect()->route('booking.info');
        }

        $booking['playbox'] = Playbox::find($booking['id_playbox']);

        $booking['sesi'] = SesiBermain::where(
            'id_transaksi',
            $booking['id_transaksi']
        )->first();

        return view('bookings.session-flexible', compact('booking'));
    }

    public function pembayaran()
    {
        $booking=session('booking');

        if(!$booking||!isset($booking['total_harga']))
            return redirect()->route('booking.review');

        $booking['cabang']=Cabang::find($booking['id_cabang']);
        $booking['playbox']=Playbox::find($booking['id_playbox']);

        return view('bookings.pembayaran',compact('booking'));
    }

    public function storePembayaran()
    {
        $booking=session('booking');

        if(!$booking)
            return redirect()->route('booking.info');

        DB::transaction(function() use(&$booking){

            $pelanggan=Pelanggan::firstOrCreate(
                ['no_hp'=>$booking['no_hp']],
                [
                    'nama_pelanggan'=>$booking['nama'],
                    'waktu_daftar'=>now()
                ]
            );

            $pelanggan->update([
                'nama_pelanggan'=>$booking['nama']
            ]);

            $transaksi=Transaksi::create([
                'kode_transaksi'=>Transaksi::generateKodeTransaksi(),
                'id_pelanggan'=>$pelanggan->id_pelanggan,
                'id_cabang'=>$booking['id_cabang'],
                'id_playbox'=>$booking['id_playbox'],
                'id_promo'=>null,
                'durasi'=>$booking['durasi'],
                'total_harga'=>$booking['total_harga'],
                'jenis_sesi'=>$booking['jenis_sesi']=='tetap'
                    ? 'Tetap'
                    : 'Fleksibel',
                'tgl_transaksi'=>now()
            ]);

            SesiBermain::create([
                'id_transaksi'=>$transaksi->id_transaksi,
                'waktu_mulai'=>null,
                'waktu_selesai'=>null,
                'sisa_waktu'=>$booking['durasi'],
                'status_sesi'=>'Belum Mulai'
            ]);

            Playbox::where('id_playbox',$booking['id_playbox'])->update(['status_unit' => 'Dipesan']);

            $booking['id_transaksi']=$transaksi->id_transaksi;
            $booking['kode_transaksi']=$transaksi->kode_transaksi;

            session(['booking'=>$booking]);
        });

        return redirect()->route('booking.success');
    }

    public function success()
    {
        $booking=session('booking');

        if(!$booking||!isset($booking['id_transaksi']))
            return redirect()->route('booking.info');

        $booking['cabang']=Cabang::find($booking['id_cabang']);
        $booking['playbox']=Playbox::find($booking['id_playbox']);

        return view('bookings.success',compact('booking'));
    }

    public function selesai()
    {
        session()->forget('booking');

        return redirect()->route('home');
    }
}