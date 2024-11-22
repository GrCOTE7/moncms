@extends('components.layouts.ga')

@section('title', 'GA')

@section('content')
    <p class="text-4xl font-bold">Oki 4</p>
    <hr class="my-3">
    @forelse($users as $user)
        <div class="flex gap-2">
            <div>
                {{ $user->name }}
            </div>
            <div>
                <p>{{ $user->email }}</p>
            </div>
        </div>
        <hr class="my-3">
    @empty
        <p>No users found</p>
    @endforelse
    {{ $users->links() }}
@endsection
