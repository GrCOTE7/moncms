<?php

use Livewire\Volt\Component;

new class extends Component {
	public $maVal = 789;
    public $name = 'oki';

	public function mount()
	{
		$this->maVal = 123;
		$this->name = 'GC7123';
	}
};
