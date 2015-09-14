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
use Madkom\Registries\Domain\Car\Term\Review;
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

/**
 * Class Create
 *
 * @package Madkom\Registries\Application\RestApi\Controllers\Position
 */
class Create
{
    /** @var  CarFactory $elementFactory Przechowuje fabrykę pozycji */
    private $elementFactory;

    /** @var  PositionFactory */
    private $positionFactory;

    /** @var  CarDto Składowe DTO pozycji */
    private $positionDto;

    /** @var  Registry Aktualnie wybrany rejestr */
    private $currentRegistry;

    /** @var  mixed Utworzona pozycja */
    private $position;

    /** @var  TermFactory Klasa fabryki dla terminów */
    private $termFactory;

    /** @var  ControllerHelper Zawiera instancję klasy ControllerHelper */
    private $helper;

    /** @var  mixed Typ rejestru */
    private $type;

    public function __construct()
    {
        $this->helper = new ControllerHelper();
    }

    /**
     * @param Application $app
     * @param Request     $request
     * @param             $id
     *
     * @return Response
     * @throws EmptyRegistryException
     * @throws \Madkom\Registries\Domain\PositionTypeNotAllowedException
     * @throws \Madkom\Registries\Domain\UnknownTermTypeException
     */
    public function newPosition(Application $app, Request $request, $id)
    {
        $this->currentRegistry = $this->helper->findAndCheckRegistry($app, $id);

        $this->createPositionFactory($this->currentRegistry);
        $this->getRequests($request);
        $this->positionDto->registryId = $this->currentRegistry;
        $this->position = $this->positionFactory->create($this->positionDto);

        $this->newTerm(AC::TYPE, $request->get('expiryDate'), $request->get('notify'));
        $this->newTerm(OC::TYPE, $request->get('expiryDate'), $request->get('notify'));
        $this->newTerm(Review::TYPE, $request->get('expiryDate'), $request->get('notify'));

        $this->currentRegistry->addPosition($this->position);


        $app['repositories.position']->prepareToSave($this->position);
        $app['repositories.registry']->save($this->currentRegistry);


        return new Response('OK', 201);
    }

    /**
     * @param Registry $registryType
     *
     * @throws EmptyRegistryException
     */
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

    /**
     * @param Request $request
     */
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

    /**
     * @param $term
     * @param $expirationDate
     * @param $notifyDaysInAdvance
     *
     * @throws \Madkom\Registries\Domain\UnknownTermTypeException
     */
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