<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use App\Order;
use App\Services\PlacetopayService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{

    private $placetopay;

    /**
     * OrderController constructor.
     * @param PlacetopayService $placetopay
     */
    public function __construct(PlacetopayService $placetopay)
    {
        $this->placetopay = $placetopay;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $orders = Order::orderBy('created_at', 'desc')->get();
        return view('order.index', compact('orders'));
    }

    /**
     * Show the payment summary.
     *
     * @param Order $order
     * @return \Illuminate\View\View
     */
    public function summary(Order $order)
    {
        return view('order.checkout', compact('order'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param OrderRequest $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Dnetix\Redirection\Exceptions\PlacetoPayException
     */
    public function store(OrderRequest $request)
    {
        DB::beginTransaction();
        try {
            $order = Order::create($request->validated());
            $this->actionPayment($order);
            DB::commit();
            return redirect(route('order.summary', ['order' => $order->id]));
        }catch (\Exception $e){
            DB::rollback();
            return redirect(route('order.new'))->withErrors(['message' => 'Oops, try later!']);
        }
    }

    /**
     * Display the status order.
     *
     * @param Order $order
     * @return \Illuminate\View\View
     * @throws \Dnetix\Redirection\Exceptions\PlacetoPayException
     */
    public function show(Order $order)
    {
        $response = $this->placetopay->payInfo($order->pay_id);
        if ($response->isSuccessful()){
            if ($response->status()->isApproved()){
                $order->status = Order::STATUS_PAYED;
            }else if($response->status()->status() != 'PENDING'){
                $order->status = Order::STATUS_REJECTED;
                $this->actionPayment($order);
            }
            $order->save();
        }
        return view('order.status', compact('order'));
    }

    /**
     *  Helper method: make payment request with Placetopay service
     *  and save response data on Order Model.
     * @param $order
     * @throws \Dnetix\Redirection\Exceptions\PlacetoPayException
     */
    private function actionPayment($order){
        $response = $this->placetopay->payment($order->id);
        if(!$response->isSuccessful()) abort(400);
        $order->update([
            'pay_id' => $response->requestId(),
            'pay_process_url' => $response->processUrl()
        ]);
    }

}
