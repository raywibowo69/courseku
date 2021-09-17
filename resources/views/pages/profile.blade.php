@extends('layouts.app')

@section('title', 'Profile')

@section('content')
<section class="my-20 max-w-3xl mx-4 md:mx-auto h-4/6">
    <div class="flex flex-col md:flex-row">
        <div class="flex items-start">
            <div class="bg-gray-500 w-24 h-24 p-4 flex justify-center items-center mr-4 rounded-md">
                <h1 class="font-bold mb-1 text-white text-4xl">{{ Auth()->user()->name[0] }}</h1>
            </div>
            <div>
                <h3 class="text-gray-600 text-2xl font-semibold">{{ Auth()->user()->name }}</h3>
                <p class="mt-1 text-gray-500 text-sm">Member Since : {{ Auth()->user()->created_at->toFormattedDateString() }}</p>
            </div>

        </div>
        <div class="md:ml-auto">
            <div class="mt-2 md:mt-0">
                <div class="flex items-center">
                    <!-- <i class="fas fa-question-circle fa-sm"></i> -->
                    <i class="fas fa-star fa-sm text-yellow-400"></i>
                    <p class="ml-1 font-medium text-gray-600">Stars </p>
                    <div class="group cursor-pointer relative inline-block text-blue-600 text-center ml-2"><i class="fas fa-question-circle fa-sm"></i>
                        <div class="opacity-0 w-28 bg-gray-600 border border-gray-600 text-white text-center text-xs rounded-lg py-2 absolute z-10 group-hover:opacity-100 bottom-full -left-0 ml-1 px-3 pointer-events-none">
                            Get stars by submitting tutorials.
                        </div>
                    </div>
                </div>
                <div class="mt-1">
                    <p class="text-gray-500">0</p>
                </div>
                <!-- <a href="#!" class="mt-2 inline-block text-center border-2 text-gray-500 text-sm border-gray-500 rounded-md px-6 py-2">Follow</a> -->
            </div>
            <!-- <p class="text-gray-500 text-md font-semibold">{{-- '@'.Auth()->user()->username --}}</p> -->
        </div>
    </div>
    <div class="mt-4 " x-data="{active: 0}">
        <div class="flex bg-gray-50 overflow-hidden">
            <button class="px-4 py-2 border-b border-gray-200 text-gray-600 w-full" x-on:click.prevent="active = 0" x-bind:class="{'border-blue-600 ': active === 0}">Liked</button>
            <button class="px-4 py-2 border-b border-gray-200 text-gray-600 w-full" x-on:click.prevent="active = 1" x-bind:class="{'border-blue-600 ': active === 1}">Bookmarked</button>
            <button class="px-4 py-2 border-b border-gray-200 text-gray-600 w-full" x-on:click.prevent="active = 2" x-bind:class="{'border-blue-600': active === 2}">Submitted</button>
        </div>
        <div class="bg-gray-50 bg-opacity-10">
            <div class="p-4 bg-gray-50 space-y-2 h-40 overflow-auto" x-show.transition.in="active === 0">
                @if(count($votes) == 0) <div class="flex flex-col justify-center items-center">
                    <img src="img/like.png" alt="like" class="block">
                    <h1 class="mt-2 text-gray-600">No tutorials liked.</h1>
                </div>
                @endif
                @foreach ($votes as $vote)
                <div class="card">
                    @if ($vote->tutorial)
                    <a href="/course/{{ $vote->tutorial->slug }}" class="text-gray-600">{{ $vote->tutorial->name }}</a>
                    @endif
                </div>
                @endforeach
            </div>
            <div class="p-4 bg-gray-50 space-y-2 h-40 overflow-auto" x-show.transition.in="active === 1">
                @if(count($saves) == 0)
                <div class="flex flex-col justify-center items-center">
                    <img src="img/save.png" alt="save" class="block">
                    <h1 class="mt-2 text-gray-600">No tutorials bookmarked.</h1>
                </div>
                @endif

                @foreach ($saves as $save)
                <div class="card">
                    @if ($save->tutorials)
                    <a href="/course/{{ $save->tutorials->slug }}" class="text-gray-600"> {{ $save->tutorials->name  }}</a>
                    @endif
                </div>
                @endforeach
            </div>
            <div class="p-4 bg-gray-50 space-y-2 h-40 overflow-auto" x-show.transition.in="active === 2">
                @if (count($submits) == 0)
                <div class="flex flex-col justify-center items-center">
                    <img src="img/submitted.png" alt="submit" class="block">
                    <h1 class="mt-2 text-gray-600">You haven't sent the tutorial</h1>
                </div>
                @endif

                @foreach ($submits as $submit)
                <div class="card">
                    <div class="flex items-center justify-between space-x-4">
                        <a href="/course/{{ $submit->slug }}" class="text-gray-600"> {{ $submit->name  }}</a>
                        <div class="flex items-center">
                            @if ($submit->status == 'Draft')
                            <p class="bg-gray-200 text-gray-700 text-sm px-1 py-1 rounded-sm font-semibold">Under Review</p>
                            @elseif ($submit->status == 'Release')
                            <p class="bg-green-100 text-green-700 text-sm px-1 py-1 rounded-sm font-semibold">Approved</p>
                            @endif
                            <div x-data="{ dropdownOpen: false }" class="relative ml-auto">
                                <button @click="dropdownOpen = !dropdownOpen" class="relative z-10 block rounded-md bg-white p-2 focus:outline-none">
                                    <div class="flex justify-between items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z" />
                                        </svg>
                                    </div>
                                </button>
                                <div x-show="dropdownOpen" @click="dropdownOpen = false" class="fixed inset-0 h-full w-full z-10"></div>
                                <div x-show="dropdownOpen" class="absolute right-0 mt-2 py-2 w-48 bg-white rounded-md shadow-xl z-20">
                                    <a href="/course/{{ $submit->slug }}" class="block px-4 py-2 text-sm capitalize text-gray-700 hover:bg-blue-500 hover:text-white">
                                        <i class="fas fa-eye mr-1"></i> Visit Tutorial
                                    </a>

                                    <a href="/submit-tutorial" class="block text-left px-4 py-2 text-sm text-gray-700 hover:bg-blue-500 hover:text-white">
                                        <i class="fas fa-edit mr-1"></i> Edit
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

</section>
@endsection
