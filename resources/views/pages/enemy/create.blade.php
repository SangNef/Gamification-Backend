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
            <a href="/admin/enemy-manage" class="text-pink-600">/ Enemies manage</a>
            <p class="text-gray-400">/ Create enemy</p>
        </div>
        <h1 class="font-bold text-2xl leading-7 my-6">Create enemy</h1>
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
            <h3 class="text-base leading-6 uppercase text-gray-400">Enemy infomation</h3>
            <form action="{{ route('enemy.create') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="pt-4 pb-2 w-full max-w-md">
                    <label for="name" class="inline-block text-sm leading-5 font-medium text-gray-900 mb-1">Enemies
                        name</label><span class="text-red-500">*</span>
                    <input type="text" id="name" name="name"
                        class="w-full border border-gray-300 rounded-lg py-2 px-3 focus:outline-none text-gray-900">
                </div>
                <div class="max-w-md">
                    <label class="inline-block text-sm leading-5 font-medium text-gray-900 mb-1">Enemi access
                    </label><span class="text-red-500">*</span>
                    <div class="bg-gray-100 p-8 text-center rounded-lg border-dashed border-2 border-gray-300 hover:border-blue-500 transition duration-300 ease-in-out transform hover:scale-105 hover:shadow-md"
                        id="dropzone">
                        <label for="fileInput" class="cursor-pointer flex flex-col items-center space-y-2">
                            <svg class="w-16 h-16 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            <span class="text-gray-600">Drag and drop your files here</span>
                            <span class="text-gray-500 text-sm">(or click to select)</span>
                        </label>
                        <input type="file" id="fileInput" name="access" class="hidden" multiple>
                    </div>
                    <div class="mt-6 text-center" id="fileList"></div>
                </div>
                <div class="w-full max-w-md py-2">
                    <label class="inline-block text-sm leading-5 font-medium text-gray-900 mb-1" for="type">Enemies
                        type</label><span class="text-red-500">*</span>
                    <div class="w-full flex justify-around text-gray-900">
                        <div>
                            <input type="radio" id="normal" name="type" value="normal" checked>
                            <label for="normal">Normal</label>
                        </div>
                        <div>
                            <input type="radio" id="elite" name="type" value="elite">
                            <label for="elite">Elite</label>
                        </div>
                        <div>
                            <input type="radio" id="boss" name="type" value="boss">
                            <label for="boss">Boss</label>
                        </div>
                        <div>
                            <input type="radio" id="legendary" name="type" value="legendary">
                            <label for="legendary">Legendary</label>
                        </div>
                    </div>
                </div>
                <div class="w-full max-w-md py-2">
                    <label class="inline-block text-sm leading-5 font-medium text-gray-900 mb-1" for="rank">Enemies
                        rank</label><span class="text-red-500">*</span>
                    <div class="w-full flex justify-around text-gray-900">
                        <div>
                            <input type="radio" id="rank-1" name="rank" value="1" checked>
                            <label for="rank-1">1</label>
                        </div>
                        <div>
                            <input type="radio" id="rank-2" name="rank" value="2">
                            <label for="rank-2">2</label>
                        </div>
                        <div>
                            <input type="radio" id="rank-3" name="rank" value="3">
                            <label for="rank-3">3</label>
                        </div>
                        <div>
                            <input type="radio" id="rank-4" name="rank" value="4">
                            <label for="rank-4">4</label>
                        </div>
                        <div>
                            <input type="radio" id="rank-5" name="rank" value="5">
                            <label for="rank-5">5</label>
                        </div>
                    </div>
                </div>
                <div class="pt-4 pb-2 w-full max-w-md">
                    <label for="hp" class="inline-block text-sm leading-5 font-medium text-gray-900 mb-1">Enemy
                        hp</label><span class="text-red-500">*</span>
                    <input type="number" id="hp" name="hp"
                        class="w-full border border-gray-300 rounded-lg py-2 px-3 focus:outline-none text-gray-900">
                </div>
                <div class="pt-4 pb-2 w-full max-w-md">
                    <label for="dame" class="inline-block text-sm leading-5 font-medium text-gray-900 mb-1">Enemy
                        dame</label><span class="text-red-500">*</span>
                    <input type="number" id="dame" name="dame"
                        class="w-full border border-gray-300 rounded-lg py-2 px-3 focus:outline-none text-gray-900">
                </div>
                <div class="pt-4 pb-2 w-full max-w-md">
                    <label for="def" class="inline-block text-sm leading-5 font-medium text-gray-900 mb-1">Enemy
                        def</label><span class="text-red-500">*</span>
                    <input type="number" id="def" name="def"
                        class="w-full border border-gray-300 rounded-lg py-2 px-3 focus:outline-none text-gray-900">
                </div>
                <button type="submit"
                    class="py-2 px-4 mt-2 rounded-lg bg-pink-400 hover:bg-pink-500 text-white duration-300">Send</button>
            </form>
        </div>
    </section>
    <script>
        const dropzone = document.getElementById('dropzone');
        const fileInput = document.getElementById('fileInput');
        const fileList = document.getElementById('fileList');

        dropzone.addEventListener('dragover', (e) => {
            e.preventDefault();
            dropzone.classList.add('border-blue-500', 'border-2');
        });

        dropzone.addEventListener('dragleave', () => {
            dropzone.classList.remove('border-blue-500', 'border-2');
        });

        dropzone.addEventListener('drop', (e) => {
            e.preventDefault();
            dropzone.classList.remove('border-blue-500', 'border-2');

            const files = e.dataTransfer.files;
            handleFiles(files);
        });

        fileInput.addEventListener('change', (e) => {
            const files = e.target.files;
            handleFiles(files);
        });

        function handleFiles(files) {
            fileList.innerHTML = '';

            for (const file of files) {
                const listItem = document.createElement('div');
                listItem.textContent = `${file.name} (${formatBytes(file.size)})`;
                fileList.appendChild(listItem);
            }
        }

        function formatBytes(bytes) {
            if (bytes === 0) return '0 Bytes';

            const k = 1024;
            const sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB'];
            const i = Math.floor(Math.log(bytes) / Math.log(k));

            return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
        }
    </script>
@endsection
