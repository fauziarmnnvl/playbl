<?php

namespace App\Services;

use App\Models\EventPromo;

class PromoCalculationService
{
    /**
     * Menghitung nilai potongan dan total harga setelah promo.
     * 
     * @param float $hargaDasar Harga transaksi sebelum dipotong promo
     * @param EventPromo $promo Objek promo yang diterapkan
     * @return array [ 'nilai_potongan' => float, 'total_harga' => float ]
     */
    public function calculate(float $hargaDasar, EventPromo $promo): array
    {
        $nilaiPotongan = 0;

        if ($promo->tipe_diskon === 'Nominal') {
            $nilaiPotongan = min($promo->nilai_diskon, $hargaDasar);
        } elseif ($promo->tipe_diskon === 'Persentase') {
            $nilaiPotongan = ($hargaDasar * $promo->nilai_diskon) / 100;
            // Pastikan potongan persentase tidak melebihi harga dasar
            $nilaiPotongan = min($nilaiPotongan, $hargaDasar);
        }

        // Pembulatan nilai potongan (misal ke 2 desimal atau bulat tanpa desimal, 
        // tapi dalam IDR biasanya dibulatkan penuh)
        $nilaiPotongan = round($nilaiPotongan);

        // Harga akhir tidak boleh negatif
        $totalHarga = max(0, $hargaDasar - $nilaiPotongan);

        return [
            'nilai_potongan' => (float) $nilaiPotongan,
            'total_harga' => (float) $totalHarga,
        ];
    }
}
