<?php

namespace App\Controllers;
use PDO;
use Slim\Http\Request;
use Slim\Http\Response;

use App\Controllers\Contract\RecipeInterface;
use App\Models\Recipe;

class RecipeController implements RecipeInterface
{
    protected $pdo;

    protected $container;

    public function __construct($container)
    {
        $this->container = $container;
    }


    public function addRecipe($request, $response, $args)
    {
        $body = $request->getParsedBody();
        if (!isset($body['name'], $body['description'])) {
            return $response->withStatus(404);
        }
        $recipe = $this->container->get('db')->prepare(
            "INSERT INTO recipes (name, description) VALUES (:recipe, :description)"
        );
        $recipe->execute([
            'recipe' => $body['name'],
            'description' => $body['description']
        ]);

        $recipe = $this->getRecipe($this->container->get('db')->lastInsertId());
        return $response->withStatus(200);
    }


    public function getRecipe($id)
    {
        $recipe = $this->container->get('db')->prepare(
            "SELECT * FROM recipes WHERE id = :id"
        );
        $recipe->execute(['id' => $id]);
        return $recipe->fetchObject();
    }


    public function all($request, $response, $args)
    {
        $getRecipe = $this->container->get('db')->prepare('SELECT * FROM recipes');
        $getRecipe->setFetchMode(PDO::FETCH_CLASS, Recipe::class);
        $getRecipe->execute();

        $recipes = $getRecipe->fetchAll();

        return $response->withStatus(200)->withJson($recipes);
    }

    public function delete($request, $response, $args)
    {
        $recipe = $this->container->get('db')->prepare(
            "DELETE FROM recipes WHERE id = :id"
        );
        $recipe->execute(['id' => $args['id']]);

        return $response->withStatus(200);
    }

    public function update($request, $response, $args)
    {
        $body = $request->getParsedBody();
        $recipe = $this->container->get('db')->prepare(
            "UPDATE recipes SET name = :name , description = :description WHERE id = :id"
        );
        $recipe->execute([
            'name' => $body['name'],
            'description' => $body['description'],
            'id' => $args['id']
        ]);
        $recipe = $this->getRecipe($args['id']);

        return $response->withStatus(200)->withJson($recipe);
    }

}
