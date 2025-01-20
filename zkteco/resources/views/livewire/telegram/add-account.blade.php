<div>
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>
    <section class="max-w-4xl mx-auto mt-10">
        <div class="bg-white shadow-md rounded-lg">
            <div class="p-6 bg-gray-200 rounded-t-lg">
                <h1 class="text-2xl font-semibold mt-2">Account</h1>
            </div>
            seession: {{$sessionName}}
            @if($step == 0)
                <div class="p-6">
                    <div class="bg-white shadow rounded-lg p-4 flex justify-center items-center">
                        <label class="relative block">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-2">
                              <svg class="h-5 w-5 fill-slate-300" viewBox="0 0 20 20"><!-- ... --></svg>
                            </span>
                        </label>
                        <input class="placeholder:italic placeholder:text-slate-400 block bg-white w-full border border-slate-300 rounded-md py-2 pl-9 pr-3 shadow-sm focus:outline-none focus:border-sky-500 focus:ring-sky-500 focus:ring-1 sm:text-sm" placeholder="Напишите номер" type="text" wire:model="sessionName"/>
                        <button class="bg-indigo-500" wire:click.prevent="changeStep('1'), addAccount()">Отправить код</button>
                        <button wire:click.prevent="addAccount()">save</button>
                    </div>
                </div>
                    @elseif($step == 1)
                    <div class="mt-4 text-center">
                        <button class="bg-indigo-500" wire:click.prevent="changeStep('2'), sendCode()">Верно</button>
                        <p class="text-gray-700">message = {{$message}}</p>
                    </div>
                </div>
            @elseif($step == 2)
                <div class="p-6">
                    <input wire:model="code" class="w-full px-4 py-2 border rounded-md" placeholder="Введите код">
                    <button wire:click.prevent="addAccount()" class="mt-4 w-full bg-blue-500 text-white py-2 rounded-md hover:bg-blue-600">
                        Подтвердить
                    </button>
                </div>
            @elseif($step == 3)
                <div class="p-6">
                    <p class="text-gray-700">{{$message}}</p>
                    <table class="min-w-full bg-white mt-4">
                        <thead>
                        <tr>
                            <th class="px-4 py-2 font-bold text-blue-950" >ID</th>
                            <th class="px-4 py-2 font-bold text-blue-950">Session Name</th>
                            <th class="px-4 py-2 font-bold text-blue-950">Phone Number</th>
                            <th class="px-4 py-2 font-bold text-blue-950">First Name</th>
                            <th class="px-4 py-2 font-bold text-blue-950">Last Name</th>
                            <th class="px-4 py-2 font-bold text-blue-950">Status</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td class="border px-4 py-2 font-bold text-blue-950">{{$record->id}}</td>
                            <td class="border px-4 py-2 font-bold text-blue-950">{{$record->session_name}}</td>
                            <td class="border px-4 py-2 font-bold text-blue-950">{{$record->phone_number}}</td>
                            <td class="border px-4 py-2 font-bold text-blue-950">{{$record->first_name}}</td>
                            <td class="border px-4 py-2 font-bold text-blue-950">{{$record->last_name}}</td>
                            <td class="border px-4 py-2 font-bold text-blue-950">{{$record->status}}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </section>
</div>
