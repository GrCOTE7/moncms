<?php

use Illuminate\Support\Facades\Password;
use Livewire\Attributes\{Layout, Title};
use Livewire\Volt\Component;

new 
#[Layout('components.layouts.auth')] 
class extends Component {
    public string $email = '';

    public function sendPasswordResetLink(): void
    {
        $this->validate([
            'email' => ['required', 'string', 'email'],
        ]);

        $status = Password::sendResetLink($this->only('email'));

        if (Password::RESET_LINK_SENT != $status) {
            $this->addError('email', __($status));

            return;
        }

        $this->reset('email');

        session()->flash('status', __($status));
    }
}; ?>

@section('title', __('Password renewal'))
<div>
    <x-card class="flex items-center justify-center h-[96vh]" data-link='/' data-tip="{{  __('Return on site') }}" title="{{ __('Password renewal') }}" subtitle="{{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}" shadow separator progress-indicator id='my-title'>
        <x-session-status class="mb-4" :status="session('status')" />
        <x-form wire:submit="sendPasswordResetLink">
            <x-input label="{{ __('E-mail') }} *" wire:model="email" icon="o-envelope" inline required />
            <x-slot:actions>
                <x-button label="{{ __('Email Password Reset Link') }}" type="submit" icon="o-paper-airplane"
                    class="btn-primary" />
            </x-slot:actions>
        </x-form>
    </x-card>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const card = document.getElementById('my-title');
            const link = card.getAttribute('data-link');
            const tip = card.getAttribute('data-tip');
            const divs = card.getElementsByTagName('div');
            // console.log(divs)
            const titleElement = card.querySelector('title');
            if (divs.length >= 4) {
                const titleElement = divs[3]; // Cible le quatrième <div>
                titleElement.innerHTML = `<a href="${link}" title="${tip}">${titleElement.innerHTML}</a>`;
            }
        });
    </script>
</div>
