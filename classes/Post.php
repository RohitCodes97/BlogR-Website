<?php
class Post{
    private $postsFile = 'posts.json';
    private $posts;

    public function __construct(){
        // Load the posts from JSON on initialization
        $this->posts = $this->loadPosts();
    }
    
    // Load posts from JSON File
    private function loadPosts(){
        if(file_exists($this->postsFile)){
            $jsonData = file_get_contents($this->postsFile);
            return json_decode($jsonData, true)?:[];
        }
        return [];
    }

    // save posts to JSON File
    private function savePosts(){
        file_put_contents($this->postsFile, json_encode($this->posts, JSON_PRETTY_PRINT));
    }

    // Create a new post
    public function createPost($title, $content){
        // date_default_timezone_set("Asia/Kolkata");
        $newPost = [
            'id' => uniqid(),
            'title' => $title,
            'content' => $content,
            'author' => $_SESSION['username'],
            'date' => date('j-m-Y')
        ];
        $this->posts[] = $newPost;
        $this->savePosts();
        return $newPost;
    }

    // Read all Posts
    public function getPosts(){
        return $this->posts;
    }

    // Read a single post by ID
    public function getPostById($id){
        foreach($this->posts as $post){
            if($post['id'] == $id){
                return $post;
            }
        }
        return null;
    }

    // update a post by ID(only the author can update it)
    public function updatePost($id, $title, $content, $author){
        foreach($this->posts as &$post){
            if($post['id'] == $id && $post['author']==$author){
                $post['title'] = $title;
                $post['content'] = $content;
                $this->savePosts();
                return $post;
            }
        }
        return false;
    }

    // Delete a post by ID (only author can delete it)
    public function deletePost($id, $author){
        foreach($this->posts as $index=>$post){
            if($post['id'] == $id && $post['author']==$author){
                unset($this->posts[$index]);
                $this->savePosts();
                return true;
            }
        }
        return false;
    }
}

?>





