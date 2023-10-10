<?php
namespace App\Repository\Shopping;


use App\Interfaces\Shopping\ShoppingInterface;
use App\Models\Invoice;
use App\Models\Product;
use App\Models\Shipment;
use App\Models\User_Address;


class ShoppingRepository implements ShoppingInterface
{

    public function user_start ($request)
    {
        //get address
        $address = User_Address::find($request->address_id);
        if ($address->user_id !== auth()->id()){
            return response_auth_error();
        }
        //get shipment
        $shipping = Shipment::find($request->shipping_id);

        //Start make invoice
        \DB::beginTransaction();
        $invoice = Invoice::create([
            'user_id' => auth('users')->id(),
            'shipment_id' => $shipping->id,
            'method' => 'online',
            'address' => $address->address,
            'postal_code' => $address->postal_code,

        ]);
        //get price
        $price = 0;
        foreach ($request->cart as $cart){
            if ($cart['product']){
                $product = Product::find($cart['product']['id']);
                if ($product){
                    if ($product->sale){
                        $product_price = $product->sale;
                    }else{
                        $product_price = $product->price;
                    }
                    if ($cart['quantity'] && $cart['quantity'] > 1){
                        $product_price *= $cart['quantity'];
                    }
                    $invoice->orders()->create([
                        'user_id' => auth('users')->id(),
                        'product_id' => $product->id,
                        'price' => $product_price,
                        'quantity' => $cart['quantity'],
                        'product_title' => $product->name,
                    ]);
                    $price += $product_price;
                }
            }
        }
        $invoice->update(['price' => $price , 'code' => core_random_code($invoice->id,12)]);
        \DB::commit();
        return $invoice;
    }
}
