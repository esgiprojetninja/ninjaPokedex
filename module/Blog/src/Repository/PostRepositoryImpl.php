<?php
namespace Blog\Repository;

use Blog\Repository\PostRepository;
use Zend\Db\Adapter\AdapterAwareTrait;

interface PostRepositoryIml extends PostRepository
{
    use AdapterAwareTrait;
    
    public function save(Post $post);

    public function fetchAll();

    public function fetch($page);

    /**
     * @return Post|null
    **/
    public function find($categoySlug, $postSlug);

    /**
     * @return Post|null
    **/
    public function findById($postId);

    public function update(Post $post);

    public function delete($postId);
}
