<?php
/**
 * Created by PhpStorm.
 * User: marek
 * Date: 21.08.15
 * Time: 12:41
 */

namespace Madkom\Registries\Application\RestApi\Controllers\Position;

use Madkom\Registries\Application\RestApi\Controllers\ControllerHelper;
use Madkom\Registries\Domain\Car\CarDto;
use Madkom\Registries\Domain\Car\CarFactory;
use Madkom\Registries\Domain\Car\Term\AC;
use Madkom\Registries\Domain\Car\Term\OC;
use Madkom\Registries\Domain\Department\Department;
use Madkom\Registries\Domain\Department\DepartmentCollection;
use Madkom\Registries\Domain\PositionFactory;
use Madkom\Registries\Domain\TermDto;
use Madkom\Registries\Domain\TermFactory;
use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class Create
{
    private $currentRegistry;
    private $elementFactory;
    private $positionFactory;
    private $termFactory;
    private $helper;


    public function __construct()
    {
        $this->elementFactory  = new CarFactory();
        $this->positionFactory = new PositionFactory($this->elementFactory);
        $this->termFactory     = new TermFactory();
        $this->helper          = new ControllerHelper();
    }
    public function positionInRegistry(Application $app, Request $request, $id)
    {

    }
}