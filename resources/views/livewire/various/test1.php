<?php

/**
 * (ɔ) Mon CMS - 2024-2024
 */

use App\Models\{Comment, Post};
use App\Notifications\CommentCreated;
use Livewire\Attributes\{Layout, Title};
use Livewire\Volt\Component;

new
#[Title('Test 1')]
#[Layout('components.layouts.test')]
class extends Component {
	public Post $post;
	public Comment $comment;
	public $data;

	public function mount() {
		// var_dump($post);
		// dd($userEmail);

		// 2do envoyer l'email d'un commentaire (Exemple avec le 1er commentaire récupéré) ici
		$comment  = Comment::find(1);
		$post     = $comment->post;
		$user     = $comment->user->name;
		$res      = $post->user->notify(new CommentCreated($comment));

		$data['user']    = $user;
		$data['post']    = $post->title;
		$data['resNotif'] = $res;
		$this->data      = $data;

		// public function with(){
		//     $post = $this->post;
		// }
	}
};
