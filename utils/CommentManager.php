<?php
namespace Utils;

use Models\Comment;

class CommentManager
{
	private static $instance = null;

	public static function getInstance()
	{
		if (null === self::$instance) {
			$c = __CLASS__;
			self::$instance = new $c;
		}
		return self::$instance;
	}

	/**
	 * List all comment
	 * 
	 */
	public function listAllComments()
	{
		return Comment::getInstance()->get();
	}

	/**
	 * List all comments of the news
	 * 
	 */
	public function listAllNewsComments($newsId)
	{
		return Comment::getInstance()->where('news_id', '=', $newsId)->get();
	}

	/**
	 * Create/Add comments for news
	 * 
	 */
	public function addCommentForNews($data)
	{
		return Comment::getInstance()->create($data);  // the create() also returns the newly created data as object
	}

	/**
	 * Delete comment by id
	 * 
	 */
	public function deleteComment($id)
	{
		$comment = Comment::getInstance()->find($id); 
		$comment->delete();
	}
}