<?php

/*
 * This file is part of the Medio project.
 *
 * (c) Loïc Chardonnet <loic.chardonnet@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace spec\Gnugat\Medio\Validator;

use Gnugat\Medio\Validator\ViolationCollection;
use Gnugat\Medio\Validator\Violation\NoneViolation;
use Gnugat\Medio\Validator\Violation\SomeViolation;
use PhpSpec\ObjectBehavior;

class ViolationCollectionSpec extends ObjectBehavior
{
    const FIRST_MESSAGE = 'Model is invalid';
    const SECOND_MESSAGE = 'Model is wrong';

    function it_raises_exception_if_it_has_any_violations(SomeViolation $someViolation, SomeViolation $someOtherViolation)
    {
        $someViolation->getMessage()->willReturn(self::FIRST_MESSAGE);
        $someOtherViolation->getMessage()->willReturn(self::SECOND_MESSAGE);

        $this->add($someViolation);
        $this->add($someOtherViolation);

        $invalidModelException = 'Gnugat\Medio\Exception\InvalidModelException';
        $this->shouldThrow($invalidModelException)->duringRaise();
    }

    function it_does_not_raise_exception_if_it_has_no_violations()
    {
        $this->raise();
    }

    function it_ignores_none_violations(NoneViolation $noneViolation)
    {
        $this->add($noneViolation);

        $this->raise();
    }

    function it_can_be_merged_with_other_collections(
        SomeViolation $someViolation,
        ViolationCollection $violationCollection
    )
    {
        $someViolation->getMessage()->willReturn(self::FIRST_MESSAGE);

        $this->add($someViolation);
        $this->merge($violationCollection);

        $invalidModelException = 'Gnugat\Medio\Exception\InvalidModelException';
        $this->shouldThrow($invalidModelException)->duringRaise();
    }
}
