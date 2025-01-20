<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Token;

class SendDataEveryDay extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-data-every-day';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $today = Carbon::today()->format('Y-m-d');
        $today_text = Carbon::today()->format('d.m.Y');

        $get_customer_data = Customer::whereDate('datetime', $today)->where('type', 'Приход')->orderBy('created_at', 'asc')->groupBy('emp_id')->get();
        $text = '❗️Табель учета рабочего времени сотрудников за '. $today_text . '.' . PHP_EOL . PHP_EOL . '<b>Пришли вовремя:</b>' . PHP_EOL;
        $get_data = '';
        $late_text = PHP_EOL . '<b>Опоздали</b>'. PHP_EOL;
        $end_text = PHP_EOL . '‼️ Лицам находящимся в категории "Опоздали" необходимо в течении 1-ого рабочего дня предоставить объяснительную HR менеджеру.' . PHP_EOL . PHP_EOL;
        $end_data = '';

        foreach ($get_customer_data as $key => $value) {
            if (date('H:i', strtotime($value->datetime)) < '09:01') {
                $get_data .= $key+1 . '. ' . $value->first_name . ' ' . $value->last_name . ' ' . date('H:i', strtotime($value->datetime)) . PHP_EOL;
            }
        }
        $number = 1;
        foreach ($get_customer_data as $key => $value) {
            if(date('H:i', strtotime($value->datetime)) > '09:00') {
                $end_data .= $number++ . '. ' . $value->first_name . ' ' . $value->last_name . ' ' . date('H:i', strtotime($value->datetime)) . PHP_EOL;
            }
        }
        
        if (empty($end_data)) {
            $response = Http::get("https://api.telegram.org/bot624760197:AAFOx7I3xaB6wbmEZqAd8BfgPYqSOu4s_3Q/sendMessage",
                [
                    'chat_id'=>'-1001442543088',
                    // 'chat_id'=>'2051308894',
                    'text'=> $text . $get_data,
                    'parse_mode' => 'html'
                ]
        );
        } else {
            $response = Http::get("https://api.telegram.org/bot624760197:AAFOx7I3xaB6wbmEZqAd8BfgPYqSOu4s_3Q/sendMessage",
                [
                    'chat_id'=>'-1001442543088',
                    // 'chat_id'=>'2051308894',
                    'text'=> $text . $get_data . $late_text . $end_data . $end_text,
                    'parse_mode' => 'html'
                ]
        );
        }
    }
}
