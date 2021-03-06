<?php

/*
 * This file is part of the Medio project.
 *
 * (c) Loïc Chardonnet <loic.chardonnet@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gnugat\Medio\Validator\Constraint;

use Gnugat\Medio\Validator\Constraint;
use Gnugat\Medio\Validator\Violation\NoneViolation;
use Gnugat\Medio\Validator\Violation\SomeViolation;

class MethodCannotBeBothAbstractAndFinal implements Constraint
{
    /**
     * {@inheritDoc}
     */
    public function validate($model)
    {
        if ($model->isAbstract() && $model->isFinal()) {
            return new SomeViolation(sprintf('Method "%s" cannot be both abstract and final', $model->getName()));
        }

        return new NoneViolation();
    }
}
