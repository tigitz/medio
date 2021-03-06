<?php

/*
 * This file is part of the Medio project.
 *
 * (c) Loïc Chardonnet <loic.chardonnet@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace spec\Gnugat\Medio\Model\Phpdoc;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ApiTagSpec extends ObjectBehavior
{
    function it_can_have_a_since_version()
    {
        $this->beConstructedWith('v2.1');

        $this->getSince()->shouldBe('v2.1');
    }
}
