@extends('layout')

@section('content')
<section class="bg-gray-100 min-h-screen w-full pl-6 sm:pl-[88px] pr-6 overflow-hidden font-inter">
    <div class="flex w-full items-center gap-1 py-2 font-inter">
        <a href="#" class="text-pink-600">
            <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V9z" />
                <polyline points="9 22 9 12 15 12 15 22" />
            </svg>
        </a>
        <a href="/admin/npc-manage" class="text-pink-600">/ Npc manage</a>
        <p class="text-gray-400">/ Create Npc</p>
    </div>
    <h1 class="font-bold text-2xl leading-7 my-6">Create Npc</h1>
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <div class="w-full bg-white rounded-lg shadow my-4 p-6">
        <h3 class="text-base leading-6 uppercase text-gray-400">Npc information</h3>
        <form action="{{ route('npc.create') }}" method="post">
            @csrf
            <div class="pt-4 pb-2 w-full max-w-md">
                <label for="name" class="block text-sm font-bold text-gray-900 mb-1">Npc Name<span
                    class="text-red-500">*</span></label>
                <input type="text" id="name" name="name"
                    class="w-full border border-gray-300 rounded-lg py-2 px-3 focus:outline-none text-gray-900"
                    value="{{ old('name') }}">
            </div>
<div class="w-full max-w-md py-2">
                    <label class="inline-block text-sm leading-5 font-medium text-gray-900 mb-1">Access Image</label><span
                        class="text-red-500">*</span>
                    <div class="bg-gray-100 p-8 text-center rounded-lg border-dashed border-2 border-gray-300 hover:border-blue-500 transition duration-300 ease-in-out transform hover:scale-105 hover:shadow-md"
                        id="dropzone">
                        <label for="fileInput" class="cursor-qtyer flex flex-col items-center space-y-2">
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
    <div class="pt-4 pb-2 w-full max-w-md">
                <label for="role" class="block text-sm font-bold text-gray-900 mb-1">Role<span
                    class="text-red-500">*</span></label>
                <select name="role" id="role"
                    class="w-full border border-gray-300 rounded-lg py-2 px-3 focus:outline-none text-gray-900">
                    <option value="" disabled selected>Select Role</option>
                    <option value="doctor" @if(old('role') == 'doctor') selected @endif>Doctor</option>
                    <option value="blacksmith" @if(old('role') == 'blacksmith') selected @endif>Blacksmith</option>
                    <option value="merchant" @if(old('role') == 'merchant') selected @endif>Merchant</option>
                    <option value="tailor" @if(old('role') == 'tailor') selected @endif> Tailor</option>
                    <option value="innkeeper" @if(old('role') == 'innkeeper') selected @endif>Innkeeper</option>
                    <option value="quest_giver" @if(old('role') == 'quest_giver') selected @endif>Quest Giver</option>
                </select>
            </div>
            <button type="submit"
                class="py-2 px-4 mt-2 rounded-lg bg-pink-400 hover:bg-pink-500 text-white duration-300">Create Npc</button>
        </form>
    </div>
</section>

<script>
    // JavaScript code for handling file input
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
