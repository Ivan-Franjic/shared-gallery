<?php

declare(strict_types=1);

namespace Core;

use App\Controller;

class Route
{
    public $routes = [
        'GET' => [],
        'POST' => []
    ];

    public function __construct()
    {
        $this->register('GET', '/', 'Pages@index');
        $this->register('GET', '400', 'Pages@invalidRequest');
        $this->register('GET', '404', 'Pages@notFound');
        $this->register('GET', '500', 'Pages@serverError');

        $this->register('GET', 'management', 'Management@management');
        $this->register('GET', 'management/album/{id}', 'Management@album');
        $this->register('POST', 'album/remove/{id}', 'Management@removeImg');
        $this->register('POST', 'upload', 'Management@addImg');
        $this->register('GET', 'test', 'Management@showimages');

        $this->register('GET', 'login', 'Pages@login');
        $this->register('GET', 'register', 'Pages@register');

        $this->register('POST', 'register/submit', 'Register@registerSubmit');
        $this->register('POST', 'login/submit', 'Login@loginSubmit');
        $this->register('GET', 'login/logoutSubmit', 'Login@logoutSubmit');

        $this->register('GET', 'myaccount', 'Myaccount@index');
        $this->register('GET','myaccount/edit/{id}','Myaccount@edit');
        $this->register('POST', 'myaccount/updatePasswordSubmit/{id}', 'Myaccount@updatePasswordSubmit');
        $this->register('POST', 'myaccount/removeSubmit/{id}', 'Myaccount@removeSubmit');
    }

    private function register(string $method = 'GET', string $url = '/', string $controller = 'Pages'): void
    {
        $this->routes[$method][$url] = $controller;
    }
}