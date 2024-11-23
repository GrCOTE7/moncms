@extends('components.layouts.ga')

@section('title', 'GA')

@section('content')
    <p class="text-4xl font-bold">Users list</p>
    <hr class="my-3">

    @dump($users)

    @forelse($users as $user)
        <div class="flex gap-2">
            <div>
                {{ $user->name }}
            </div>
            <div>
                <p><b>{{ $user->email }}</b></p>
            </div>
        </div>
        <hr class="my-3">
    @empty
        <p>No users found</p>
    @endforelse
    @if ($users)
        {{ $users->links() }}
    @endif
@endsection
