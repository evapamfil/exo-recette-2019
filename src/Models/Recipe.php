<?php
/**
 * Created by PhpStorm.
 * User: evapamfil
 * Date: 07/01/2019
 * Time: 19:20
 */

namespace App\Models;

class Recipe
{
    public $name;
    public $description;


    public function getName()
    {
        return $this->name;
    }
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }
}