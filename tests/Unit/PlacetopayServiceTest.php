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
     * @throws \Dnetix\Redirection\Exceptions\PlacetoPayException
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
     * @throws \Dnetix\Redirection\Exceptions\PlacetoPayException
     * @test
     */
    public function it_should_payment_request_with_success()
    {
        $sessionPayment = $this->placetopay->payment(1);
        $this->assertTrue($sessionPayment->isSuccessful());
        $this->assertNotEmpty($sessionPayment->requestId());
    }

    /**
     * Unit test: service response with invalid id on request information
     *
     * @return void
     * @test
     */
    public function it_should_check_status_pay_with_invalid_id()
    {
        $response = $this->placetopay->payInfo("121765");
        $this->assertFalse($response->isSuccessful());
        $this->assertFalse($response->status()->isApproved());
    }

    /**
     * Unit test: service response with valid id on request information
     *
     * @return void
     * @throws \Dnetix\Redirection\Exceptions\PlacetoPayException
     * @test
     */
    public function it_should_check_status_pay()
    {
        $sessionPayment = $this->placetopay->payment(1);
        $response = $this->placetopay->payInfo($sessionPayment->requestId());
        $this->assertTrue($response->isSuccessful());
        $this->assertNotEmpty($response->status());
    }

}
