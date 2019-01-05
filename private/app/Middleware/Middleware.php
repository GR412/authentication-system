<?php
/**
 * Created by PhpStorm.
 * User: Grant
 * Date: 09/10/2018
 * Time: 4:29 PM
 */

namespace App\Middleware;

class Middleware
{
    protected $container;

    public function __construct($container)
    {
        $this->container = $container;
    }
}