<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Transfer Balance
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm ">
                <div class="p-6 text-gray-900">
                    <form action="{{route('balance-transfer')}}" method="post">

                        @csrf
                        <div class="mb-4">
                            <label for="account" class="sr-only">Account</label>
                            <select name="from_account" id="from_account"
                                    class="bg-red border-2 w-full p-4 rounded-lg">
                                @foreach($accounts as $account)
                                    <option value="{{ $account->id }}">
                                        {{ $account->number }}
                                        / {{ $account->getFormattedBalance() }} {{ $account->currencySymbol}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-7">
                            <label for="account" class="sr-only">Account</label>
                            <input type="text" name="to_account" id="to_account" placeholder="Account Number"
                                   class="bg-white border-2 w-full p-4 rounded-lg" value="">
                            <div class="mb-4">
                                <label for="number" class="sr-only">Amount</label>
                                <input type="text" name="amount" id="amount" placeholder="Amount"
                                       class="bg-white border-2 w-full p-4 rounded-lg" value="">
                            </div>
                            <div>
                                <label for="keycard">smart id:</label><br>
                                <input type="text" id="keycard" name="keycard"
                                       placeholder="Enter key card number:{{ $code }}"><br>
{{--                                <input type="submit" value="Submit">--}}
                            </div>
                            <div>
                                <button type="submit" class="bg-blue-500 text-black px-4 py-3 rounded font-medium ">
                                    Submit
                                </button>
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li class="text-red-600 font-small">*{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                            </div>
                        </div>


                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
