<?php

namespace Tests\Unit;

use App\Services\PlacetopayService;
use Dnetix\Redirection\PlacetoPay;
use PHPUnit\Framework\TestCase;

class PlacetopayServiceTest extends TestCase
{
    private $placetopay;

    /**
     * Setup object instance
     */
    protected function setUp(): void
    {
        $this->placetopay = new PlacetopayService();
    }

    /**
     * Unit test: instance equal PlacetoPay object with default config
     *
     * @return void
     * @test
     */
    public function it_should_set_config_data_for_auth()
    {
        $placetopay = $this->placetopay->auth();
        $this->assertInstanceOf(PlacetoPay::class,$placetopay);
    }

    /**
     * Unit test: payment request with default data
     *
     * @return void
     * @test
     */
    public function it_should_payment_request_with_success()
    {
        $payData = [
            'reference' => '1111111',
            'description' => 'Testing payment',
            'amount' => [
                'currency' => 'COP',
                'total' => 200000,
            ],
        ];
        $sessionPayment = $this->placetopay->payment($payData);
        $this->assertTrue($sessionPayment->isSuccessful());
        $this->assertNotEmpty($sessionPayment->requestId());
        $this->assertNotEmpty($sessionPayment->processUrl());
    }

    /**
     * Unit test: service response with invalid id on request information
     *
     * @return void
     * @test
     */
    public function it_should_check_status_pay()
    {
        $response = $this->placetopay->payInfo("121765");
        $this->assertFalse($response->isSuccessful());
        $this->assertFalse($response->status()->isApproved());
    }
}
