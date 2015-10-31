<?php
/**
 * Created by PhpStorm.
 * User: marek
 * Date: 07.09.15
 * Time: 12:43
 */

namespace spec\Madkom\Registries\Domain;

use Madkom\Registries\Domain\Car\Term\AC;
use Madkom\Registries\Domain\TermFactory;
use PhpSpec\ObjectBehavior;

/**
 * Class TermSpec
 *
 * @package spec\Madkom\Registries\Domain
 * @mixin \Madkom\Registries\Domain\Term
 */
class TermSpec extends ObjectBehavior
{
    private $termFactory;
    private $termDto;
    private $term;

    public function let()
    {
        $this->termFactory = new TermFactory();
        $this->termDto     = new \Madkom\Registries\Domain\TermDto();
    }

    public function it_is_initializable()
    {
        $this->prepareTerm();
        $this->term = $this->termFactory->create(AC::TYPE, $this->termDto);
    }

    private function prepareTerm()
    {
        $this->termDto->expiryDate   = new \DateTime();
        $this->termDto->notifyBefore = new \DateTime();
        $this->termDto->notifyBefore->sub(new \DateInterval('P14D'));

        $this->termDto->whoToNotify = new \Madkom\Registries\Domain\Department\DepartmentCollection();
        $this->termDto->whoToNotify->add(new \Madkom\Registries\Domain\Department\Department('Dział handlowy',
                                                                                             'diler@madkom.pl'
                                         )
        );
    }
}