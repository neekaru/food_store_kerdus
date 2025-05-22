<?php

namespace App\Livewire\Web\Checkout;

use Livewire\Component;
use App\Models\Province;

class Index extends Component
{
    public $address;
    public $province_id;
    public $city_id;


    public function render()
    {
        //get provinces
        $provinces = Province::query()->get();

        return view('livewire.web.checkout.index', compact('provinces'));
    }
}