<?php
/**
 * Created by PhpStorm.
 * User: marek
 * Date: 21.08.15
 * Time: 12:41
 */

namespace Madkom\Registries\Application\RestApi\Controllers\Position;

use Doctrine\ORM\EntityManager;
use Madkom\Registries\Application\RestApi\Controllers\ControllerHelper;
use Madkom\Registries\Domain\Car\CarDto;
use Madkom\Registries\Domain\Car\CarFactory;
use Madkom\Registries\Domain\Car\CarRegistry;
use Madkom\Registries\Domain\Department\DepartmentCollection;
use Madkom\Registries\Domain\EmptyRegistryException;
use Madkom\Registries\Domain\Position;
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

    /** @var  Position pozycja */
    private $position;

    /** @var  TermFactory Klasa fabryki dla terminów */
    private $termFactory;

    /** @var  ControllerHelper Zawiera instancję klasy ControllerHelper */
    private $helper;

    /** @var  mixed Typ rejestru */
    private $type;

    /**
     * @var EntityManager
     */
    private $entity;

    public function __construct()
    {
        $this->helper = new ControllerHelper();
    }


    public function newPosition(Application $app, Request $request, $registryId)
    {
        $this->entity = $app['orm.em'];
        $this->currentRegistry = $this->helper->findAndCheckRegistry($app, $registryId);

        $this->createPositionFactory($this->currentRegistry);
        $this->getPositionDto($request);
        $this->positionDto->registryId = $this->currentRegistry;
        $this->position = $this->positionFactory->create($this->positionDto);
        $this->addTermsToPostion($request);

        $this->currentRegistry->addPosition($this->position);

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
    private function getPositionDto(Request $request)
    {
        $getPos = json_decode($request->getContent());

        switch ($this->type) {
            case CarRegistry::TYPE_NAME:
                $this->positionDto->brand              = $getPos->brand; //$request->get('brand');
                $this->positionDto->model              = $getPos->model; //$request->get('model');
                $this->positionDto->others             = $getPos->others; //$request->get('others');
                $this->positionDto->registrationNumber = $getPos->registrationNumber; //$request->get('registrationNumber');
                break;
        }
    }

    private function addTermsToPostion(Request $request)
    {
        $getPos = json_decode($request->getContent());

        foreach($getPos->terms as $term)
        {
            $this->position->addTerm($this->newTerm($term->type, $term->date, $term->departments));
        }
    }

    private function newTerm($term, $expirationDate, $departmentId)
    {
        $registryPositionDto = new TermDto();
        $this->setNotifyDate($expirationDate, $registryPositionDto);

        foreach ($departmentId as $id) {
            $registryPositionDto->whoToNotify->add($this->entity->find('\Madkom\Registries\Domain\Department\Department', $id));
        }

        $createdTerm = $this->termFactory->create($term, $registryPositionDto);
        $this->entity->persist($createdTerm);

        return $createdTerm;
    }

    /**
     * @param $expirationDate
     * @param $registryPositionDto
     */
    private function setNotifyDate($expirationDate, $registryPositionDto)
    {
        $registryPositionDto->expiryDate      = new \DateTime($expirationDate);
        $registryPositionDto->notifyBefore    = new \DateTime($expirationDate);
        $registryPositionDto->notifyBefore->sub(new \DateInterval('P14D'));
        $registryPositionDto->whoToNotify     = new DepartmentCollection();
    }
}