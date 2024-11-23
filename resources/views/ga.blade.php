@extends('components.layouts.ga')

@section('title', 'GA')

<style>
    p.red {
        color: red;
    }
</style>
@section('content')
    <p class="text-4xl font-bold">Users list</p>
    <hr class="my-3">

    @include('route')

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
