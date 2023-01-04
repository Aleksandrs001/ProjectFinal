<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            edit -
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
                            <input type="text" name="label" id="label" placeholder="Label"
                                   class="bg-gray-100 border-2 w-full p-4 rounded-lg" value="{{ $account->label }}">
                        </div>
{{--                        submit button--}}
                        <div>
                            <button type="submit" class="bg-blue-500 text-black px-4 py-3 rounded font-medium ">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
