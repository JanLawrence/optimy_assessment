<?php

require_once('utils/Define.php');
require_once('utils/Test.php');

use Utils\Test;

/**
 * Simple testing class to be called
 * 
 */

$test = new Test;
$test->view();
// $test->addNewsTesting();
// $test->deleteNewsTesting(10);
// $test->addCommentTesting(11);
// $test->deleteCommentTesting(16);



/**
 * You can also call manager class here by simply using the use keyword
 * use Utils\NewsManager;
 * use Utils\CommentManager;
 */