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
    '/users' =>
        [
            'controller' => 'usersController',
            'action' => 'usersAction',
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
            'action' => 'deleteUser',
        ],
    '/user/{id}/view' =>
        [
            'controller' => 'usersController',
            'action' => 'userAction',
        ],
    //Статьи
    '/articles' =>
        [
            'controller' => 'articlesController',
            'action' => 'articlesAction',
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