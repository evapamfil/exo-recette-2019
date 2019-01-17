<?php
/**
 * Created by PhpStorm.
 * User: evapamfil
 * Date: 07/01/2019
 * Time: 19:22
 */

namespace App\Controllers\Contract;

use App\Models\Recipe;

interface RecipeInterface
{
    public function addRecipe($request, $response, $args);
    public function all($request, $response, $args);
    public function delete($request, $response, $args);
    public function update($request, $response, $args);
    public function getRecipe($id);
}