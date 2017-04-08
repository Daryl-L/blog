<?php
/**
 * The interface to get the articles from the model article.
 *
 * @version 1.0
 * @author daryl <daryl.moe@outlook.com>
 * @date 2017/4/8
 * @since 1.0 2017/4/8 daryl: Add addComment(), likeComment()
 **/

namespace App\Repositories\Contracts;

interface CommentRepositoryInterface
{
    /**
     * Add a new comment.
     *
     * @param string $content
     * @param string $email
     * @param string $nickname
     * @param string $site
     * @param int    $commentId
     * @param int    $articleId
     *
     * @return bool
     **/
    public function addComment($content, $email, $nickname, $site, $commentId, $articleId);

    /**
     * To increase the like column.
     *
     * @param int $id
     *
     * @return int
     **/
    public function likeComment($id);
}