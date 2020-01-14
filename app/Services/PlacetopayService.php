<?php


namespace App\Services;

use Dnetix\Redirection\Exceptions\PlacetoPayException as PlacetoPayException;
use Dnetix\Redirection\Message\RedirectInformation as RedirectInformation;
use Dnetix\Redirection\Message\RedirectResponse as RedirectResponse;
use Dnetix\Redirection\PlacetoPay;

class PlacetopayService
{

    private $placetopay;

    public function __construct()
    {
        $this->placetopay = $this->auth();
    }

    /**
     * Auth service with credentials and config
     * @return PlacetoPay
     * @throws PlacetoPayException
     */
    public function auth() : PlacetoPay
    {
        $config = [
            'login' => env('PLACETOPAY_LOGIN'),
            'tranKey' => env('PLACETOPAY_TRANKEY'),
            'url' => env('PLACETOPAY_HOST'),
            'type' => env('PLACETOPAY_TP')
        ];
        return new PlacetoPay($config);
    }

    /**
     * Create payment request with body data
     * @param $orderId
     * @return RedirectResponse
     * @throws PlacetoPayException
     */
    public function payment($orderId)
    {
        $request = [
            'payment' =>  [
                'reference' => $orderId,
                'description' => 'Bestseller eBook Payment',
                'amount' => [
                    'currency' => 'COP',
                    'total' => 80000,
                ],
            ],
            'expiration' => date('c', strtotime('+2 days')),
            'returnUrl' => env('APP_URL').'/order/'.$orderId,
            'ipAddress' => '127.0.0.1',
            'userAgent' => 'Mozilla/5.0 (X11; Linux x86_64)',
        ];
        return $this->placetopay->request($request);
    }

    /**
     * Get information payment
     * @param $paymentId
     * @return RedirectInformation
     */
    public function payInfo($paymentId){
        return $this->placetopay->query($paymentId);
    }
}
