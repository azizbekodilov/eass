<?php

namespace App\Livewire\Telegram;

use App\Models\TelegramAccount;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class AddAccount extends Component
{

    public $step = 0;
    public $message;
    public $sessionName;
    public $phone;
    public $code;
    public $newAccount;
    public $current_tg;
    public $tg_id = 0;

    public function changeStep($step)
    {
        $this->step = $step;
    }

    public function addSession()
    {
        $this->current_tg = TelegramAccount::where('session', 'users/'.$this->sessionName)->first();
        if ($this->current_tg) {
            $this->tg_id = TelegramAccount::where('session', 'users/'.$this->sessionName)->first()->id;
        }
        $this->changeStep(1);
    }

    public function sendCode()
    {
        Http::get("http://5.223.47.101:9503/system/addSession?session=users/$this->sessionName");
                $this->newAccount = TelegramAccount::create(
                    [
                        'session' => 'users/'.$this->sessionName,
                    ]
        );
        Http::get("http://5.223.47.101:9503/api/users/$this->sessionName/phoneLogin?phone=$this->sessionName");
        $this->changeStep(2);
    }

    public function phoneLogin($sessionName)
    {
        $number = explode("/", $sessionName);
        $phoneNumber = $number[1];
        Http::get("http://5.223.47.101:9503/api/users/$sessionName/phoneLogin?phone=$phoneNumber");
        $this->changeStep(2);
    }

    public function addAccount()
    {
        Http::get("http://5.223.47.101:9503/api/users/$this->sessionName/completePhoneLogin?code=$this->code");
        $this->changeStep(3);
    }

    public function checkStatus($session)
    {
        $datas = collect(Http::get("http://5.223.47.101:9503/api/$session/getSelf")->json());
        $collect = $datas->toArray();
        if ($collect['success'] == false) {
            $tg = TelegramAccount::where('session', $session)->first();
            $tg->status = $collect['errors'][0]['message'];
            $tg->save();
        } else {
            $datas = collect(Http::get("http://5.223.47.101:9503/system/getSessionList")->json());
            $collect = $datas->toArray();
            foreach ($collect['response']['sessions'] as $key => $value) {
                $tg = TelegramAccount::where('session', $session)->first();
                if ($value['session'] == $session) {
                    $tg->status = $value['status'];
                    $tg->save();
                }
            }
        }
    }

    public function removeSession($session)
    {
        Http::get("http://5.223.47.101:9503/system/removeSession?session=$session");
        Http::get("http://5.223.47.101:9503/system/unlink?session=$session");
        $this->checkStatus($session);
    }


    public function render()
    {
        $data = collect(Http::get("http://5.223.47.101:9503/system/getSessionList"));
        // foreach (data as $key => $value) {
        //     $new = new TelegramAccount();
        //     $new->session = $value['session'];
        //     $new->status = $value['status'];
        //     $new->save();
        // }

        $all_sessions = TelegramAccount::all();
        // dd($collet['response']['sessions']->where('session', 'aiz'));


        return view('livewire.telegram.add-account', compact('data', 'all_sessions'))->extends("adminlte::page");
    }
}
