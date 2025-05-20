<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use App\Models\Customer;


class Register extends Component
{
    public $name;
    public $email;
    public $password;
    public $password_confirmation;

    public function rules()
    {
        return [
            'name' => ['required'],
            'email' => ['required', 'email', 'unique:customers,email'],
            'password' => ['required', 'confirmed'],
        ];
    }

    public function register()
    {
        // for validation
        $this->validate();

        // Create Customer
        Customer::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => bcrypt($this->password),
        ]);

        session()->flash('success', 'Register Berhasil, silahkan login');

        return $this->redirect('/login', navigate: true);
    }

    public function mount()
    {
        if(auth()->guard('customer')->check()) {
            return $this->redirect('/account/my-orders', navigate: true);
        }
    }

    public function render()
    {
        return view('livewire.auth.register');
    }
}
