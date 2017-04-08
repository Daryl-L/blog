<?php
/**
 * To get the articles from the model article as well as implement the interface.
 *
 * @version 1.0
 * @author daryl <daryl.moe@outlook.com>
 * @date 2017/4/6
 * @since 1.0 2017/4/6 daryl: Add getArticlesByPage() and getArticleBySign()
 * @since 1.0 2017/4/8 
          daryl: Add getArticleById(), addArticle(), deleteArticleById(), updateArticleById(),
                 likeArticle()
 **/

namespace App\Repositories;

use App\Repositories\Contracts\ArticleRepositoryInterface;
use App\Article;
use Carbon\Carbon;

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

    /**
     * Get the article and its detail by the sign in url.
     * 
     * @param string $sign
     *
     * @return App\Article
     **/
    public function getArticleBySign($sign)
    {
        $article = $this->article->where('sign', '=', $sign)->first();
        return $article;
    }

    /**
     * Get the article and its detail by id.
     *
     * @param int $id
     * 
     * @return App\Article
     */
    public function getArticleById($id)
    {
        $article = $this->article->findOrFail(1);
        return $article;
    }

    /**
     * Add a new article.
     *
     * @param string $sign
     * @param string $title
     * @param string $content
     **/
    public function addArticle($sign, $title, $content)
    {
        $res = $this->article->insert([
            'sign'       => $sign,
            'title'      => $title,
            'content'    => $content,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        return $res;
    }

    /**
     * Delete the article by its id.
     *
     * @param int $id
     *
     * @return int
     **/
    public function deleteArticleById($id)
    {
        $res = $this->article->where('id', $id)->delete();
        return $res;
    }

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
    public function updateArticleById($id, $sign, $title, $content)
    {
        $res = $this->article->where('id', $id)->update([
            'sign'       => $sign,
            'title'      => $title,
            'content'    => $content,
            'updated_at' => Carbon::now(),
        ]);

        return $res;
    }

    /**
     * To increase the like column.
     *
     * @param int $id
     *
     * @return int
     **/
    public function likeArticle($id)
    {
        $res = $this->article->where('id', $id)->increment('like');
        return $res;
    }
}