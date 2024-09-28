<?php

/**
 * (ɔ) Mon CMS - 2024-2024
 */

if (!function_exists('generateRandomDateInRange')) {
	function generateRandomDateInRange($startDate, $endDate)
	{
		$start = Carbon\Carbon::parse($startDate);
		$end   = Carbon\Carbon::parse($endDate);

		$difference = $end->timestamp - $start->timestamp;

		$randomSeconds = rand(0, $difference);

		return $start->copy()->addSeconds($randomSeconds);
	}

	if (!function_exists('replaceAbsoluteUrlsWithRelative')) {
		function replaceAbsoluteUrlsWithRelative(string $content)
		{
			$baseUrl = url('/');

			if ('/' !== substr($baseUrl, -1)) {
				$baseUrl .= '/';
			}

			$pattern     = '/<img\s+[^>]*src="(?:https?:\/\/)?' . preg_quote(parse_url($baseUrl, PHP_URL_HOST), '/') . '\/([^"]+)"/i';
			$replacement = '<img src="/$1"';

			return preg_replace($pattern, $replacement, $content);
		}
	}
}
