<?php
use App\Models\Submenu;
use App\Traits\ManageMenus;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;
use Mary\Traits\Toast;

new #[Layout('components.layouts.admin')]
class extends Component {
	use Toast, ManageMenus;

	public Submenu $submenu;
	public string $sublabel = '';
	public string $sublink  = '';
	public int $subPost     = 0;
	public int $subPage     = 0;
	public int $subCategory = 0;
	public int $subOption   = 4;

	public function mount(Submenu $submenu): void {
		$this->submenu  = $submenu;
		$this->sublabel = $submenu->label;
		$this->sublink  = $submenu->link;
		$this->search();
	}

	public function saveSubmenu($menu = null): void {
		$data = $this->validate([
			'sublabel' => ['required', 'string', 'max:255'],
			'sublink'  => 'required|regex:/\/([a-z0-9_-]\/*)*[a-z0-9_-]*/',
		]);

		$this->submenu->update([
			'label' => $data['sublabel'],
			'link'  => $data['sublink'],
		]);

		$this->success(__('Menu updated with success.'), redirectTo: '/admin/menus/index');
	}
}; ?>

@section('title', __('Edit a submenu'))
  <div>
    <x-card>
        @include('livewire.admin.menus.submenu-form')
    </x-card>
</div>
