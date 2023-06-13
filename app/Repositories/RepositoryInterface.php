<?php

namespace App\Repositories;


interface RepositoryInterface {
    
    public function create(array $data = []);
    public function all();
    public function findByID($id);
    public function update($id, $data = []);
    public function delete($id);
}



