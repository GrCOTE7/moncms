<?php

use App\Models\Post;
use App\Models\Comment;
use Livewire\Volt\Component;
use App\Repositories\PostRepository;
use Illuminate\Support\Facades\Mail;
use App\Notifications\CommentCreated;
use Illuminate\Notifications\Notifiable;
use Creativeorange\Gravatar\Facades\Gravatar;

new class extends Component {
    public Post $post;
    public $gravatar;
    public Comment $comment;

    public function mount()
    {
        $postRepository = new PostRepository();
        $this->post = $postRepository->getPostBySlug('post-1');

        $userEmail = env('MAIL_FROM_ADDRESS', 'uuu');
        $this->gravatar = Gravatar::get($userEmail);

        // var_dump($post);
        // dd($userEmail);

        //2do envoyer l'email d'un commentaire ici
        $this->comment = Comment::find(1);
        // $commentCreated = new CommentCreated($comment);
        // $mail = $commentCreated->toMail();
        // $mail->Mail::send();
    }

    // public function with(){
    //     $post = $this->post;
    // }
}; ?>

<div>
    <h1 class="text-xl font-bold text-center mb-1 mt-[-25px]">Page de Test</h1>
    <hr>
    <div class="w-full text-right flex justify-end">
        <x-avatar :image="$gravatar" class="!w-24 my-1 mr-2" />
    </div>
    {{-- {{ $gravatar }} --}}
    <hr>
    <livewire:simple_component />
    <hr class="my-1">
    Comments: {{ $post->validComments[0] }}
    <hr class="my-1">
    {{ $comment }}
</div>
