<x-app-layout>
    <x-slot name="header">
        <h2 class="text-center font-semibold text-xl text-gray-800 leading-tight">
            CoinMarketCap
        </h2>
        <link href="https://cdn.jsdelivr.net/npm/tailwindcss/dist/tailwind.min.css" rel="stylesheet">


        <form action="/crypto" method="get">
            <div class="relative rounded-md shadow-sm">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" fill-rule="evenodd"/>
                    </svg>
                </div>
                <input class="form-input py-3 pl-10 rounded-md leading-5 bg-white border-gray-300 focus:outline-none focus:shadow-outline-blue focus:border-blue-300" placeholder="Search" type="search" name="search" value="">
            </div>
        </form>

    </x-slot>
    <div class="flex justify-center">
        <div class="bg-white-400 p-4 m-2 flex-1 w-1/4 rounded-lg">
            @foreach($crypt as $crypto)

                    <p>
                        <a href="/crypto{{ $crypto->getSymbol() }}"  class= "flex justify-center font-bold text-gray-700 text-xl ">{{ $crypto->getSymbol() }}</a><br>
                        <div class="flex justify-center" >
                            Price: {{ $crypto->getPrice() }}<br>
                        </div>
                        <div class="flex justify-center">
                            : {{ $crypto->getPriceChange1h() }}<br>
                        </div>
                        <div class="flex justify-center">
                            : {{ $crypto->getPriceChange24h() }}<br>
                        </div>
                        <div class="flex justify-center">
                            : {{ $crypto->getPriceChange7d() }}<br><br>
                        </div>


            <div class="flex justify-center">
                <form action="/cryptoBuy" method="post" >
                    @csrf
                    <label class= " bg-grey-4  ">
                        <input type="text" name="buyAmount"  placeholder="Enter amount" >
                    </label>
                    <input type="hidden" name="symbol" value="{{ $crypto->getSymbol() }}">
                    <div class="flex justify-center mb-4">
                        <label for="account" class="sr-only">Account</label>
                        <select name="from_account" id="from_account"
                                class="bg-grey border-2 w-full p-4 rounded-lg">
                            @foreach($accounts as $account)
                                <option value="{{ $account->number }}">
                                    {{ $account->number }}
                                    / {{ $account->getFormattedBalance() }} {{ $account->currencySymbol}}</option>
                            @endforeach
                        </select>
                    <button class="px-4 py-2 rounded bg-green-500 text-black font-bold" type="submit">
                        Buy
                    </button>
                    </div>
                </form>
                <form action="/cryptoSell" method="post">
                    @csrf
                    <label class= " bg-red border-2 ">
                        <input type="text" name="sellAmount" placeholder="Enter amount">
                    </label>
                    <input type="hidden" name="symbol" value="{{ $crypto->getSymbol() }}">
                    <div class=" flex justify-center mb-4">
                    <select name="from_account" id="from_account"
                            class="bg-grey border-2 w-full p-4 rounded-lg">
                        @foreach($accounts as $account)
                            <option value="{{ $account->number }}">
                                {{ $account->number }}
                                / {{ $account->getFormattedBalance() }} {{ $account->currencySymbol}}</option>
                        @endforeach
                    </select>
                    <button class="px-4 py-2 rounded bg-red-500 text-black font-bold" type="submit">
                        Sell
                    </button>
                    </div>
                </form>
            </div>
            @endforeach
        <div>
            @if(isset($message)) {{$message}} @endif
        </div>
    </div>
</x-app-layout>
