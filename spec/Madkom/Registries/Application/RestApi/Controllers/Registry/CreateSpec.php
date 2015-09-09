<?php
/**
 * Created by PhpStorm.
 * User: marek
 * Date: 09.09.15
 * Time: 11:21
 */

namespace spec\Madkom\Registries\Application\RestApi\Controllers\Registry;

use PhpSpec\ObjectBehavior;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Silex\Application;

/**
 * Class CreateSpec
 *
 * @package spec\Madkom\Registries\Application\RestApi\Controllers\Registry
 * @mixin \Madkom\Registries\Application\RestApi\Controllers\Registry\Create
 */
class CreateSpec extends ObjectBehavior
{
    private $app;
    private $validRequest;
    private $invalidType;
    private $invalidName;

    public function let()
    {
        require __DIR__ .'/../../../../../../../config/bootstrap.php';
        $this->app = $app;
        $this->validRequest = Request::create(
            '',
            'GET',
            [
                'type' => 'car',
                'name' => 'samochody']
        );
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType('Madkom\Registries\Application\RestApi\Controllers\Registry\Create');
    }

    public function it_create_registry_and_return_201_code_with_OK_message_when_all_data_is_valid()
    {
        $validResponse = new Response('OK', 201);
        $this->newRegistry($this->app, $this->validRequest)->shouldBeLike($validResponse);
    }

    public function it_should_throw_an_EmptyRegistryNameException()
    {
        $this->invalidName = Request::create(
            '',
            'GET',
            [
                'type' => 'car',
                'name' => '']
        );

        $this->shouldThrow('Madkom\Registries\Domain\EmptyRegistryNameException')
             ->during('newRegistry', [$this->app, $this->invalidName]);
    }

    public function it_should_throw_an_UnknownRegistryTypeException()
    {
        $this->invalidType = Request::create(
            '',
            'GET',
            [
                'type' => 'bad type',
                'name' => 'samochody']
        );

        $this->shouldThrow('Madkom\Registries\Domain\UnknownRegistryTypeException')
             ->during('newRegistry', [$this->app, $this->invalidType]);
    }

}