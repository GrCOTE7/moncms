@extends('components.layouts.ga')

@section('title', 'GA')

@php
    $routeName = request()->route()->getName();
@endphp
<style>
    p.red {
        color: red;
    }
</style>
@section('content')
    <p class="text-4xl font-bold">Users list</p>
    <hr class="my-3">

    <p @class(['text-color', 'red' => str_starts_with($routeName, 'ga')])>La route est {{ $routeName }}</p>
    
    {{-- @dump($users) --}}

    request()->all() :
    @dump(request()->all())

    request()->route()->getName() :
    @dump(request()->route()->getName())

    request()->route() :
    @dump(request()->route())

    request() :
    @dump(request())


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
