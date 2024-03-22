<?php

namespace Models;

use Utils\DB;

class Comment extends DB
{
	/** 
	 *  table name
	 */
	protected $table = 'comment';

	/** 
	 *  table columns
	 */
	public $id, $body, $createdAt, $newsId;


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
}