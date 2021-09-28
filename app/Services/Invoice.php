<?php

namespace App\Services;

use App\Models\Payment;
use App\Models\Plan;
use App\Models\User;
use Dompdf\Dompdf;

class Invoice
{
    public function __construct(
        public Payment $payment,
    ) 
    {
        $this->make();
    }

    public function make()
    {
        $dompdf = new Dompdf();
        $html = $this->getHtml();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4');
        $dompdf->render();
        $dompdf->stream();
    }

    private function getHtml() 
    {
        
        $user = $this->payment->user;
        $userSubscription = $user->subscription('default') ?? NULL;
        $currentPlan = '';

        if (!is_null($userSubscription)) {
            $currentPlan = Plan::where('stripe_price_id', $userSubscription->stripe_price)->first() ?? NULL;
        }

        $productHtml = "
            <tr>
                <td style='padding: 20px 20px; background-color:#F6F6F6; border-bottom: 1px solid #C2C4C7;'>" . $currentPlan->name . "<div style='color:#838383'>Jan 16 - Feb 16, 2020</span></td>
                <td style='padding: 20px 20px; background-color:#F6F6F6; border-bottom: 1px solid #C2C4C7;'>1</td>
                <td style='padding: 20px 20px; background-color:#F6F6F6; border-bottom: 1px solid #C2C4C7;'>$5.00</td>
                <td style='padding: 20px 20px; background-color:#F6F6F6; border-bottom: 1px solid #C2C4C7;'>$5.00</td>
             </tr>
        ";

        $html = "
            <div style='font-family:\"Courier New\", Courier, monospace;'>
                <div style='margin-bottom:20px; padding-bottom:20px; display:flex; justify-content:space-between;'>
                    <div style='font-size: 36px;'>Company Name</div>
            
                    <div>
                        <div style='font-size: 24px; text-align:right; margin-bottom:20px'>INVOICE</div>
                        <div style='text-align:right;'>Invoice number: 12341234</div>
                    </div>
                </div>
            
                <div>
                    <div>Bill to</div>
                    <div>$user->email</div>
                </div>
            
                <div style='font-size: 24px; padding:40px 0;'>
                    " . $this->payment->amount . " due Jan 15, 2021
                </div>
            
                <table style='width: 100%; padding:8px 0; text-align: left; border-collapse: collapse;'>
                    <thead style='padding: 20px'>
                        <tr>
                            <th style='text-align: left; padding: 20px 20px; border-bottom: 2px solid #C2C4C7;'>Description</th>
                            <th style='text-align: left; padding: 20px 20px; border-bottom: 2px solid #C2C4C7;'>Qty</th>
                            <th style='text-align: left; padding: 20px 20px; border-bottom: 2px solid #C2C4C7;'>Unit price</th>
                            <th style='text-align: left; padding: 20px 20px; border-bottom: 2px solid #C2C4C7;'>Amount</th>
                        </tr>
                    </thead>
            
                    <tbody>
                        $productHtml
                        <tr>
                            <td></td>
                            <td></td>
                            <td style='padding: 20px 20px; border-bottom: 1px solid #C2C4C7;'>Subtotal</td>
                            <td style='padding: 20px 20px; border-bottom: 1px solid #C2C4C7;'>" . $this->payment->amount . "</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td style='padding: 20px 20px; background-color:#F6F6F6; border-bottom: 1px solid #C2C4C7;'><strong>Amount due</strong></td>
                            <td style='padding: 20px 20px; background-color:#F6F6F6; border-bottom: 1px solid #C2C4C7;'><strong>" . $this->payment->amount . "</strong></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        ";

        return $html;
    }
}