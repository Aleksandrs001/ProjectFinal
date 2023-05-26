<x-app-layout>
    <x-slot name="header">
        @foreach($accounts as $acc)
            @if($acc->label)
                <a href="/accounts/{{ $acc->id }}/edit" class="text-sm text-gray-700 underline"><b>{{$acc->label }}:</b> {{ $acc->number }} <b>{{$acc->getFormattedBalance()}} </b> <b> {{$acc->currencySymbol}}</b></a><br>
            @else
                <a href="/accounts/{{ $acc->id }}/edit" class="text-sm text-gray-700 underline"><b>{{$acc->label }}</b> {{ $acc->number }} <b>{{$acc->getFormattedBalance()}} </b> <b> {{$acc->currencySymbol}}</b></a><br>
            @endif
        @endforeach
            <br><br>
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit account name -
            @if($account->label)
                {{ $account->label }} (<small>{{ $account->number }} - {{$account->getFormattedBalance()}} {{$account->currencySymbol}}</small>)
        @else
           (<small> {{ $account->number }} - {{$account->getFormattedBalance()}} {{$account->currencySymbol}} </small>)
        @endif
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{route('accounts.update', $account)}}" method="post">
                        @csrf
                        @method('PUT')
                            <label for="number" class="sr-only">Label</label>
                        <label for="label"></label><input type="text" name="label" id="label" placeholder="Write account name {{ $account->number }} - {{$account->getFormattedBalance()}} {{$account->currencySymbol}}"
                                                          class="bg-white border-2 w-full p-4 rounded-lg" value="{{ $account->label }}">

                        <div>
                            <button id="update" type="submit" class="bg-blue-500 text-black px-4 py-3 rounded font-medium ">Update
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        @if (session('status'))
            <div class="bg-red-600  shadow-sm sm:rounded-lg">
                <div class="p-6 text-white">
                {{  session('status') }}
                </div>
            </div>
        @endif

    </div>

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-2">
        <div class="bg-red-600  shadow-sm sm:rounded-lg">
            <div class="p-6 text-white">
                <form action="{{route('accounts.softDelete', $account)}}" method="post">
                        @csrf
                        @method('POST')

                    <div>
                        <button id="delete" type="submit" class="bg-red-500 text-black px-4 py-3 rounded font-medium "> Soft Delete
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</x-app-layout>

