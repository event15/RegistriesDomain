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

    public function findUser(Application $app, Request $request)
    {
        /** @var Registry $getRegistry */
        $getRegistry = $app['repositories.users']->find($request->get('id'));

        return ($getRegistry === null) ?
            new Response("Nie znaleziono rejestru o id={$request->get('id')}", 404)
            :
            new Response(var_dump($getRegistry), 200);
    }
}