@extends('layout')
@section('content')
    <section class="bg-gray-100 min-h-screen w-full pl-6 sm:pl-[88px] pr-6 overflow-hidden font-inter">
        <div class="h-4 flex items-center gap-1 my-2">
            <a href="/admin/dashboard" class="text-pink-400">
                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V9z" />
                    <polyline points="9 22 9 12 15 12 15 22" />
                </svg>
            </a>
            <a href="/admin/game-manage" class="text-pink-600">/ Game manage</a>
            <p class="text-gray-400">/ Create game</p>
        </div>
        <h1 class="font-bold text-2xl leading-7 my-6">Create game</h1>
        @if (session('success'))
            <div class="bg-green-500 text-white p-4 mb-4 rounded">
                {{ session('success') }}
            </div>
        @endif
        @if ($errors->any())
            <div class="bg-red-500 text-white p-4 mb-4 rounded">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="w-full bg-white rounded-lg shadow my-4 p-6">
            <h3 class="text-base leading-6 uppercase text-gray-400">Game infomation</h3>
            <form action="{{ route('game.create') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="pt-4 pb-2 w-full max-w-md">
                    <label for="name" class="inline-block text-sm leading-5 font-medium text-gray-900 mb-1">Game
                        name</label><span class="text-red-500">*</span>
                    <input type="text" id="name" name="name"
                        class="w-full border border-gray-300 rounded-lg py-2 px-3 focus:outline-none text-gray-900">
                </div>
                <div class="pt-4 pb-2 w-full max-w-md">
                    <label for="point" class="inline-block text-sm leading-5 font-medium text-gray-900 mb-1">Game
                        point</label><span class="text-red-500">*</span>
                    <input type="text" id="point" name="point"
                        class="w-full border border-gray-300 rounded-lg py-2 px-3 focus:outline-none text-gray-900">
                </div>
                <div class="w-full max-w-md py-2">
                    <label class="inline-block text-sm leading-5 font-medium text-gray-900 mb-1" for="rank">Game
                        rank</label><span class="text-red-500">*</span>
                    <div class="w-full flex justify-around text-gray-900">
                        <div>
                            <input type="radio" id="1" name="rank" value="1" checked>
                            <label for="1">1</label>
                        </div>
                        <div>
                            <input type="radio" id="2" name="rank" value="2">
                            <label for="2">2</label>
                        </div>
                        <div>
                            <input type="radio" id="3" name="rank" value="3">
                            <label for="3">3</label>
                        </div>
                        <div>
                            <input type="radio" id="4" name="rank" value="4">
                            <label for="4">4</label>
                        </div>
                    </div>
                </div>
                <div class="pt-4 pb-2 w-full max-w-md">
                    <label for="level" class="inline-block text-sm leading-5 font-medium text-gray-900 mb-1">Level
                        require</label><span class="text-red-500">*</span>
                    <input type="number" id="level" name="level"
                        class="w-full border border-gray-300 rounded-lg py-2 px-3 focus:outline-none text-gray-900">
                </div>
                <div class="pt-4 pb-2 w-full">
                    <span class="inline-block text-sm leading-5 font-medium text-gray-900 mb-1">Special items</span>
                    <span id="add-item"
                        class="py-2 px-4 mt-2 ml-4 rounded-lg bg-pink-400 hover:bg-pink-500 text-white duration-300 text-sm cursor-pointer">Add
                        item</span>
                    <div class="grid lg:grid-cols-3 py-4">
                        <div class="max-w-md">
                            <input type="text" class="w-full py-2 px-3 border-b border-gray-300 focus:outline-none"
                                placeholder="Search items">
                        </div>
                        <div id="selected-items"></div>
                    </div>
                </div>
                <button type="submit"
                    class="py-2 px-4 mt-2 rounded-lg bg-pink-400 hover:bg-pink-500 text-white duration-300">Send</button>
            </form>
        </div>
    </section>

    <script>
        var availableItems = {!! json_encode($items) !!};

        document.getElementById('search-items').addEventListener('input', function() {
            var searchText = this.value.toLowerCase();
            var selectedItemsDiv = document.getElementById('selected-items');

            selectedItemsDiv.innerHTML = '';

            var filteredItems = availableItems.filter(function(item) {
                return item.name.toLowerCase().includes(searchText);
            });

            filteredItems.forEach(function(item) {
                var itemDiv = document.createElement('div');
                itemDiv.textContent = item.name;
                selectedItemsDiv.appendChild(itemDiv);
            });
        });
    </script>
@endsection
