@extends('layout')
@section('content')
    <section class="bg-gray-200 min-h-screen w-full pl-6 sm:pl-[88px] pr-6 overflow-hidden font-inter">
        <div class="h-4 flex items-center gap-1 my-2">
            <a href="/admin/dashboard" class="text-pink-400">
                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V9z" />
                    <polyline points="9 22 9 12 15 12 15 22" />
                </svg>
            </a>
            <p class="text-gray-400 mt-3">/ Chest manage</p>
        </div>
        <h1 class="font-bold text-2xl leading-7 my-6">Chest manage</h1>
        @if (session('success'))
            <div class="bg-green-500 text-white p-4 mb-4 rounded">
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="bg-red-500 text-white p-4 mb-4 rounded">
                {{ session('error') }}
            </div>
        @endif
        <div class="mt-4">
            <a href="{{ route('chest.create') }}" class="bg-pink-400 text-white py-2 px-4 rounded no-underline">Add New Chest</a>
        </div>
        <div class="w-full bg-white rounded-lg shadow my-4 p-6">
            <h2 class="text-xl leading-7 font-bold">Chest list</h2>
            <table class="w-full border-gray-300">
                <thead>
                    <tr class="bg-gray-200 text-xs leading-4 font-medium tracking-wider uppercase text-gray-500">
                        <th class="p-2 border-b text-start">Stt</th>
                        <th class="p-2 border-b text-start">Name</th>
                        <th class="p-2 border-b text-start">Type</th>
                        <th class="p-2 border-b text-start">Point</th>
                        <th class="p-2 border-b text-start">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($chests as $index => $chest)
                        <tr
                            class="hover:bg-gray-100 even:bg-gray-200 duration-150 text-sm leading-5 font-normal text-gray-500">
                            <td class="p-2 border-b">{{ $index + 1 }}</td>
                            <td class="p-2 border-b">{{ $chest->name }}</td>
                            <td class="p-2 border-b">{{ $chest->type }}</td>
                            <td class="p-2 border-b">{{ $chest->point }}</td>
                            <td class="p-2 border-b text-start">
                                <a href="{{ route('chest.detail', $chest->id) }}" class="text-blue-500"><i
                                        class="fa-regular fa-eye"></i></a>
                                <a href="{{ route('chest.update', $chest->id) }}" class="text-yellow-500 ml-2"><i
                                        class="fa-regular fa-pen-to-square"></i></a>
                                <!-- Modify your delete button code -->
                                <form action="{{ route('chest.delete', $chest->id) }}" method="POST" class="inline"
                                    id="deleteForm{{ $chest->id }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="text-red-500 ml-2 deleteButton"
                                        data-chestname="{{ $chest->name }}"><i
                                            class="fa-regular fa-trash-can"></i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="w-full bg-white rounded-lg shadow my-4 p-6">
            <h2 class="text-xl leading-7 font-bold">Inventories</h2>
            <table class="w-full border-gray-300">
                <thead>
                    <tr class="bg-gray-200 text-xs leading-4 font-medium tracking-wider uppercase text-gray-500">
                        <th class="p-2 border-b text-start">Id</th>
                        <th class="p-2 border-b text-start">User</th>
                        <th class="p-2 border-b text-start">Chest</th>
                        <th class="p-2 border-b text-start">Status</th>
                        <th class="p-2 border-b text-start">Claim at</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($inventories as $item)
                        <tr
                            class="hover:bg-gray-100 even:bg-gray-200 duration-150 text-sm leading-5 font-normal text-gray-500">
                            <td class="p-2 border-b">{{ $item->id }}</td>
                            <td class="p-2 border-b">{{ $item->user_name }}</td>
                            <td class="p-2 border-b">{{ $item->chest_name }}</td>
                            <td class="p-2 border-b">
                                @if ($item->status === 1)
                                    <p class="inline-block my-auto px-[10px] py-[2px] bg-green-100 text-green-800 rounded-xl">Not opened</p>
                                @else
                                    <p class="inline-block my-auto px-[10px] py-[2px] bg-red-100 text-red-800 rounded-xl">Opened</p>
                                @endif
                            </td>
                            <td class="p-2 border-b">{{ $item->formatted_created_at }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <nav class="mt-4">
                <ul class="pagination justify-content-center">
                    {{ $inventories->onEachSide(2)->appends(Request::query())->links() }}
                </ul>
            </nav>
        </div>
    </section>
    <!-- Add the following CDN links in your HTML file -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Add the following script at the end of your view or in your layout file -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Get all elements with the class 'deleteButton'
            var deleteButtons = document.querySelectorAll('.deleteButton');

            // Attach click event to each delete button
            deleteButtons.forEach(function(button) {
                button.addEventListener('click', function() {
                    // Get the chest name from the data-chestname attribute
                    var chestName = button.getAttribute('data-chestname');

                    // Display SweetAlert2 confirmation popup
                    Swal.fire({
                        title: 'Are you sure?',
                        text: 'Do you want to delete ' + chestName + ' chest?',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                        // If user clicks 'Yes', submit the form
                        if (result.isConfirmed) {
                            var formId = button.parentElement.id;
                            document.getElementById(formId).submit();
                        }
                    });
                });
            });
        });
    </script>
@endsection
