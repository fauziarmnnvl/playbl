<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Services\PromoCalculationService;
use App\Models\EventPromo;

class PromoCalculationServiceTest extends TestCase
{
    protected PromoCalculationService $service;

    protected function setUp(): void
    {
        parent::setUp();
        $this->service = new PromoCalculationService();
    }

    public function test_calculate_nominal_discount()
    {
        $promo = new EventPromo();
        $promo->tipe_diskon = 'Nominal';
        $promo->nilai_diskon = 10000;

        $result = $this->service->calculate(50000, $promo);

        $this->assertEquals(10000, $result['nilai_potongan']);
        $this->assertEquals(40000, $result['total_harga']);
    }

    public function test_calculate_percentage_discount()
    {
        $promo = new EventPromo();
        $promo->tipe_diskon = 'Persentase';
        $promo->nilai_diskon = 20;

        $result = $this->service->calculate(50000, $promo);

        $this->assertEquals(10000, $result['nilai_potongan']);
        $this->assertEquals(40000, $result['total_harga']);
    }

    public function test_nominal_discount_exceeds_price()
    {
        $promo = new EventPromo();
        $promo->tipe_diskon = 'Nominal';
        $promo->nilai_diskon = 50000;

        $result = $this->service->calculate(30000, $promo);

        $this->assertEquals(30000, $result['nilai_potongan']);
        $this->assertEquals(0, $result['total_harga']);
    }

    public function test_percentage_discount_100_percent()
    {
        $promo = new EventPromo();
        $promo->tipe_diskon = 'Persentase';
        $promo->nilai_diskon = 100;

        $result = $this->service->calculate(50000, $promo);

        $this->assertEquals(50000, $result['nilai_potongan']);
        $this->assertEquals(0, $result['total_harga']);
    }

    public function test_percentage_discount_exceeds_100_percent_fallback()
    {
        $promo = new EventPromo();
        $promo->tipe_diskon = 'Persentase';
        $promo->nilai_diskon = 150; // Should fallback to max 100% implicitly

        $result = $this->service->calculate(50000, $promo);

        $this->assertEquals(50000, $result['nilai_potongan']);
        $this->assertEquals(0, $result['total_harga']);
    }
}
