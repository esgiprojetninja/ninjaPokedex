<?php

namespace Blog\Service;

use Blog\Service\BlogService;
use Blog\Entity\Post;

class BlogServiceImpl implements BlogService
{
    protected $PostRepository;

    public function save(Post $post)
    {
        return $this->PostRepository->save($post);
    }

    public function fetchAll()
    {
        return $this->PostRepository->fetchAll();
    }

    public function fetch($page)
    {
        return $this->PostRepository->fetch($page);
    }

    public function find($categorySlug, $postSlug)
    {
        return $this->PostRepository->find($categorySlugn, $postSlug);
    }

    public function findById($pageId)
    {
        return $this->PostRepository->findById($pageId);
    }

    public function update(Post $post)
    {
        return $this->PostRepository->update($post);
    }

    public function delete($postId)
    {
        return $this->PostRepository->delete($postId);
    }

    /**
    * Get the value of Post Repository
    *
    * @return mixed
    */
    public function getPostRepository()
    {
        return $this->PostRepository;
    }

    /**
    * Set the value of Post Repository
    *
    * @param mixed PostRepository
    *
    * @return self
    */
    public function setPostRepository($PostRepository)
    {
        $this->PostRepository = $PostRepository;

        return $this;
    }

}
