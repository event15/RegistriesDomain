<?php

namespace spec\Madkom\RegistryApplication\Domain\Insurer;

use PhpSpec\ObjectBehavior;

/**
 * Class InsurerSpec.
 *
 * @mixin \Madkom\RegistryApplication\Domain\Insurer\Insurer
 */
class InsurerSpec extends ObjectBehavior
{
    public function let()
    {
        $this->beConstructedWith('123-123-123', 'PZU', 'admin@madkom.pl', '+48 500 200 400');
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType('Madkom\RegistryApplication\Domain\Insurer\Insurer');
    }

    public function it_is_possible_to_change_company_name()
    {
        $this->changeCompany('Nowa nazwa ubezpieczyciela');
        $this->changeEmail('oki');
        $this->changeMobile('oki');
    }
}
