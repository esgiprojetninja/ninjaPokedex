<?php

namespace Blog\Repository;

use Blog\Entity\Post;
use Application\Repository\RepositoryInterface;

interface PostRepository extends RepositoryInterface
{
    public function save(Post $post);

    public function fetchAll();

    public function fetch($page);

    public function find($categorySlug, $postSlug);

    public function findById($postId);

    public function update(Post $post);

    public function delete($postId);
}
