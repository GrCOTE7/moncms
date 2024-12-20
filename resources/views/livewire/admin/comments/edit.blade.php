<?php
use App\Models\Comment;
use Livewire\Attributes\{Layout};
use Livewire\Volt\Component;
use Mary\Traits\Toast;

new #[Layout('components.layouts.admin')] class extends Component {
	use Toast;

	public Comment $comment;
	public string $body        = '';
	public string $body_answer = '';
	public int $depth          = 0;

	public function mount(Comment $comment): void {
		$this->authorizeCommentAccess($comment);

		$this->comment = $comment;
		$this->fill($this->comment->toArray());
		$this->depth = $this->comment->getDepth();
	}

	public function save() {
		$data = $this->validate([
			'body' => 'required|max:10000',
		]);

		$this->comment->update($data);

		$this->success(__('Comment edited with success.'), redirectTo: '/admin/comments/index');
	}

	public function saveAnswer() {
		$data = $this->validate([
			'body_answer' => 'required|max:10000',
		]);

		$data['body']      = $data['body_answer'];
		$data['user_id']   = Auth::id();
		$data['parent_id'] = $this->comment->id;
		$data['post_id']   = $this->comment->post_id;

		Comment::create($data);

		$this->success(__('Answer created with success.'), redirectTo: '/admin/comments/index');
	}

	private function authorizeCommentAccess(Comment $comment): void {
		if (auth()->user()->isRedac() && $comment->post->user_id !== auth()->id()) {
			abort(403);
		}
	}
}; ?>

@section('title', __('Edit a comment'))
<div>
    <x-card>
        <x-form wire:submit="save">
            <x-textarea wire:model="body" label="{{ __('Content') }}" hint="{{ __('Max 10000 chars') }}" rows="5"
                inline />

            <x-slot:actions>
                <x-helpers.cancel-save-btns :lk="route('comments.index')" />
            </x-slot:actions>


        </x-form>

        @if ($depth < 3)
            <x-card title="{{ __('Your answer') }}" shadow separator progress-indicator>
                <x-form wire:submit="saveAnswer">
                    <x-editor wire:model="body_answer" label="{{ __('Content') }}" :config="config('tinymce.config_comment')" folder="photos" />
                    <x-slot:actions>
                        <x-helpers.cancel-save-btns :lk="route('comments.index')" />
                    </x-slot:actions>
                </x-form>
            </x-card>
        @endif
    </x-card>
    <x-helpers.progress-bar />
</div>
