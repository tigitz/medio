<?php

/*
 * This file is part of the Medio project.
 *
 * (c) Loïc Chardonnet <loic.chardonnet@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace spec\Gnugat\Medio\PrettyPrinter;

use Gnugat\Medio\Model\Phpdoc\LicensePhpdoc;
use PhpSpec\ObjectBehavior;
use Twig_Environment;

class PhpdocPrettyPrinterSpec extends ObjectBehavior
{
    function let(Twig_Environment $twig)
    {
        $this->beConstructedWith($twig);
    }

    function it_is_a_pretty_printer_strategy()
    {
        $this->shouldImplement('Gnugat\\Medio\\PrettyPrinter\\PrettyPrinterStrategy');
    }

    function it_supports_phpdocs()
    {
        $licensePhpdoc = new LicensePhpdoc('Medio', 'author','author@example.com');

        $this->supports($licensePhpdoc, array())->shouldBe(true);
    }

    function it_generates_code_using_phpdoc_templates(Twig_Environment $twig)
    {
        $licensePhpdoc = new LicensePhpdoc('Medio', 'author','author@example.com');

        $twig->render('phpdoc/license_phpdoc.twig', array('license_phpdoc' => $licensePhpdoc))->shouldBeCalled();

        $this->generateCode($licensePhpdoc);
    }
}
