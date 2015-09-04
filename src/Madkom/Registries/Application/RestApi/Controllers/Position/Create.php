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
use Madkom\Registries\Domain\Car\CarRegistry;
use Madkom\Registries\Domain\Car\Term\AC;
use Madkom\Registries\Domain\Car\Term\OC;
use Madkom\Registries\Domain\Department\Department;
use Madkom\Registries\Domain\Department\DepartmentCollection;
use Madkom\Registries\Domain\EmptyRegistryException;
use Madkom\Registries\Domain\PositionFactory;
use Madkom\Registries\Domain\Registry;
use Madkom\Registries\Domain\TermDto;
use Madkom\Registries\Domain\TermFactory;
use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class Create
{
    private $elementFactory;
    private $positionFactory;
    private $positionDto;
    private $currentRegistry;
    private $position;
    private $termFactory;
    private $helper;
    private $type;


    public function __construct()
    {
        $this->helper = new ControllerHelper();
    }

    public function newPosition(Application $app, Request $request, $id)
    {
        $this->currentRegistry = $this->helper->findAndCheckRegistry($app, $id);

        $this->createPositionFactory($this->currentRegistry);
        $this->getRequests($request);
        $this->positionDto->registryId = $this->currentRegistry;
        $this->position = $this->positionFactory->create($this->positionDto);

        $this->newTerm(AC::TYPE, $request->get('expiryDate'), $request->get('notify'));
        $this->newTerm(OC::TYPE, $request->get('expiryDate'), $request->get('notify'));

        $this->currentRegistry->addPos($this->position);


        $app['repositories.position']->prepareToSave($this->position);
        $app['repositories.registry']->save($this->currentRegistry);


        return new Response('OK', 201);
    }

    private function createPositionFactory(Registry $registryType)
    {
        $type = $registryType->getRegistryType();

        switch ($type) {
            case CarRegistry::TYPE_NAME:
                $this->elementFactory  = new CarFactory();
                $this->positionDto     = new CarDto();
                $this->termFactory     = new TermFactory();
                break;
            default:
                throw new EmptyRegistryException('Błąd!');
        }

        $this->positionFactory = new PositionFactory($this->elementFactory);
        $this->type            = $type;
    }

    private function getRequests(Request $request)
    {
        switch ($this->type) {
            case CarRegistry::TYPE_NAME:
                $this->positionDto->brand              = $request->get('brand');
                $this->positionDto->model              = $request->get('model');
                $this->positionDto->others             = $request->get('others');
                $this->positionDto->registrationNumber = $request->get('registrationNumber');
                break;
        }
    }

    private function newTerm($term, $expirationDate, $notifyDaysInAdvance)
    {
        $registryPositionDto = new TermDto();

        $registryPositionDto->expiryDate   = new \DateTime($expirationDate);
        $registryPositionDto->notifyBefore = new \DateTime($expirationDate);
        $registryPositionDto->notifyBefore->sub(new \DateInterval('P' . $notifyDaysInAdvance . 'D'));

        $registryPositionDto->whoToNotify  = new DepartmentCollection();
        $registryPositionDto->whoToNotify->add(new Department('dział handlowy', 'nie@podam.pl'));

        $createdTerm = $this->termFactory->create($term, $registryPositionDto);
        $this->position->addTerm($createdTerm);
    }
}