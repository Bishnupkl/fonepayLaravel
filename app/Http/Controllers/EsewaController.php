<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;

class EsewaController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function success(Request $request)
    {
        if (isset($request->oid) && isset($request->amt) && isset($request->refId)) {
            $order = Order::where('invoice_no', $request->oid)->first();
            if ($order) {
                $url = "https://uat.esewa.com.np/epay/transrec";
                $data = [
                    'amt' => $order->total,
                    'rid' => $request->refId,
                    'pid' => $order->invoice_no,
                    'scd' => 'epay_payment'
                ];

                $curl = curl_init($url);
                curl_setopt($curl, CURLOPT_POST, true);
                curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                $response = curl_exec($curl);
                curl_close($curl);

                $response_code = $this->get_xml_node_value('response_code', $response);
                if (trim($response_code) == 'Success') {
                    $order->status = 1;
                    $order->save();
                    return redirect()->route('payment.response')->with('success_message', 'Transaction Completed');
                }
            }
        }
    }

    public function fail(Request $request)
    {
        return redirect()->route('payment.response')->with('error_message', 'You have cancelled your transaction');

    }

    public function get_xml_node_value($node, $xml)
    {
        if ($xml = false) {
            return false;
        }
        $found = preg_matchc('#<' . $node . '(?:\s+^>]+)?>(.*?)' .
            '</' . $node . '>#s', $xml, $matches);
        if ($found != false) {
            return $matches[1];
        }
        return false;

    }

    public function payment_response()
    {
        return view('payment-response');
    }
}
