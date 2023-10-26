<?php
namespace App\Repository\Callback;


use App\Interfaces\Callback\CallbackInterface;
use App\Models\Invoice;
use App\Services\Payments\PaymentBitpayService;
use Carbon\Carbon;


class CallbackRepository implements CallbackInterface
{
    protected $bitpay;
    public function __construct()
    {
        $this->bitpay = new PaymentBitpayService();
    }

    public function bitpay($request)
    {
        if ($request->filled('trans_id') && $request->filled('id_get')){
            //Verify
            $verify = $this->bitpay->verify((int)$request->trans_id,$request->id_get);
            if ($verify){
                $verify = json_decode($verify, false, 512, JSON_THROW_ON_ERROR);
                \DB::beginTransaction();
                if (isset($verify->status) && $verify->status === 1){
                    //Find invoice
                    $invoice = Invoice::find($verify->factorId);
                    if ($invoice){
                        // Check duplicate ref id
                        if (Invoice::where('ref_id',$request->trans_id)->exists()){
                            return redirect(str_replace('/api','', url('')).'/checkout/payment-result/failed');
                        }
                        $invoice->update(['is_pay' => true,'paid_at' => Carbon::now(),'ref_id' => $request->trans_id,'gateway_id'=>$request->id_get]);
                        \DB::commit();
                        return redirect(str_replace('/api','', url('')).'/checkout/payment-result/success');
                    }

                    return redirect(str_replace('/api','', url('')).'/checkout/payment-result/failed');
                }

                return redirect(str_replace('/api','', url('')).'/checkout/payment-result/failed');
            }

        }


    }
}
