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

            <div class="flex">
                <form class="bg-white p-6 rounded-lg shadow-md mr-2" action="/transaction-history-show-all" method="GET">
                    <input type="hidden">
                    <button class="bg-indigo-500 text-white py-2 px-4 rounded-lg hover:bg-red-500">Show All</button>
                </form>
                <form class="bg-white p-6 rounded-lg shadow-md mr-2" action="/transaction-history-show-" method="GET">
                    <div class="mb-4">
                        <label class="text-gray-700 font-medium mb-2" for="user-choice">User Choice</label>
                        <input class="bg-gray-200 border-2 rounded w-full py-2 px-4 text-gray-700 focus:outline-none focus:bg-white focus:border-indigo-500" type="text" name="user-choice" id="user-choice"placeholder="Show from 0-">
                    </div>
{{--                    <button class="bg-indigo-500 text-white py-2 px-4 rounded-lg hover:bg-indigo-600">Search</button>--}}
                </form>
                <form class="bg-white p-6 rounded-lg shadow-md" action="/transaction-history-search-date" method="GET">
                    <div class="mb-4">
                        <label class="text-gray-700 font-medium mb-2" for="start_date">Start Date</label>
                        <input class="bg-gray-200 border-2 rounded w-full py-2 px-4 text-gray-700 focus:outline-none focus:bg-white focus:border-indigo-500" type="text" name="start_date" id="start_date" placeholder="Start Date:">
                    </div>
                    <div class="mb-4">
                        <label class="text-gray-700 font-medium mb-2" for="end_date">End Date</label>
                        <input class="bg-gray-200 border-2 rounded w-full py-2 px-4 text-gray-700 focus:outline-none focus:bg-white focus:border-indigo-500" type="text" name="end_date" id="end_date" placeholder="End Date:">
                    </div>
                    <button class="bg-indigo-500 text-white py-2 px-4 rounded-lg hover:bg-indigo-600">Search By Date</button>
                </form>
            </div>




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
