<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <ul>
                        @foreach($accounts as $account)
                            @if( $account->label )
                                <li><b>{{$account->label}}: </b>{{ $account->number }} /
                                    <b>{{ $account->getFormattedBalance() }} </b>{{$account->currencySymbol}}</li>
                            @else
                                <li><b>{{$account->label}} </b>{{ $account->number }} /
                                    <b>{{ $account->getFormattedBalance() }} </b>{{$account->currencySymbol}}</li>
                            @endif
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
    {{--    create--}}
    <form action="{{route('createCurrencyAcc')}}" method="post">
        @csrf
        <div class="py-12">
            <div class=" max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    Create new valute account
                    <div class="mb-4">
                        <label for="number" class="sr-only">Label</label>
                        <label for="account" class="sr-only">Account</label>
                        <select name="valute" id="valute" class="bg-white border-2 w-full p-4 rounded-lg">
                            @foreach($currency as $val)
                                <option value="{{ $val['ID'] }}">
                                    {{ $val['ID'] }} </option>
                            @endforeach
                        </select>
                        <div>
                            <button type="submit" class="bg-blue-500 text-black px-4 py-3 rounded font-medium ">Create
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    @if (session('status'))
        <div class="bg-red-600  shadow-sm sm:rounded-lg">
            <div class="p-6 text-white">
                {{ session('status') }}
            </div>
        </div>
    @endif

</x-app-layout>
