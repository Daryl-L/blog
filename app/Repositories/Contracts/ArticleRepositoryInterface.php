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

	/**
	 * Get the article and its detail by the sign in url.
	 * 
	 * @param string $sign
	 *
	 * @return App\Article
	 **/
	public function getArticleBySign($sign);
}