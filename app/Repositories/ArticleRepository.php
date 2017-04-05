<?php

namespace App\Repositories;

use App\Repositories\Contracts\ArticleRepositoryInterface;
use App\Article;

class ArticleRepository implements ArticleRepositoryInterface
{
	/**
	 * @var App\Article
	 **/
	protected $article;

	public function __construct(Article $article)
	{
		$this->article = $article;
	}

	/**
	 * Get articles to list with the number of each page.
	 * 
	 * @param int $perPage
	 * 
	 * @return \Illuminate\Database\Eloquent\Collection
	 **/
	public function getArticlesByPage($perPage = 10)
	{
		$articles = $this->article->orderBy('id', 'desc')->paginate($perPage);
		return $articles;
	}
}