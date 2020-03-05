<?php

// src/Service/HelloService.php
namespace App\Service;

class HelloService
{

    public function hello($name)
    {
        return 'Hello, '.$name;
    }
}