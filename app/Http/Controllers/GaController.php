<?php

/**
 * (ɔ) Mon CMS - 2024-2024
 */

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;

class GaController extends Controller {
	public function index() {
		$users = User::paginate(2);
        return view('ga', compact('users'));
	}
}
