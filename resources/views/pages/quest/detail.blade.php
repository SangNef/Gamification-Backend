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
        <a href="/admin/quest-manage" class="text-pink-600">/ Quest manage</a>
        <p class="text-gray-400">/ Quest detail</p>
    </div>
    <h1 class="font-bold text-2xl leading-7 my-6">Quest Detail</h1>
    <div class="w-full bg-white rounded-lg shadow my-4 p-6">
        <h3 class="text-base leading-6 uppercase text-gray-400">Quest Information</h3>
        <div class="pt-4 pb-2 w-full max-w-md">
            <p class="inline-block text-sm leading-5 font-medium text-gray-900 mb-1">Quest Name:</p>
            <p>{{ $quest->name }}</p>
        </div>
        <div class="w-full max-w-md py-2">
            <p class="inline-block text-sm leading-5 font-medium text-gray-900 mb-1">Quest Type:</p>
            <p>{{ $quest->type }}</p>
        </div>
        <div class="pt-4 pb-2 w-full max-w-md">
            <p class="inline-block text-sm leading-5 font-medium text-gray-900 mb-1">Max Quest Completion:</p>
            <p>{{ $quest->max_completion }}</p>
        </div>
        <div class="pt-4 pb-2 w-full max-w-md">
            <p class="inline-block text-sm leading-5 font-medium text-gray-900 mb-1">Quest Point:</p>
            <p>{{ $quest->point }}</p>
        </div>
        <div class="pt-4 pb-2 w-full max-w-md">
            <p class="inline-block text-sm leading-5 font-medium text-gray-900 mb-1">Quest Exp:</p>
            <p>{{ $quest->exp }}</p>
        </div>
       <div class="pt-4 pb-2 w-full max-w-md">
    <p class="inline-block text-sm leading-5 font-medium text-gray-900 mb-1">Quest Content:</p>
    <p>{{ $quest->content->content }}</p>
</div>

    </div>
</section>
@endsection
