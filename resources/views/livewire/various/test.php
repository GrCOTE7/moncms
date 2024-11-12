<?php

/**
 * (ɔ) Mon CMS - 2024-2024
 */

use App\Http\Tools\Fakers;
use Livewire\Attributes\{Layout, Title};
use Livewire\Volt\Component;

new
#[Layout('components.layouts.test')]
#[Title('Test')]
class extends Component {
	public $sentence;

	public function mount()
	{
		$faker                = new Fakers();
		$completeFakeSentence = "La belle-mère répondit n'avoir plus rien la liquidation était close, et il leur restait, outre Barneville, six cents livres de rente, Quoiqu'elle fût laide, sèche comme un cotret et bourgeonnée comme un printemps, certes madame Dubuc ne manquait pas de lui en procurer une autre plus commode. Le médecin, bien entendu, fit encore les frais de...";

		$this->cutSentence($completeFakeSentence, 200);
	}

	public function cutSentence($completeFakeSentence, $length)
	{
		$hyphens  = ['.', ';', '!', '...'];
		$position = $this->findLastHyphenPosition($completeFakeSentence, $length, $hyphens);

		$etc = ($position === $length) ? ' [...]' : '';
		echo "{$position} - {$length}";
		$wellCut = substr($completeFakeSentence, 0, $position) . $etc;

		$this->sentence = (object) [
			'complete' => $completeFakeSentence,
			'wellCut'  => $wellCut,
		];

		echo '<pre>';
		print_r($this->sentence);
		echo '</pre>';
	}

	private function findLastHyphenPosition($text, $length, $hyphens)
	{
		$positions = array_map(function ($hyphen) use ($text, $length) {
			return strrpos(substr($text, 0, $length), $hyphen);
		}, $hyphens);

		// Supprimer les valeurs false et obtenir la position maximale
		$positions = array_filter($positions, fn ($pos) => false !== $pos);

		return !empty($positions) ? max($positions) + 1 : $length;
	}
};
