<?php
/**
 * Interaction DB
 * C'est ici qu'on vient foutre nos requêtes
 *
**/
namespace Blog\Service;

use Blog\Service\BlogService;

class BlogServiceImpl implements BlogService
{
    protected $postRepository;

    public function getPostRepository() {
        return $this->postRepository;
    }

    public function setPostRepository($postRepository) {
        $this->postRepository = $postRepository;
    }

    public function save(Post $post) {

    }

    public function fetchAll() {

    }

    public function fetch($page) {

    }

    /**
     * @return Post|null
    **/
    public function find($categoySlug, $postSlug) {

    }

    /**
     * @return Post|null
    **/
    public function findById($postId) {

    }

    public function update(Post $post) {

    }

    public function delete($postId) {

    }
}
