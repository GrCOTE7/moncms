<?php

/**
 * (ɔ) Mon CMS - 2024-2024
 */

use App\Http\Tools\Fakers;
use Livewire\Attributes\{Layout};
use Livewire\Volt\Component;

new
#[Layout('components.layouts.test')]
class extends Component {
	public $sentence;
	private $faker;

	public function mount() {
		$this->faker = new Fakers();
		// À noter: Cette classe utilise un autre outil: TimeFcts()->getLocale() qui extrait le APP_LOCALE de votre .env
		// Essayer d'y mettre 'de', 'es', 'it', 'nl', ou 'ru'... Tout en regardant: http://127.0.0.1:8000/test
		$completeFakeSentence = $this->completeFixedOrRealSentence(); // 1 param.: 0 ou rien pour avoir fake || Autre valeur pour avoir fixe
		$this->sentence       = $this->faker->cutSentence($completeFakeSentence);
	}

	private function completeFixedOrRealSentence($fixedSentence = 0): string {
		// Cas le + fréquent en 1er
		return !$fixedSentence ? $this->faker->fakerSentence()->complete : "La belle-mère répondit n'avoir plus rien de la liquidation qui était close, et qu'il leur restait, outre Belleville, six cents livres de rente. Quoiqu'elle fût laide, sèche comme un cotret. et bourgeonnée comme un printemps, certes madame Martin ne manquait pas de lui en procurer une autre plus riche commode. Le médecin, bien entendu, fit encore les frais de...";
	}
};
