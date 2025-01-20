<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Customer $customer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Customer $customer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        //
    }
    
    /**
     * Remove the specified resource from storage.
     */
    public function send_message()
    {
        $response = Http::get("https://api.telegram.org/bot624760197:AAFOx7I3xaB6wbmEZqAd8BfgPYqSOu4s_3Q/sendMessage",
                [
                    'chat_id'=>'-1001442543088',
                    //'chat_id'=>'2051308894',
                    'text'=> '‼️Пунктуальность - важная часть успеха‼️
Компания благодарна сотрудникам, которые четко соблюдают дисциплину:

Комарова Ольга
Яруллин Алим
Чавдарова Анастасия
Расулова Саодат
Аллаяров Жахонгир
Миршарипов Миржамол
Юсупова Лола
Иргашева Хаётхон
Мухамедова Гулнора
Керимкулов Булат
Кожуленко Нелли
Аскаров Хусан
Ипполитов Павел

P.S. Напоминаем, что за вашу пунктуальность, компания добавляет к вашему окладу еще 10%',
                    'parse_mode' => 'html'
                ]
        );
    }
}
