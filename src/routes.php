<?php

use Slim\Http\Request;
use Slim\Http\Response;

// Routes
$app->get('/recipe/{id}', '\App\Controllers\RecipeController:getRecipe');
$app->get('/recipe', '\App\Controllers\RecipeController:all');
$app->post('/recipe', '\App\Controllers\RecipeController:addRecipe');
$app->delete('/recipe/{id}', '\App\Controllers\RecipeController:delete');
$app->put('/recipe/{id}', '\App\Controllers\RecipeController:update');

