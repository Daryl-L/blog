<?php
/**
 * The interface to get the articles from the model article.
 *
 * @version 1.0
 * @author daryl <daryl.moe@outlook.com>
 * @date 2017/4/6
 * @since 1.0 2017/4/6 daryl: Add getArticlesByPage() and getArticleBySign()
 * @since 1.0 2017/4/8 daryl: Add getArticleById()
 */

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