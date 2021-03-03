<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FonepayController extends Controller
{
	public function fonepay_return(Request $request){

    	// dump($request);

		if(isset($request->PRN) && isset($request->PID) && isset($request->AMT) && isset($request->UID)){
			$order=Order::where('invoice_no',$request_>PRN)->FIRST();
			$data='NBQM'.',';
			$data.=$order->total.',';
			$data.=$order->invoice_no.',';
			$data.=$request->BID.',';
			$data.=$request->UID.',';

			$DV=hash_mac('sha512',$data,'a7e3512f5032480a83137793cb2021bc');

			$PRN=$request['PRN'];
			$PID=$request['PID'];
			$BID=$request['BID'];
			$AMT=$order->total;
			$RU=$request['RU'];
			$UID=$request['UID'];


			$queryString "PRN=SPRN&PID=SPID&BID=SBID&AMTESAMT&RU=SRUSUID=SUID&DV=5DV";
			$url ='https://dev-clientapi.fonepay.com/api/merchantRequest/verificationMerchant?'.$queryString:

			$ch=curl_init();

			curl_setopt ($ch, CURLOPT_URL, $url);

			curl_setopt($ch, CURLOPT_CUSTOMREQUEST. "GET");


			curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true); 
			$content= curl_exec($ch);

			Sresponse=simplexml_load_string($content);

//dd(Sresponse);



			if( $response->success=='true'){

				if($response->response_code =='successful' && $response->statusCode==0){

					$order->status = 1;

					$order->save();

					return redirect()->route('payment.response')->with('success_message', 'Transaction Completed'); 
						}
					}

					}

				}
				return redirect()->route('payment.response')->with('error_message', 'Transaction not Completed'); 
			}
