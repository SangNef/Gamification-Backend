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
            <a href="/admin/event-manage" class="text-pink-600">/ Event Manage</a>
            <p class="text-gray-400">/ Create Event </p>
        </div>
        <h class="font-bold text-2xl leading-7 my-6">Create Event</h>
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
            <h3 class="text-base leading-6 uppercase text-gray-400">Manage information</h3>
            <form action="{{ route('event.create') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="grid md:grid-cols-1 lg:grid-cols-3">
                    <div>
                        <div class="pt-4 pb-2 w-full max-w-md">
                            <label for="title"
                                class="inline-block text-sm leading-5 font-medium text-gray-900 mb-1">Event
                                title</label><span class="text-red-500">*</span>
                            <input type="text" id="title" name="title"
                                class="w-full border border-gray-300 rounded-lg py-2 px-3 focus:outline-none text-gray-900"
                                placeholder="Event title">
                        </div>

                        <div class="w-full max-w-md py-2">
                            <label class="inline-block text-sm leading-5 font-medium text-gray-900 mb-1"
                                for="start">Start</label><span class="text-red-500">*</span>
                            <input type="datetime-local" name="start" id="start"
                                class="w-full border border-gray-300 rounded-lg py-2 px-3 focus:outline-none text-gray-900">
                        </div>
                        <div class="w-full max-w-md py-2">
                            <label class="inline-block text-sm leading-5 font-medium text-gray-900 mb-1"
                                for="end">End</label><span class="text-red-500">*</span>
                            <input type="datetime-local" name="end" id="end"
                                class="w-full border border-gray-300 rounded-lg py-2 px-3 focus:outline-none text-gray-900">
                        </div>

                    </div>

                    <div class="max-w-md">
                        <label class="inline-block text-sm leading-5 font-medium text-gray-900 mb-1">Event
                            Image</label><span class="text-red-500">*</span>
                        <div class="bg-gray-100 p-8 text-center rounded-lg border-dashed border-2 border-gray-300 hover:border-blue-500 transition duration-300 ease-in-out transform hover:scale-105 hover:shadow-md"
                            id="dropzone">
                            <label for="fileInput" class="cursor-pointer flex flex-col items-center space-y-2">
                                <svg class="w-16 h-16 text-gray-400" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                                <span class="text-gray-600">Drag and drop your files here</span>
                                <span class="text-gray-500 text-sm">(or click to select)</span>
                            </label>
                            <input type="file" id="fileInput" name="banner" class="hidden" multiple>
                        </div>
                        <div class="mt-6 text-center" id="fileList"></div>
                    </div>
                </div>
                <div class="my-6" id="sub-event">
                    <span class="text-base leading-6 uppercase text-gray-400 mt-2">Event sub contents</span>
                    <span id="add-sub-content"
                        class="py-2 px-4 mt-2 ml-4 rounded-lg bg-pink-400 hover:bg-pink-500 text-white duration-300 text-sm cursor-pointer">Add
                        sub content</span>
                    <div class="max-w-md">
                        <div>
                            <div class="pt-4 pb-2 w-full max-w-md">
                                <label for="sub_title_1"
                                    class="inline-block text-sm leading-5 font-medium text-gray-900 mb-1">
                                    Sub title</label><span class="text-red-500">*</span>
                                <input type="text" id="sub_title_1" name="sub_title_1"
                                    class="w-full border border-gray-300 rounded-lg py-2 px-3 focus:outline-none text-gray-900"
                                    placeholder="Sub title">
                            </div>
                            <div class="pt-4 pb-2 w-full max-w-md">
                                <label for="sub_content_1"
                                    class="inline-block text-sm leading-5 font-medium text-gray-900 mb-1">
                                    Sub content</label><span class="text-red-500">*</span>
                                <textarea cols="3" type="text" id="sub_content_1" name="sub_content_1"
                                    class="w-full border border-gray-300 rounded-lg py-2 px-3 focus:outline-none text-gray-900"
                                    placeholder="Sub content">
                        </textarea>
                            </div>
                        </div>

                    </div>

                </div>
                <div class="my-6" id="event-item">
                    <span class="text-base leading-6 uppercase text-gray-400 mt-2">Event items</span>
                    <div class="grid lg:grid-cols-3 py-4">
                        <div class="max-w-md">
                            <input type="text" class="w-full py-2 px-3 border-b border-gray-300 focus:outline-none"
                                placeholder="Search items">
                        </div>
                        <div id="selected-items"></div>
                    </div>

                </div>
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
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const addButton = document.getElementById('add-sub-content');
            const subEventContainer = document.getElementById('sub-event');
            let subContentCount = 2;

            addButton.addEventListener('click', function() {
                const subContentDiv = document.createElement('div');
                subContentDiv.classList.add('max-w-md');
                const subTitleLabel = document.createElement('label');
                subTitleLabel.setAttribute('for', 'sub_title_' + subContentCount);
                subTitleLabel.textContent = 'Sub title';
                subTitleLabel.classList.add('block', 'text-sm', 'leading-5', 'font-medium',
                    'text-gray-900', 'mb-1');

                const subTitleInput = document.createElement('input');
                subTitleInput.type = 'text';
                subTitleInput.name = 'sub_title_' + subContentCount;
                subTitleInput.id = 'sub_title_' + subContentCount;
                subTitleInput.classList.add('w-full', 'border', 'border-gray-300', 'rounded-lg', 'py-2',
                    'px-3', 'focus:outline-none', 'text-gray-900');
                subTitleInput.placeholder = 'Sub title';

                subContentDiv.appendChild(subTitleLabel);
                subContentDiv.appendChild(subTitleInput);

                const subContentLabel = document.createElement('label');
                subContentLabel.setAttribute('for', 'sub_content_' + subContentCount);
                subContentLabel.textContent = 'Sub content';
                subContentLabel.classList.add('block', 'text-sm', 'leading-5', 'font-medium',
                    'text-gray-900', 'mb-1');

                const subContentTextarea = document.createElement('textarea');
                subContentTextarea.cols = '3';
                subContentTextarea.name = 'sub_content_' + subContentCount;
                subContentTextarea.id = 'sub_content_' + subContentCount;
                subContentTextarea.classList.add('w-full', 'border', 'border-gray-300', 'rounded-lg',
                    'py-2', 'px-3', 'focus:outline-none', 'text-gray-900');
                subContentTextarea.placeholder = 'Sub content';

                subContentDiv.appendChild(subContentLabel);
                subContentDiv.appendChild(subContentTextarea);

                subEventContainer.appendChild(subContentDiv);

                subContentCount++;
            });
        });
    </script>

@endsection
