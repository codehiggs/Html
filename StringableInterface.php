<?php

declare(strict_types=1);

namespace Higgs\Html;

/**
 * Interface StringableInterface.
 */
interface StringableInterface
{
    /**
     * Get a string representation of the object.
     *
     * @return string
     *   The string
     */
    public function __toString(): string;
}
