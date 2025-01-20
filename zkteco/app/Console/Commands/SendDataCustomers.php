<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Token;
use App\Models\Customer;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class SendDataCustomers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-data-customers';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    protected $customer;

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $get_token = null;
        $get_token = Customer::get_new_token();
        $token = Token::pluck('token')->first();

            // $token = new Token();
            // $token->token = $get_token->token;
            // $token->save();
        // }

        $data = '';
            
        $latest_data_id = Customer::latest()->first();
        $documents = Customer::get_request($token, "/iclock/api/transactions/?page_size=10000000000000");
        $users = User::all();
        
        foreach ($documents->data as $key => $values) {
            if ($values->id > $latest_data_id->zkteco_id) {
                $new_customer = new Customer();
                $new_customer->zkteco_id = $values->id;
                $new_customer->first_name = $values->first_name;
                $new_customer->last_name = $values->last_name;
                $new_customer->emp_id = $values->emp;
                $new_customer->type = $values->punch_state_display;
                $new_customer->datetime = $values->punch_time;
                $new_customer->save();
                foreach ($users as $key => $user) {
                    if ($user->zkteco_id == $values->emp) {
                        Http::get("https://api.telegram.org/bot624760197:AAFOx7I3xaB6wbmEZqAd8BfgPYqSOu4s_3Q/sendMessage",
                        [
                            'chat_id'=> $user->chat_id,
                            'text'=> 'Ваш '. $values->punch_state_display .' зафиксирован в: ' . $values->punch_time,
                            'parse_mode' => 'html'
                            ]
                        );
                    }
                }
            }
        }
    }
}
