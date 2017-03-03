<?php

namespace Blog\Service;

interface BlogService
{
    public function save();

    public function fetchAll();

    public function fetch();

    public function find();

    public function findById();

    public function update();

    public function delete();
}
