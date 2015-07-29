<?php
/**
 * Created by PhpStorm.
 * User: marek
 * Date: 29.07.15
 * Time: 09:50
 */

namespace API\Controllers;

use Models\Users\UsersFactory;
use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class UsersController
{
    public function addUser(Application $app, Request $request)
    {
        $usersFactory = new UsersFactory();

        $rights = $request->get('rights');

        if($rights === UsersFactory::ADMIN || $rights === UsersFactory::USER)
        {
            $user = $usersFactory->create($request->get('login'), sha1($request->get('pass')), $request->get('email'), $rights);
            $app['repositories.users']->save($user);

            return new Response('OK', 201);
        }
        else
        {
            return new Response("Nie znaleziono modyfikatora dostepu '{$rights}'", 404);
        }
    }
}