<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            History
        </h2>
    </x-slot>

        <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    </head>

    <body>
    <br><br>
    <div class="justify-center items-center">
        <div class="bg-white px-8 py-6 rounded-lg shadow-lg text-center">
            <h2 class="text-xl font-bold mb-4">Transaction History</h2>
            <table class="table-auto mx-auto">
                <thead>
                <tr>
                    <th class="px-4 py-2">User ID</th>
                    <th class="px-4 py-2">History</th>
                    <th class="px-4 py-2">Transferred From</th>
                    <th class="px-4 py-2">Transferred To</th>
                    <th class="px-4 py-2">Date</th>
                </tr>
                </thead>
                <tbody>
@foreach($userHistory as $history)
                <tr>
                    <td class="border px-4 py-2">{{$history->user_id}}</td>
                    <td class="border px-4 py-2">{{$history->history}}</td>
                    <td class="border px-4 py-2">{{$history->transferred_from}}</td>
                    <td class="border px-4 py-2">{{$history->transferred_to}}</td>
                    <td class="border px-4 py-2">{{$history->created_at}}</td>
                </tr>
@endforeach
                </tbody>
            </table>
        </div>
    </div>
    </body>
    </html>





</x-app-layout>
