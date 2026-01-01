@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <h2 class="text-2xl font-bold mb-4">Dashboard</h2>
                
                <p>Welcome back, <span class="font-bold text-indigo-600">{{ Auth::user()->name }}</span>!</p>
                <div class="mt-4">
                    <p class="text-gray-600">You are logged in as <span class="capitalize font-semibold">{{ Auth::user()->role }}</span>.</p>
                </div>

                <div class="mt-6 flex gap-4">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-button class="bg-red-600 hover:bg-red-700">
                            {{ __('Log Out') }}
                        </x-button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
