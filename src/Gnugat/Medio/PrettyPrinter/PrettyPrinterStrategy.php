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

interface PrettyPrinterStrategy
{
    /**
     * @param mixed $model
     *
     * @return bool
     */
    public function supports($model);

    /**
     * @param mixed $model
     * @param array $parameters
     *
     * @return string
     */
    public function generateCode($model, array $parameters = array());
}
