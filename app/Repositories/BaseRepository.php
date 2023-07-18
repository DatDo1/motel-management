<?php

namespace App\Repositories;


use App\Repositories\RepositoryInterface;
use Illuminate\Database\Eloquent\Model;

abstract class BaseRepository implements RepositoryInterface{
    protected $model;
    public function __construct()
    {
        $this->setModel();
    }

    abstract public function getModel();

    public function setModel()
    {
        $this->model = app()->make(
            $this->getModel()
        );
    }
    public function create(array $data = []){
        return $this->model->create($data);
    }
    public function all(){
        return $this->model->all();
    }
    public function findByID($id){
        return $this->model->findOrFail($id);
    }
    public function update($id, $data = []){
        $result = $this->model->findOrFail($id);
        if($result){
            $result->update($data);
            return $result;
        }
        return false;   
    }
    public function delete($id){
        $result = $this->model->find($id);
        if($result){
            $result->delete_flag == '1';
            $result->save();
            return true;
        }
        return false;
    }
}
