<?php

/**
 * (ɔ) Mon CMS - 2024-2024
 */

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\View\View;

class GaController extends Controller {
	public function index(): View {
		$users = [];
		$users = User::select(['name', 'email'])->paginate(2);

		return view('ga', compact('users'));
	}
}
