@extends('layouts.app')

@section('title', 'Top Contributor')

@section('content')

    <section class="my-20 max-w-3xl mx-4 md:mx-auto">
        <div class="bg-white shadow rounded-md">
            <div class="flex items-center p-4">
                <i class="fas fa-medal text-orange-300 mr-2 fa-md fa-lg"></i>
                <span class="font-bold block text-2xl ml-2 text-blue-600">
                    Top 5
                    Contributor</span>
            </div>
            <hr class="text-gray-300">
            <!-- Body 🍺 -->
            <div class="p-6 md:px-8 md:w-auto w-full">
                <table class="w-full border-collapse">
                    <thead>
                        <tr class="font-semibold text-left pb-1 text-blue-600">
                            <th>No</th>
                            <th>Nama</th>
                            <th>Points</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr class="text-gray-500">
                                <td class="py-4">{{ $loop->iteration }}.</td>
                                <td class="py-4">{{ $user->name }}</td>
                                <td class="py-4">{{ $user->points }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
@endsection
