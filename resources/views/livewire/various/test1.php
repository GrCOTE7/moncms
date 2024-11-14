<?php

/**
 * (ɔ) Mon CMS - 2024-2024
 */

use App\Models\{Comment, Post};
use App\Notifications\CommentCreated;
use Illuminate\Support\Facades\Mail;
use Livewire\Attributes\{Layout, Title};
use Livewire\Volt\Component;

new
#[Title('Test 1')]
#[Layout('components.layouts.test')]
class extends Component {
	public Post $post;
	public $gravatar;
	public Comment $comment;

	public function mount() {
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
};
