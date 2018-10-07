<?php

$router->get('/playlist', [App\Controller\PlaylistController::class, 'index']);
$router->get('/playlist/{id}', [App\Controller\PlaylistController::class, 'show']);
$router->post('/playlist', [App\Controller\PlaylistController::class, 'create']);
$router->put('/playlist/{id}', [App\Controller\PlaylistController::class, 'update']);
$router->delete('/playlist/{id}', [App\Controller\PlaylistController::class, 'delete']);

$router->get('/video', [App\Controller\VideoController::class, 'index']);
$router->get('/video/{id}', [App\Controller\VideoController::class, 'show']);
$router->put('/video/{id}', [App\Controller\VideoController::class, 'update']);
$router->delete('/video/{id}', [App\Controller\VideoController::class, 'delete']);

$router->get('/playlist/{playlist_id}/video', [App\Controller\PlaylistVideoController::class, 'index']);
$router->post('/playlist/{playlist_id}/video', [App\Controller\PlaylistVideoController::class, 'create']);