<?php
return [
    '/' =>
        [
            'controller' => 'UsersController',
            'action' => 'mainAction',
        ],
    '/essence' =>
        [
            'controller' => 'UsersController',
            'action' => 'essenceAction',
        ],
    '/users/' =>
        [
            'controller' => 'UsersController',
            'action' => 'getAction',
        ],
    '/users/create' =>
        [
            'controller' => 'UsersController',
            'action' => 'createAction',
        ],
    '/user/{id}/update' =>
        [
            'controller' => 'UsersController',
            'action' => 'updateAction',
        ],
    '/user/{id}/delete' =>
        [
            'controller' => 'UsersController',
            'action' => 'deleteAction',
        ],
    '/user/{id}/view' =>
        [
            'controller' => 'UsersController',
            'action' => 'userAction',
        ],
    //Статьи
    '/articles/' =>
        [
            'controller' => 'ArticlesController',
            'action' => 'getAction',
        ],
    '/articles/create/' =>
        [
            'controller' => 'ArticlesController',
            'action' => 'createAction',
        ],
    '/article/{id}/update/' =>
        [
            'controller' => 'ArticlesController',
            'action' => 'updateAction',
        ],
    '/article/{id}/delete/' =>
        [
            'controller' => 'ArticlesController',
            'action' => 'deleteAction',
        ],
    '/article/{id}/view/' =>
        [
            'controller' => 'ArticlesController',
            'action' => 'viewAction',
        ],
];