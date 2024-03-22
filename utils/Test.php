<?php

namespace Utils;


class Test{

    public function view(){
        foreach(NewsManager::getInstance()->listNews() as $news ){
            echo("############ NEWS " . $news->title . " ############\n");
            echo($news->body . "\n");
            foreach($news->getComments() as $comment){
                echo("Comment " . $comment->id . " : " . $comment->body . "\n");
            }
        }
    }

    public function addNewsTesting(){
        NewsManager::getInstance()->addNews([
            'title' => 'New News',
            'body' => 'New News Body',
            'created_at' => date('Y-m-d'),
        ]);
        echo 'News added successfully';
    }
    
    public function deleteNewsTesting($id){
        NewsManager::getInstance()->deleteNews($id);
        echo "News($id) deleted successfully";
    }

    public function addCommentTesting($newsId){
        CommentManager::getInstance()->addCommentForNews([
            'body' => 'New Comment Body',
            'created_at' => date('Y-m-d'),
            'news_id' => $newsId,
        ]);
        echo 'Comment added successfully';
    }

    public function deleteCommentTesting($id){
        CommentManager::getInstance()->deleteComment($id);
        echo "Comment($id) deleted successfully";
    }
}