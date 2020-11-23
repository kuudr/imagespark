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
            'action' => 'createUser',
        ],
    '/user/{id}/update' =>
        [
            'controller' => 'usersController',
            'action' => 'updateUser',
        ],
    '/user/{id}/delete' =>
        [
            'controller' => 'usersController',
            'action' => 'deleteUser',
        ],
    '/user/{id}/view' =>
        [
            'controller' => 'usersController',
            'action' => 'viewUser',
        ],
];