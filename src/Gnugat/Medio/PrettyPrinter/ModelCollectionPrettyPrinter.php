<?php

/*
 * This file is part of the Medio project.
 *
 * (c) Loïc Chardonnet <loic.chardonnet@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gnugat\Medio\PrettyPrinter;

use Gnugat\Medio\Model\FullyQualifiedName;
use Twig_Environment;

class ModelCollectionPrettyPrinter implements PrettyPrinterStrategy
{
    /**
     * @var Twig_Environment
     */
    private $twig;

    /**
     * @param Twig_Environment $twig_Environment
     */
    public function __construct(Twig_Environment $twig)
    {
        $this->twig = $twig;
    }

    /**
     * {@inheritDoc}
     */
    public function supports($model)
    {
        if (!is_array($model)) {
            return false;
        }
        $firstElement = current($model);
        if (!is_object($firstElement)) {
            return false;
        }
        $fqcn = get_class($firstElement);

        return 1 === preg_match('/^Gnugat\\\\Medio\\\\Model\\\\/', $fqcn);
    }

    /**
     * {@inheritDoc}
     */
    public function generateCode($model, array $parameters = array())
    {
        $firstElement = current($model);
        $fqcn = get_class($firstElement);
        $name = FullyQualifiedName::make($fqcn)->getName();
        $modelName = strtolower(preg_replace('/([a-z])([A-Z])/', '$1_$2', $name)).'_collection';
        $parameters[$modelName] = $model;

        return $this->twig->render('collection/'.$modelName.'.twig', $parameters);
    }
}
