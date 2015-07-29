<?php
/**
 * Created by PhpStorm.
 * User: PFIG
 * Date: 2015-07-28
 * Time: 21:44
 */

namespace API\Controllers;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class RegistryElementController
{
    public function addObject(Application $app, Request $request)
    {

        return new Response('OK', 201);
    }
}