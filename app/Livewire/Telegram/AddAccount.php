<?php

namespace App\Livewire\Telegram;

use Illuminate\Support\Facades\Http;
use Livewire\Component;

class AddAccount extends Component
{

    public $step = 0;
    public $message;
    public $sessionName;
    public $phone;
    public $code;

    public function changeStep($step)
    {
        $this->step = $step;
    }

    public function sendCode()
    {
        Http::get("http://5.223.47.101:9503/api/users/$this->sessionName/phoneLogin?phone=$this->sessionName");
    }

    public function addAccount()
    {

        if ($this->step == 0){
            Http::get("http://5.223.47.101:9503/system/addSession?session=users/$this->sessionName");
        }elseif ($this->step == 2){
            Http::get("http://5.223.47.101:9503/api/users/$this->sessionName/completePhoneLogin?code=$this->code");
        }
        elseif ($this->step == 3){
            Http::get("http://5.223.47.101:9503/api/users/$this->sessionName/complete2falogin?password=$this->phone");
        }
    }

    public function render()
    {
        return view('livewire.telegram.add-account')->extends("adminlte::page");
    }
}
