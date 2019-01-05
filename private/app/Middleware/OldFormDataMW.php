<?php
/**
 * Created by PhpStorm.
 * User: Grant
 * Date: 09/10/2018
 * Time: 4:32 PM
 */

namespace App\Middleware;


class OldFormDataMW extends Middleware
{
    public function __invoke($request, $response, $next)
    {
       $this->container->view->getEnvironment()->addGlobal('old', $_SESSION['old']);
       $_SESSION['old'] = $request->getParams();

        $response = $next($request, $response);

        return $response;
    }


}