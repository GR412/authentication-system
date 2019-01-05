<?php

namespace App\Controllers;

class HomeController extends Controller
{
    public function index($request, $response)
    {
        return $this->container->view->render($response, 'homepage.html.twig', //returns a rendered view of the app's homepage
            [
                //'css_path' => CSS_PATH,
                'landing_page' => $_SERVER["SCRIPT_NAME"], //A link to the app's homepage, for faster navigation
                'register_form' => './register', //invokes the register code that is a get request to display the register form when the Sign Up button is pressed
                'login_form' => 'index.php/login', //invokes the login authentication code that is a get request to display the login form when the Login button is pressed
                'page_title' => 'Login App - Homepage', //sets the title of the displayed homepage
            ]);
    }
}