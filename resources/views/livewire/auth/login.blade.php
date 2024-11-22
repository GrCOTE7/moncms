<?php

use Livewire\Attributes\{Layout, Validate};
use Livewire\Volt\Component;

new
#[Layout('components.layouts.auth')]
class extends Component {
	#[Validate('required|email')]
	public string $email = '';

	#[Validate('required')]
	public string $password = '';

	public function login() {
		$credentials = $this->validate();

		if (auth()->attempt($credentials)) {
			request()->session()->regenerate();

			if (auth()->user()->isAdmin()) {
				return redirect()->intended('/admin/dashboard');
			}

			return redirect()->intended('/');
		}

		$this->addError('email', __('The provided credentials do not match our records.'));
	}
}; ?>

@section('title', __('Login'))
<div>
    <x-card class="flex items-center justify-center h-[96vh]">
        <a href="/" title="{{ __('Back to site') }}">
            <x-card class="items-center" title="{{ __('Login') }}" shadow separator progress-indicator />
        </a>
        <x-form wire:submit="login">
            <x-input label="{{ __('E-mail') }} *" wire:model="email" icon="o-envelope" type="email" inline />
            <x-input label="{{ __('Password') }} *" wire:model="password" type="password" icon="o-key" type="password"
                inline />
            <x-checkbox label="{{ __('Remember me') }}" wire:model="remember" />
            <p class="text-[12px] text-right italic my-[-10px]">* : {{ __('Required information') }}</p>
            <x-slot:actions>
                <div class="flex flex-col space-y-2 flex-end sm:flex-row sm:space-y-0 sm:space-x-2">
                    <x-button label="{{ __('Login') }}" type="submit" icon="o-paper-airplane"
                        class="ml-2 btn-primary sm:order-1" />
                    <div class="flex flex-col space-y-2 flex-end sm:flex-row sm:space-y-0 sm:space-x-2">
                        <x-button label="{{ __('Forgot your password?') }}" class="btn-ghost" link="/forgot-password" />
                        <x-button label="{{ __('Create an account') }}" class="btn-ghost" link="/register" />
                    </div>
                </div>
            </x-slot:actions>
        </x-form>
    </x-card>
</div>
