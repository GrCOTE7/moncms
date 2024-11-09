<div>
    @php
        $userEmail = env('MAIL_FROM_ADDRESS', 'uuu');
        $gravatar = Gravatar::get($userEmail);
    @endphp

    <div class="border-2 border-gray-300/25 rounded-lg my-3 py-5">
        <div class="text-center text-2xl border-b-2 border-gray-300/15 pb-4">{{ __('Simple component') }}</div>
        <div class="flex justify-evenly items-center pt-4">
            <div>{{ __('A user') }}</div>
            <x-avatar :image="$gravatar" class="!w-24 my-1 mr-2" />
        </div>
    </div>
