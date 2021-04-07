<?php

return [
    'role_structure' => [
        'super_admin' => [
            'dashboard'  => 'c,r,u,d',
            'users'      => 'c,r,u,d',
            'categories' => 'c,r,u,d',
            'courses'    => 'c,r,u,d',
            'videos'     => 'c,r,u,d',
            'posts'      => 'c,r,u,d',
            'slides'     => 'c,r,u,d',
        ],
        'admin' => [],
        'user' => [],
    ],

    'permissions_map' => [
        'c' => 'create',
        'r' => 'read',
        'u' => 'update',
        'd' => 'delete'
    ]
];
