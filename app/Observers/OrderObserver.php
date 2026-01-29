<?php

namespace App\Observers;

use App\Mail\OrderPayment;
use App\Models\Order;
use Illuminate\Contracts\Events\ShouldHandleEventsAfterCommit;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Mockery\Exception;

class OrderObserver implements ShouldHandleEventsAfterCommit
{

    public function creating(Order $order)
    {
        Log::info('Order creating', [$order]);
    }

    /**
     * Handle the Order "created" event.
     */
    public function created(Order $order): void
    {
        //
//        Log::alert("Order created");
        $this->sendPaymentEmail($order);
    }

    public function sendPaymentEmail(Order $order): void
    {
        Log::alert('order payment email', [$order]);

        try {
            Log::alert($order->getUser());

            $userEmail = $order->getUser()->email;
            Log::alert('user email', [$userEmail]);
            Mail::to($userEmail)->send(new OrderPayment($order));
            Log::info('success', [$userEmail]);

        } catch (Exception $e) {
            Log::error('error', [$e]);
            dd($e->getMessage());
        }
    }

    /**
     * Handle the Order "updated" event.
     */
    public function updated(Order $order): void
    {
        //
    }

    /**
     * Handle the Order "deleted" event.
     */
    public function deleted(Order $order): void
    {
        //
    }

    /**
     * Handle the Order "restored" event.
     */
    public function restored(Order $order): void
    {
        //
    }

    /**
     * Handle the Order "force deleted" event.
     */
    public function forceDeleted(Order $order): void
    {
        //
    }
}
