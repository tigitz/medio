<?php

/*
 * This file is part of the Medio project.
 *
 * (c) Loïc Chardonnet <loic.chardonnet@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gnugat\Medio\Examples;

use Gnugat\Medio\Model\Argument;
use Gnugat\Medio\Model\Constant;
use Gnugat\Medio\Model\File;
use Gnugat\Medio\Model\FullyQualifiedName;
use Gnugat\Medio\Model\Method;
use Gnugat\Medio\Model\Object;
use Gnugat\Medio\Model\Phpdoc\LicensePhpdoc;
use Gnugat\Medio\Model\Property;

class FileTest extends PrettyPrinterTestCase
{
    const FILENAME = '/tmp/medio/src/Gnugat/Medio/MyClass.php';
    const FULLY_QUALIFIED_NAME = 'Gnugat\\Medio\\MyClass';

    const PROJECT_NAME = 'gnugat/medio';
    const AUTHOR_NAME = 'Loïc Chardonnet';
    const AUTHOR_EMAIL = 'loic.chardonnet@gmail.com';

    public function testEmpty()
    {
        $file = File::make(self::FILENAME)
            ->setStructure(new Object(self::FULLY_QUALIFIED_NAME))
        ;

        $generatedCode = $this->prettyPrinter->generateCode($file);

        $this->assertExpectedCode($generatedCode);
    }

    public function testWithLicense()
    {
        $file = File::make(self::FILENAME)
            ->setLicensePhpdoc(new LicensePhpdoc(self::PROJECT_NAME, self::AUTHOR_NAME, self::AUTHOR_EMAIL))

            ->setStructure(new Object(self::FULLY_QUALIFIED_NAME))
        ;

        $generatedCode = $this->prettyPrinter->generateCode($file);

        $this->assertExpectedCode($generatedCode);
    }

    public function testFull()
    {
        $file = File::make(self::FILENAME)
            ->addFullyQualifiedName(new FullyQualifiedName('DateTime'))

            ->setStructure(Object::make(self::FULLY_QUALIFIED_NAME)
                ->addConstant(new Constant('FIRST_CONSTANT', '0'))
                ->addConstant(new Constant('SECOND_CONSTANT', "'meh'"))

                ->addProperty(new Property('firstProperty'))
                ->addProperty(new Property('secondProperty'))

                ->addMethod(Method::make('firstMethod')
                    ->addArgument(new Argument('DateTime', 'firstArgument'))
                    ->addArgument(new Argument('array', 'secondArgument'))
                    ->addArgument(new Argument('string', 'thirdArgument'))
                )
                ->addMethod(new Method('secondMethod'))
        );

        $generatedCode = $this->prettyPrinter->generateCode($file);

        $this->assertExpectedCode($generatedCode);
    }
}
