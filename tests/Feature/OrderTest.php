<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Order;

class OrderTest extends TestCase
{
    use RefreshDatabase;

    /**
     * feature test: user can view new-order page with successful.
     *
     * @test
     * @return void
     */
    public function it_should_see_new_order_page()
    {
        $response = $this->get(route('order.new'));
        $response->assertOk();
    }

    /**
     * feature test: user can view order-summary page with successful.
     *
     * @test
     * @return void
     */
    public function it_should_see_order_summary_page()
    {
        $order = factory(Order::class)->create();
        $response = $this->get(route('order.summary', ['order' => $order->id]));
        $response->assertOk();
        $response->assertSee($order->customer_name);
    }

    /**
     * feature test: user can view create page with successful.
     *
     * @test
     * @return void
     */
    public function it_should_create_an_order()
    {
        $order = factory(Order::class)->make();
        $expectedOrderId = 1;
        $response = $this->post(route('order.store'),$order->toArray());
        $response->assertStatus(302);
        $this->assertDatabaseHas('orders',['id' => $expectedOrderId]);
        $response->assertRedirect(route('order.summary',['order' => $expectedOrderId]));
    }

    /**
     * feature test: user found an order.
     *
     * @test
     * @return void
     */
    public function it_should_see_status_of_an_order()
    {
        $order = factory(Order::class)->create();
        $response = $this->get(route('order.show', ['order' => $order->id]));
        $response->assertOk();
        $response->assertSee($order->status);
        $response->assertSee($order->pay_process_url);
    }

    /**
     * feature test: user found an order.
     *
     * @test
     * @return void
     */
    public function it_should_see_status_payed_of_an_order()
    {
        $order = factory(Order::class)->create();
        $order->update(['status' => 'PAYED']);
        $response = $this->get(route('order.show', ['order' => $order->id]));
        $response->assertOk();
        $response->assertSee($order->status);
        $response->assertDontSee($order->pay_process_url);
    }

    /**
     * feature test: use not found an order
     *
     * @test
     * @return void
     */
    public function it_should_not_found_an_order()
    {
        $response = $this->get(route('order.show',['order' => '1111']));
        $response->assertNotFound();
    }
}
