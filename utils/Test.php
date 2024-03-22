<?php

namespace Utils;

class Test{

    /**
     * the refactored old code from index.php
     * 
     */
    public function view(){
        foreach(NewsManager::getInstance()->listNews() as $news ){
            echo("############ NEWS " . $news->title . " ############\n");
            echo($news->body . "\n");
            foreach($news->getComments() as $comment){
                echo("Comment " . $comment->id . " : " . $comment->body . "\n");
            }
        }
    }

    /**
     * test to add news
     * 
     */
    public function addNewsTesting(){
        NewsManager::getInstance()->addNews([
            'title' => 'New News',
            'body' => 'New News Body',
            'created_at' => date('Y-m-d'),
        ]);
        echo 'News added successfully';
    }
    
    /**
     * test to delete news
     * @param news $id
     */
    public function deleteNewsTesting($id){
        NewsManager::getInstance()->deleteNews($id);
        echo "News($id) deleted successfully";
    }

    /**
     * test to add a comment per news
     * @param news $id
     */
    public function addCommentTesting($newsId){
        CommentManager::getInstance()->addCommentForNews([
            'body' => 'New Comment Body',
            'created_at' => date('Y-m-d'),
            'news_id' => $newsId,
        ]);
        echo 'Comment added successfully';
    }

    /**
     * test to delete a comment
     * @param comment $id
     */
    public function deleteCommentTesting($id){
        CommentManager::getInstance()->deleteComment($id);
        echo "Comment($id) deleted successfully";
    }
}