<?php
/**
 * To get the comments from the model comment as well as implement the interface.
 *
 * @version 1.0
 * @author daryl <daryl.moe@outlook.com>
 * @date 2017/4/8
 * @since 1.0 2017/4/8 daryl: Add $comment, construct(), addComment(), likeComment()
 **/

namespace App\Repositories;

use App\Comment;
use Carbon\Carbon;

class CommentRepository implements CommentRepositoryInterface
{
    /**
     * @var App\Comment
     **/
    protected $comment;

    public function __construct(Comment $comment)
    {
        $this->comment = $comment;
    }

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
    public function addComment($content, $email, $nickname, $site, $commentId, $articleId)
    {
        $res = $this->comment->insert([
            'content'    => $content,
            'email'      => $email,
            'nickname'   => $nickname,
            'site'       => $site,
            'comment_id' => $commentId,
            'aritcle_id' => $articleId,
            'created_at' => Carbon::now(),
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
    public function likeComment($id)
    {
        $res = $this->comment->where('id', $id)->increment();
        return $res;
    }
}