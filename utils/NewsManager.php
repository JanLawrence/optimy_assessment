<?php
namespace Utils;

use Models\News;

class NewsManager
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
	* list all news
	*/
	public function listNews()
	{
		return News::getInstance()->get();
	}

	/**
	* add a record in news table
	*/
	public function addNews($data)
	{
		return News::getInstance()->create($data); // the create() also returns the newly created data as object
	}

	/**
	* deletes a news, and also linked comments
	*/
	public function deleteNews($id)
	{

		$news = News::getInstance()->find($id);

		$comments = $news->getComments(); // from class/News.php

		foreach($comments as $comment) {
			$comment->delete();
		}

		$news->delete();
	}
}