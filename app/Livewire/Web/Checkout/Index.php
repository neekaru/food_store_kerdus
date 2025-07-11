<?php

namespace App\Livewire\Web\Checkout;

use App\Models\Cart;
use Livewire\Component;
use App\Models\Province;
use Illuminate\Support\Facades\Http;

class Index extends Component
{
    public $address;
    public $province_id;
    public $city_id;

    public $loading = false;
    public $showCost = false;
    public $costs;

    public $selectCourier = '';
    public $selectService = '';
    public $selectCost = 0;

    public $grandTotal = 0;

    public function getCartsData()
    {
        $carts = Cart::query()
            ->with('product')
            ->where('customer_id', auth()->guard('customer')->user()->id)
            ->latest()
            ->get();

        $totalWeight = $carts->sum(function ($cart) {
            return $cart->product->weight * $cart->qty;
        });

        $totalPrice = $carts->sum(function ($cart) {
            return $cart->product->price * $cart->qty;
        });

        return [
            'totalWeight' => $totalWeight,
            'totalPrice' => $totalPrice,
        ];
    }

    public function changeCourier($value)
    {
        if(!empty($value)) {
            // Set Courier
            $this->selectCourier = $value;

            // Set loading
            $this->loading = true;

            // Set Show Cost False
            $this->showCost = false;

            $this->CheckOngkir();
        }
    }

    public function CheckOngkir()
    {
        try {
            // Ambil data cart
            $cartData = $this->getCartsData();

            // Fetch Rest Api
            $response = Http::withHeaders([
                'key' => config('rajaongkir.api_key'),
            ])->post('https://api.rajaongkir.com/starter/cost', [
                'origin'    => 113, // Kota Demak
                'destination' => $this->city_id,
                'weight' => $cartData['totalWeight'],
                'courier' => $this->selectCourier,
            ]);

            // Process costs (optional: store in a variable)
            $this->costs = $response['rajaongkir']['results'][0]['costs'];
        } catch (\Exception $e) {
            // Handle error (optional: set an error message)
            session()->flash('error', 'Gagal Mengambil ongkir.');
        } finally {
            // always update Loading dan cost visibility
            $this->loading = false;
            $this->showCost = true;
        }
    }

    public function getServiceAndCost($data)
    {
        // Pecah data menjadi nilai cost dan service
        [$cost, $service] = explode('|', $data);

        // Set nilai cost and service
        $this->selectCost = (int) $cost;
        $this->selectService = $service;

        // Ambil total harga dari cart
        $cartData = $this->getCartsData();

        $this->grandTotal = $cartData['totalPrice'] + $this->selectCost;
    }

    public function render()
    {
        //get provinces
        $provinces = Province::query()->get();
        
        // get Total cart Price
        $cartData = $this->getCartsData();
        $totalPrice = $cartData['totalPrice'];
        $totalWeight = $cartData['totalWeight'];

        return view('livewire.web.checkout.index', compact('provinces', 'totalPrice', 'totalWeight'));
    }
}