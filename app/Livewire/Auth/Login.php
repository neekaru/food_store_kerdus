<?php

namespace App\Livewire\Auth;

use Livewire\Component;

class Login extends Component
{
    public $email;
    public $password;

    protected function rules()
    {
        return [
            'email' => ['required', 'email'],
            'password' => ['required'],
        ];
    }

    public function login()
    {
        // for validation
        $this->validate();

        if (auth()->guard('customer')->attempt([
            'email' => $this->email,
            'password' => $this->password,
        ])) {
            session()->flash('success', 'Login Berhasil');

            return $this->redirect('/account/my-orders', navigate: true);
        }

        session()->flash('error', 'Periksa Email dan Password Anda.');

        return $this->redirect('/login', navigate: true);
    }

    public function render()
    {
        return view('livewire.auth.login');
    }
}
