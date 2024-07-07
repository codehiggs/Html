<?php

declare(strict_types=1);

namespace Higgs\Html\Attribute;

use ArrayAccess;
use Higgs\Html\AlterableInterface;
use Higgs\Html\EscapableInterface;
use Higgs\Html\PreprocessableInterface;
use Higgs\Html\RenderableInterface;
use Higgs\Html\StringableInterface;


/**
 * @template-extends ArrayAccess<int, mixed>
 */
interface AttributeInterface extends
    AlterableInterface,
    ArrayAccess,
    EscapableInterface,
    PreprocessableInterface,
    RenderableInterface,
    StringableInterface
{
    /**
     * {@inheritdoc}
     *
     * @return \Higgs\Html\Attribute\AttributeInterface
     */
    public function alter(callable ...$closures): AttributeInterface;

    /**
     * Append a value to the attribute.
     *
     * @param mixed[]|string|null ...$value
     *   The value to append.
     *
     * @return \Higgs\Html\Attribute\AttributeInterface
     *   The attribute
     */
    public function append(...$value): AttributeInterface;

    /**
     * Check if the attribute contains a string or a substring.
     *
     * @param mixed[]|string ...$substring
     *   The string to check.
     *
     * @return bool
     *   True or False
     */
    public function contains(...$substring): bool;

    /**
     * Delete the current attribute.
     *
     * @return \Higgs\Html\Attribute\AttributeInterface
     *   The attribute
     */
    public function delete(): AttributeInterface;

    /**
     * Get the attribute name.
     *
     * @return string
     *   The attribute name
     */
    public function getName(): string;

    /**
     * Get the attribute value as an array.
     *
     * @return array<int, string>
     *   The attribute value as an array
     */
    public function getValuesAsArray(): array;

    /**
     * Get the attribute value as a string.
     *
     * @return string|null
     *   The attribute value as a string
     */
    public function getValuesAsString(): ?string;

    /**
     * Check if the attribute is a loner attribute.
     *
     * @return bool
     *   True or False
     */
    public function isBoolean();

    /**
     * Remove a value from the attribute.
     *
     * @param array|string ...$value
     *   The value to remove.
     *
     * @return \Higgs\Html\Attribute\AttributeInterface
     *   The attribute
     */
    public function remove(...$value): AttributeInterface;

    /**
     * Replace a value of the attribute.
     *
     * @param mixed[]|string $original
     *   The original value
     * @param mixed[]|string ...$replacement
     *   The replacement value.
     *
     * @return \Higgs\Html\Attribute\AttributeInterface
     *   The attribute
     */
    public function replace($original, ...$replacement): AttributeInterface;

    /**
     * Set the value.
     *
     * @param array|string|null ...$value
     *   The value.
     *
     * @return \Higgs\Html\Attribute\AttributeInterface
     *   The attribute
     */
    public function set(...$value): AttributeInterface;

    /**
     * Set the attribute as a loner attribute.
     *
     * @param bool $boolean
     *   True or False
     *
     * @return \Higgs\Html\Attribute\AttributeInterface
     *   The attribute
     */
    public function setBoolean($boolean = true): AttributeInterface;
}
