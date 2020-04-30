<?php
global $Routes;

$Routes->match([ 'get', 'post' ], 'users/{page_id?}', 'UsersController@read' )
->where([ 'page_id' => '[0-9]+' ]);

$Routes->match([ 'get', 'post' ], 'users/create', 'UsersController@create' );
$Routes->match([ 'get', 'post' ], 'users/profile', 'UsersController@profile' );
$Routes->match([ 'get', 'post' ], 'users/delete/{id}', 'UsersController@delete' );
$Routes->match([ 'get', 'post' ], 'users/edit/{id}', 'UsersController@update' );

$Routes->match([ 'get', 'post' ], 'groups', 'GroupsController@read' );
$Routes->match([ 'get', 'post' ], 'groups/create', 'GroupsController@create' );
$Routes->match([ 'get', 'post' ], 'groups/edit/{id}', 'GroupsController@update' );
$Routes->match([ 'get', 'post' ], 'groups/delete/{id}', 'GroupsController@delete' );