<x-app-layout>
    <x-slot name="header">
        @foreach($accounts as $account2)
            @if($account2->label)
                <a href="/accounts/{{ $account2->id }}/edit" class="text-sm text-gray-700 underline"><b>{{$account2->label }}:</b> {{ $account2->number }}</a><br>
            @else
                <a href="/accounts/{{ $account2->id }}/edit" class="text-sm text-gray-700 underline"><b>{{$account2->label }}</b> {{ $account2->number }}</a><br>
            @endif
        @endforeach
            <br><br>
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Get account name -
            @if($account->label)
                {{ $account->label }} (<small>{{ $account->number }}</small>)
        @else
            {{ $account->number }}
        @endif
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{route('accounts.update', $account)}}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="mb-4">
                            <label for="number" class="sr-only">Label</label>
                            <input type="text" name="label" id="label" placeholder="Write account name {{ $account->number }}"
                                   class="bg-white border-2 w-full p-4 rounded-lg" value="{{ $account->label }}">
                        </div>
                        <div>
                            <button type="submit" class="bg-blue-500 text-black px-4 py-3 rounded font-medium ">Update
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
