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
// $test->deleteNewsTesting(12);
// $test->addCommentTesting(13);
// $test->deleteCommentTesting(17);


/**
 * You can also call manager class here by simply using the use keyword
 * use Manager\NewsManager;
 * use Manager\CommentManager;
 */