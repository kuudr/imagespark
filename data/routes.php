<?php
return [
    '/' =>
        [
            'controller' => 'usersController',
            'action' => 'mainAction',
        ],
    '/essence' =>
        [
            'controller' => 'usersController',
            'action' => 'essenceAction',
        ],
    '/users/' =>
        [
            'controller' => 'usersController',
            'action' => 'getAction',
        ],
    '/users/create' =>
        [
            'controller' => 'usersController',
            'action' => 'createAction',
        ],
    '/user/{id}/update' =>
        [
            'controller' => 'usersController',
            'action' => 'updateAction',
        ],
    '/user/{id}/delete' =>
        [
            'controller' => 'usersController',
            'action' => 'deleteAction',
        ],
    '/user/{id}/view' =>
        [
            'controller' => 'usersController',
            'action' => 'userAction',
        ],
    //Статьи
    '/articles/' =>
        [
            'controller' => 'articlesController',
            'action' => 'getAction',
        ],
    '/articles/create/' =>
        [
            'controller' => 'articlesController',
            'action' => 'createAction',
        ],
    '/article/{id}/update/' =>
        [
            'controller' => 'articlesController',
            'action' => 'updateAction',
        ],
    '/article/{id}/delete/' =>
        [
            'controller' => 'articlesController',
            'action' => 'deleteAction',
        ],
    '/article/{id}/view/' =>
        [
            'controller' => 'articlesController',
            'action' => 'viewAction',
        ],
];