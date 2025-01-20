<div>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>
    <section class="max-w-4xl mx-auto mt-10">
        <div class="bg-white shadow-md rounded-lg mt-2">
            <div class="p-2 mt-2 bg-gray-200 rounded-t-lg">
                <h1 class="text-2xl font-semibold mt-2">Телеграм аккаунты</h1>
            </div>
            @if($step == 0)
            <div class="p-6">
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                        Напишите тел. номер без плюс и пробелом
                    </label>
                    <input
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        wire:model="sessionName" type="number" placeholder="998901234567">
                </div>
                <button
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                    wire:click.prevent="addSession()">
                    Дальше
                </button>
            </div>
        </div>
        @elseif($tg_id != null)
        <div class="mt-4 text-center">
            ВЫ НЕ МОЖЕТЕ ДОБАВИТЬ ЭТОТ АККАУНТ, так как <p class="text-red font-bold">ЭТОТ АККАУНТ УЖЕ ЕСТЬ В БАЗЕ </p>
            <button
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                wire:click.prevent="changeStep('0')">
                Добавить другой номер
            </button>
        </div>
        @elseif($step == 1)
        <div class="mt-4 text-center">
            <button class="bg-blue-500 hover:bg-blue-500 text-white font-bold py-1 px-1 rounded"
                wire:click.prevent="sendCode()">Номер правильно?</button>
        </div>
        @elseif($step == 2)
        <div class="p-6">
            <input wire:model="code" class="w-full px-4 py-2 border rounded-md" placeholder="Введите код">
            <button wire:click.prevent="addAccount()"
                class="bg-blue-500 hover:bg-blue-500 text-white font-bold py-1 px-1 rounded">
                Подтвердить
            </button>
            <button wire:click.prevent="sendCode()"
                class="bg-blue-500 hover:bg-blue-500 text-white font-bold py-1 px-1 rounded">
                Переотправить
            </button>
        </div>
</div>
@endif
<div class="p-6">
    <p class="text-gray-700">{{$message}}</p>
    <table class="min-w-full bg-white mt-4">
        <thead>
            <tr>
                <th class="px-4 py-2 font-bold text-blue-950">ID</th>
                <th class="px-4 py-2 font-bold text-blue-950">Session Name</th>
                <th class="px-4 py-2 font-bold text-blue-950">Phone Number</th>
                {{-- <th class="px-4 py-2 font-bold text-blue-950">First Name</th>
                <th class="px-4 py-2 font-bold text-blue-950">Last Name</th> --}}
                <th class="px-4 py-2 font-bold text-blue-950">Status</th>
                <th class="px-4 py-2 font-bold text-blue-950">Action</th>
            </tr>
        </thead>
        <tbody>
            {{-- {{dd($all_sessions)}} --}}
            {{-- @foreach ($data['response']['sessions'] as $item)
            <tr>
                <td>
                    {{$item['session']}}
                </td>
                <td>
                    {{$item['status']}}
                </td>
            </tr>
            @endforeach --}}
            @foreach ($all_sessions as $key => $item)
            <tr>
                <td>{{$key+1}}</td>
                <td>
                    {{$item->session}}
                </td>
                <td>
                    {{$item->session}}
                </td>
                <td>
                    {{$item->status}}
                </td>
                <td>
                    <button wire:click.prevent="checkStatus('{{$item->session}}')">Проверить статус</button>
                    <button wire:click.prevent="removeSession('{{$item->session}}')">Revoke</button>
                </td>
            </tr>
            @endforeach
            {{-- <tr>
                <td class="border px-4 py-2 font-bold text-blue-950">{{$record->id}}</td>
                <td class="border px-4 py-2 font-bold text-blue-950">{{$record->session_name}}</td>
                <td class="border px-4 py-2 font-bold text-blue-950">{{$record->phone_number}}</td>
                <td class="border px-4 py-2 font-bold text-blue-950">{{$record->first_name}}</td>
                <td class="border px-4 py-2 font-bold text-blue-950">{{$record->last_name}}</td>
                <td class="border px-4 py-2 font-bold text-blue-950">{{$record->status}}</td>
            </tr> --}}
        </tbody>
    </table>
</div>

</div>
</section>
</div>
