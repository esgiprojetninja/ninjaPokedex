<?php
/**
 * Interaction DB
 * C'est ici qu'on vient foutre nos requêtes
 *
**/
namespace Pokedex\Service;

use Pokedex\Service\PokedexService;
use Pokedex\Entity\Post;

class PokedexServiceImpl implements PokedexService
{
    protected $postRepository;

    public function getPostRepository() {
        return $this->postRepository;
    }

    public function setPostRepository($postRepository) {
        $this->postRepository = $postRepository;
    }

    public function save(Post $post) {
        $this->postRepository->save($post);
    }

    public function fetchAll() {
        return $this->postRepository->fetchAll();
    }

    public function fetch($page) {
        return $this->postRepository->fetch($page);
    }

    /**
     * @return Post|null
    **/
    public function find($categoySlug, $postSlug) {
        return $this->postRepository->find($categoySlug, $postSlug);
    }

    /**
     * @return Post|null
    **/
    public function findById($postId) {
        return $this->postRepository->findById($postId);
    }

    public function update(Post $post) {
        return $this->postRepository->update($post);
    }

    public function delete($postId) {
        return $this->postRepository->delete($postId);
    }
}
