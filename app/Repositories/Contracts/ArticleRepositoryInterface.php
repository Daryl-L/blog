<?php

namespace App\Repositories\Contracts;

Interface ArticleRepositoryInterface
{
	/**
	 * Get articles to list with the number of each page.
	 * 
	 * @param int $perPage
	 * 
	 * @return \Illuminate\Database\Eloquent\Collection
	 **/
	public function getArticlesByPage($perPage = 10);
}