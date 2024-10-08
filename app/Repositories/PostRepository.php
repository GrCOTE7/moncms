<?php

/**
 * (ɔ) Mon CMS - 2024-2024
 */

namespace App\Repositories;

use App\Models\{Category, Post};
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;

class PostRepository
{
	public function getPostBySlug(string $slug): Post
	{
		return Post::with('user:id,name', 'category')->whereSlug($slug)->firstOrFail();
	}

	public function getPostsPaginate(?Category $category): LengthAwarePaginator
	{
		$query = $this->getBaseQuery()->orderBy('pinned', 'desc')->latest();

		if ($category) {
			$query->whereBelongsTo($category);
		}

		return $query->paginate(config('app.pagination'));
	}

	public function search(string $search): LengthAwarePaginator
	{
		return $this->getBaseQuery()
			->latest()
			->where(function ($query) use ($search) {
				$query->where('title', 'like', "%{$search}%")
					->orWhere('body', 'like', "%{$search}%");
			})
			->paginate(config('app.pagination'));
	}

	protected function getBaseQuery(): Builder
	{
		$specificReqs = [
			'mysql'  => "LEFT(body, LOCATE(' ', body, 700))",
			'sqlite' => 'substr(body, 1, 700)',
			'pgsql'  => 'substring(body from 1 for 700)',
		];

		$usedDbSystem = env('DB_CONNECTION', 'mysql');

		if (!isset($specificReqs[$usedDbSystem])) {
			throw new \Exception("Base de données non supportée: {$usedDbSystem}");
		}

		$adaptedReq = $specificReqs[$usedDbSystem];

		return Post::select('id', 'slug', 'image', 'title', 'user_id', 'category_id', 'created_at', 'pinned')
			->selectRaw(
				"CASE
                    WHEN LENGTH(body) <= 300 THEN body
                    ELSE {$adaptedReq}
                END AS excerpt",
			)
			->with('user:id,name', 'category')
			->whereActive(true);
	}
}
