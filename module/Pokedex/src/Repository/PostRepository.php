<?php
namespace Pokedex\Repository;

use Application\Repository\RepositoryInterface;
use Pokedex\Entity\Post;

interface PostRepository extends RepositoryInterface
{
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
