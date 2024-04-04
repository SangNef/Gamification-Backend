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
        <p class="text-gray-400">/ Update Npc</p>
    </div>
    <h1 class="font-bold text-2xl leading-7 my-6">Update Npc</h1>
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
        <form action="{{ route('npc.update', $npc->id) }}" method="post">
            @csrf
            @method('PUT') <!-- Sử dụng phương thức PUT để cập nhật dữ liệu -->
            <div class="pt-4 pb-2 w-full max-w-md">
                <label for="name" class="block text-sm font-bold text-gray-900 mb-1">Npc Name<span
                    class="text-red-500">*</span></label>
                <input type="text" id="name" name="name"
                    class="w-full border border-gray-300 rounded-lg py-2 px-3 focus:outline-none text-gray-900"
                    value="{{ $npc->name }}"> <!-- Giá trị của trường name từ dữ liệu cũ của NPC -->
            </div>
            <div class="pt-4 pb-2 w-full max-w-md">
                <label for="access" class="block text-sm font-bold text-gray-900 mb-1">Access<span
                    class="text-red-500">*</span></label>
                <input type="text" id="access" name="access"
                    class="w-full border border-gray-300 rounded-lg py-2 px-3 focus:outline-none text-gray-900"
                    value="{{ $npc->access }}"> <!-- Giá trị của trường access từ dữ liệu cũ của NPC -->
            </div>
            <div class="pt-4 pb-2 w-full max-w-md">
                <label for="role" class="block text-sm font-bold text-gray-900 mb-1">Role<span
                    class="text-red-500">*</span></label>
                <select name="role" id="role"
                    class="w-full border border-gray-300 rounded-lg py-2 px-3 focus:outline-none text-gray-900">
                    <option value="" disabled>Select Role</option>
                    <option value="doctor" @if($npc->role == 'doctor') selected @endif>Doctor</option>
                    <option value="blacksmith" @if($npc->role == 'blacksmith') selected @endif>Blacksmith</option>
                    <option value="merchant" @if($npc->role == 'merchant') selected @endif>Merchant</option>
                    <option value="tailor" @if($npc->role == 'tailor') selected @endif> Tailor</option>
                    <option value="innkeeper" @if($npc->role == 'innkeeper') selected @endif>Innkeeper</option>
                    <option value="quest_giver" @if($npc->role == 'quest_giver') selected @endif>Quest Giver</option>
                </select>
            </div>
            <button type="submit"
                class="py-2 px-4 mt-2 rounded-lg bg-pink-400 hover:bg-pink-500 text-white duration-300">Update Npc</button>
        </form>
    </div>
</section>
@endsection
