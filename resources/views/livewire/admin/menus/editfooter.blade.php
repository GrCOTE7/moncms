<?php
use Mary\Traits\Toast;
use App\Models\Footer;
use Livewire\Volt\Component;
use Illuminate\Validation\Rule;
use Livewire\Attributes\{Layout, Title};

new #[Layout('components.layouts.admin')] 
class extends Component {
    use Toast;
    
    public Footer $footer;
    public string $label = '';
    public string $link  = '';
    
    public function mount(Footer $footer): void {
        $this->footer = $footer;
        $this->fill($this->footer);
    }
    
    public function save(): void {
        $data = $this->validate([
            'label' => ['required', 'string', 'max:255', Rule::unique('footers')->ignore($this->footer->id)],
            'link'  => 'regex:/\/([a-z0-9_-]\/*)*[a-z0-9_-]*/',
        ]);
    
        $this->footer->update($data);
    
        $this->success(__('Footer updated with success.'), redirectTo: '/admin/footers/index');
  }
}; ?>

  @section('title', __('Edit a footer'))
  <div>
    <x-helpers.header-lk title="{{ __('Edit a footer') }}" />
    <x-card>
        <x-form wire:submit="save">
            <x-input label="{{ __('Title') }}" wire:model="label" />
            <x-input type="text" wire:model="link" label="{{ __('Link') }}" />
            <x-slot:actions>
                <x-button label="{{ __('Save') }}" icon="o-paper-airplane" spinner="save" type="submit"
                    class="btn-primary" />
            </x-slot:actions>
        </x-form>
    </x-card>
</div>
