<?php
/**
 * Created by PhpStorm.
 * User: marek
 * Date: 04.08.15
 * Time: 13:56
 */

namespace API\Controllers;

use Models\Elements\Car;
use Models\Factories\ElementFactory;
use Models\Registries\CarRegistry;
use Models\RegistryModel;
use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Models\DTO;

class ElementController
{
    public function addElement(Application $app, Request $request, $id)
    {
        /** @var RegistryModel $getRegistry */
        $getRegistry = $app['repositories.registry']->find($id);

        if ($getRegistry === null) {
            return new Response("Nie odnaleziono rejestru o id={$id}", 404);
        } else {
            $elementFactory = new ElementFactory();

            switch ($getRegistry->getType()) {
                case ElementFactory::CAR_ELEMENT:
                    $element = $elementFactory->create(
                        $getRegistry->getType(),
                        new DTO\CarElement(
                            $request->get('brand'),
                            $request->get('model'),
                            $request->get('registrationNumber'),
                            $request->get('insurer'),
                            $request->get('others'),
                            $request->get('attachments'),
                            $getRegistry
                        )
                    );

                    break;
                default:
                    return new Response("Nie można rozpoznać podanego typu '{$getRegistry->getType()}'.");
                break;
            }
            /** @var CarRegistry $getRegistry */
            $getRegistry->addCar($element);
            $app['repositories.element']->save($element);
            $app['repositories.registry']->save($getRegistry);

            return new Response('OK', 201);
        }
    }

    public function findAllElements(Application $app, $id)
    {
        /** @var RegistryModel $getRegistry */
        $getRegistry = $app['repositories.registry']->find($id);
        if ($getRegistry === null) {
            return new Response("Nie znaleziono rejestru o id={$id}", 404);
        }

        /** @var Car array $getElement */
        $getElement = $app['repositories.element']->findAll("Models\\Elements\\Car", $id);

        if (count($getElement) === 0) {
            return new Response('Rejestr jest pusty.', 404);
        }

        $tab = [];

        /**
         * @var  $i
         * @var  Car $element
         */
        foreach ($getElement as $i => $element) {
            $tab[$i] = $element->toArray();
        }


        /** Zwraca typ rejestru i tablice samochodów należących do niego */
        return $app->json([$getRegistry->toArray(), $tab], 200);
    }

    public function findElementById(Application $app, $id, $idElementu)
    {
        /** @var RegistryModel $getRegistry */
        $getRegistry = $app['repositories.registry']->find($id);
        if ($getRegistry === null) {
            return new Response("Nie znaleziono rejestru o id={$id}", 404);
        }

        // W przypadku, gdyby była potrzeba na wyświetlenie wielu elementów
        $idElementu = explode(',', $idElementu);

        $getElement = $app['repositories.element']->find("Models\\Elements\\Car", $id, $idElementu);
        $tab = [];

        /**
         * @var  $i
         * @var  Car $element
         */
        foreach ($getElement as $i => $element) {
            $tab[$i] = $element->toArray();
        }

        return $app->json($tab, 200);
    }

    public function modifyElement(Application $app, Request $request, $id, $idElementu)
    {
        /** @var RegistryModel $getRegistry */
        $getRegistry = $app['repositories.registry']->find($id);
        if ($getRegistry === null) {
            return new Response("Nie znaleziono rejestru o id={$id}", 404);
        }
        $getElement = $app['repositories.element']->find("Models\\Elements\\Car", $id, $idElementu);

        if (count($getElement) === 0) {
            return new Response('Rejestr jest pusty.', 404);
        }

        /**
         * @var integer $i
         * @var Car $element
         */
        foreach ($getElement as $i => $element) {
            $request->get('brand') === null || $request->get('brand') === '' ?:
                $element->setBrand($request->get('brand'));

            $request->get('model') === null || $request->get('model') === '' ?:
                $element->setModel($request->get('model'));

            $request->get('registrationNumber') === null || $request->get('registrationNumber') === '' ?:
                $element->setRegistrationNumber($request->get('registrationNumber'));

            $request->get('insurer') === null || $request->get('insurer') === '' ?:
                $element->setInsurer($request->get('insurer'));

            $request->get('others') === null || $request->get('others') === '' ?:
                $element->setOthers($request->get('others'));

            $request->get('attachments') === null || $request->get('attachments') === '' ?:
                $element->setAttachments($request->get('attachments'));
        }
        $app['repositories.element']->save($element);

        return new Response('OK', 200);
    }

    public function deleteElement(Application $app, $id, $idElementu)
    {
        /** @var RegistryModel $getRegistry */
        $getRegistry = $app['repositories.registry']->find($id);
        if ($getRegistry === null) {
            return new Response("Nie znaleziono rejestru o id={$id}", 404);
        }
        $idElementu = explode(',', $idElementu);

        $getElement = $app['repositories.element']->find("Models\\Elements\\Car", $id, $idElementu);

        if (count($getElement) === 0) {
            return new Response('Rejestr jest pusty.', 404);
        }
        /**
         * @var  $i
         * @var  Car $element
         */
        foreach ($getElement as $i => $element) {
            $app['repositories.element']->deleteOne($element);
        }

        return new Response('OK', 200);
    }
}
