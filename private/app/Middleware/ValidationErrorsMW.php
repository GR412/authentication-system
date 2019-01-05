<?php
/**
 * Created by PhpStorm.
 * User: Grant
 * Date: 09/10/2018
 * Time: 4:32 PM
 */

namespace App\Middleware;


class ValidationErrorsMW extends Middleware
{
    public function __invoke($request, $response, $next)
    {
        if (isset($_SESSION['validation_errors']))
        {
            $this->container->view->getEnvironment()->addGlobal('validation_errors', $_SESSION['validation_errors']);
            unset($_SESSION['validation_errors']);
        }

        $response = $next($request, $response);

        return $response;
    }
}