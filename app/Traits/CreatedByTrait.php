<?php

namespace App\Traits;

trait CreatedByTrait
{

    public function save(array $options = []){
        $this->created_by = auth()->user()->id;

        return parent::save($options);
    }
}