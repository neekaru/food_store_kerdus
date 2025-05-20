<?php

namespace App\Livewire\Web\Home;

use Livewire\Component;
use App\Models\Category;

class Index extends Component
{
    public function render()
    {
        return view('livewire.web.home.index', [
            'categories' => Category::latest()->get(),
        ]);
    }
}
