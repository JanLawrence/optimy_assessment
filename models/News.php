<?php
namespace Models;

use Utils\DB;

class News extends DB
{
	/** 
	 *  table name
	 */
	protected $table = 'news';

	/** 
	 *  table columns
	 */
	public $id, $title, $body, $createdAt;

	private static $instance = null;

    /** 
	 *  Initiate class
	 */
	public static function getInstance()
	{
		if (null === self::$instance) {
			$c = __CLASS__;
			self::$instance = new $c;
		}
		return self::$instance;
	}

	/** 
	 *  Get comments related to news
	 */

	public function getComments()
	{
		$comment = new Comment();
		return $this->hasChildren($comment, 'id', 'news_id');
	}
}