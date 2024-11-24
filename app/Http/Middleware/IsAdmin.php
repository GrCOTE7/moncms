<?php

/**
 * (ɔ) Mon CMS - 2024-2024
 */

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin {
	/**
	 * Handle an incoming request.
	 *
	 * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
	 */
	public function handle(Request $request, \Closure $next): Response {

        $requestId = (string) Str::uuid();
		Log::info(['info request-id' => $requestId]);

		Log::withContext(['request-id' => $requestId]);
		Log::info('IsAdmin', [
			'isAdminOrRedac ?' => auth()->user()->isAdminOrRedac(),
			'isAdmin ?'        => auth()->user()->isAdmin(),
			'request'          => $request,
		]);
		if (!auth()->user()->isAdmin()) {
			abort(403);
		}

		return $next($request);
	}
}
