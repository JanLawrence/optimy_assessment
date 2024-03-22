<?php

require_once('utils/Define.php');
require_once('utils/Test.php');

use Utils\NewsManager;
use Utils\CommentManager;
use Utils\Test;

/**
 * Refactored old code to new (added to Test.php class view())
 * 
 */

// foreach(NewsManager::getInstance()->listNews() as $news ){
// 	echo("############ NEWS " . $news->title . " ############\n");
// 	echo($news->body . "\n");
// 	foreach($news->getComments() as $comment){
// 		echo("Comment " . $comment->id . " : " . $comment->body . "\n");
// 	}
// }


/**
 * Simple testing class to be called
 * 
 */

$test = new Test;
// $test->view();
// $test->addNewsTesting();
// $test->deleteNewsTesting(10);
// $test->addCommentTesting(11);
// $test->deleteCommentTesting(16);