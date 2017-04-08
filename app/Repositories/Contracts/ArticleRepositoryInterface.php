<?php
/**
 * The interface to get the articles from the model article.
 *
 * @version 1.0
 * @author daryl <daryl.moe@outlook.com>
 * @date 2017/4/6
 * @since 1.0 2017/4/6 daryl: Add getArticlesByPage() and getArticleBySign()
 * @since 1.0 2017/4/8 
          daryl: Add getArticleById(), addArticle(), deleteArticleById(), updateArticleById(),
          likeArticle()
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

    /**
     * Get the article and its detail by id.
     *
     * @param int $id
     * 
     * @return App\Article
     **/
    public function getArticleById($id);

    /**
     * Add a new article.
     *
     * @param string $sign
     * @param string $title
     * @param string $content
     *
     * @return bool
     **/
    public function addArticle($sign, $title, $content);

    /**
     * Delete the article by its id.
     *
     * @param int $id
     *
     * @return int
     **/
    public function deleteArticleById($id);

    /**
     * Update the article by id.
     *
     * @param int    $id
     * @param string $sign
     * @param string $title
     * @param string $content
     *
     * @return int
     **/
    public function updateArticleById($id, $sign, $title, $content);

    /**
     * To increase the like column.
     *
     * @param int $id
     *
     * @return int
     **/
    public function likeArticle($id);
}