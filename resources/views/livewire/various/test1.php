<?php

use App\Http\Tools\Fakers;
use App\Models\{Comment, Post};
use App\Notifications\CommentCreated;
use Illuminate\Support\Facades\Mail;
use Livewire\Attributes\{Layout, Title};
use Livewire\Volt\Component;

new
#[Layout('components.layouts.test')]
#[Title('Test')]
class extends Component {
	public Post $post;
	public $gravatar;
	public Comment $comment;
	public $sentences;

	public function mount()
	{
		$faker           = new Fakers();
		$this->sentences = $faker->completeFakeSentences();

		// var_dump($post);
		// dd($userEmail);

		// 2do envoyer l'email d'un commentaire ici
		// $this->comment = Comment::find(1);
		// $commentCreated = new CommentCreated($comment);
		// $mail = $commentCreated->toMail();
		// $mail->Mail::send();
	}

	// public function with(){
	//     $post = $this->post;
	// }
}; ?>

<div class="h-[90vh]">
  <a href="/" title="{{ __('Return on site') }}">
    <x-header class="text-lg m-0" title="Page de Test" shadow separator progress-indicator />
  </a>

  <p class="text-xl mb-5">Phrase coupée:
    <br>{{ $sentences->wellCut }}
  </p>
  <p class="text-xl mb-5">Phrase originelle complète :<br>
    {{ $sentences->complete }}</p>
  <livewire:divers.simple_component />
</div>
