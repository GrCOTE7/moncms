<?php

use Livewire\Volt\Component;
use App\Models\{Comment, Post};
use Illuminate\Support\Facades\Mail;
use App\Notifications\CommentCreated;
use Livewire\Attributes\{Layout, Title};

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
