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
		$faker                 = new Fakers();
		$completeFakeSentence = "La belle-mère répondit n'avoir plus rien; la liquidation était close, et il leur restait, outre Barneville, six cents livres de rente. Quoiqu'elle fût laide, sèche comme un cotret, et bourgeonnée comme un printemps, certes madame Dubuc ne manquait pas de lui en procurer une autre plus commode. Le médecin, bien entendu, fit encore les frais de.";

		$hyphens = ['.', ';', '!', '...'];

        $this->cutSentence($completeFakeSentence,200);

		// $wellCut        = $this->sentence;ntence;

		// $this->sentence = (object) [
		// 	'complete' => $completeFakeSentence,
		// 	'wellCut'  => $wellCut,
		// ];

		// echo '<pre class="w-24">';
		// print_r(
		// 	$this->sentences
		// );
		// echo '</pre>';

		// var_dump($post);
		// dd($userEmail);
	}

	public function cutSentence($completeFakeSentence, $length)
	{
		$positionPoint        = strrpos(substr($completeFakeSentence, 0, $length), '.');
		$positionPointVirgule = strrpos(substr($completeFakeSentence, 0, $length), ';');
		$positionPointExcla   = strrpos(substr($completeFakeSentence, 0, $length), '!');
		$positionPointTrois   = strrpos(substr($completeFakeSentence, 0, $length), '...');

		$etc = '[...]';

		try {
			$position = max($positionPoint, $positionPointVirgule, $positionPointExcla, $positionPointTrois);
			++$position;
			$etc = '';
		} catch (Exception $e) {
			$position = $length;
		}

		$wellCut = substr($completeFakeSentence, 0, $position) . $etc;

		try {
			$this->sentence = json_decode(json_encode([
				'complete' => $completeFakeSentence,
				'wellCut'  => $wellCut,
			]));
			if (!is_object($this->sentence)) {
				throw new Exception('Conversion en objet a échoué.');
			}
		} catch (Exception $e) {
			echo 'Error: ' . $e->getMessage() . "\n";
			$this->sentence = (object) [
				'complete' => $completeFakeSentence,
				'wellCut'  => $wellCut,
			];
		}

		// public function with(){
		//     $post = $this->post;
		// }
	}
};
