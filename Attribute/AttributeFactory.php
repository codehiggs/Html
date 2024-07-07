<?php

declare(strict_types=1);

namespace Higgs\Html\Attribute;

use Exception;
use ReflectionClass;

use function in_array;

class AttributeFactory implements AttributeFactoryInterface
{
    /**
     * The classes registry.
     *
     * @var array<string, string>
     */
    public static $registry = [
        '*' => Attribute::class,
    ];

    public static function build(string $name, $value = null): AttributeInterface
    {
        return (new static())->getInstance($name, $value);
    }

    public function getInstance(string $name, $value = null): AttributeInterface
    {
        $attribute_classname = static::$registry[$name] ?? static::$registry['*'];

        if (!in_array(AttributeInterface::class, class_implements($attribute_classname), true)) {
            throw new \Exception(
                sprintf(
                    'The class (%s) must implement the interface %s.',
                    $attribute_classname,
                    AttributeInterface::class
                )
            );
        }

        /** @var \Higgs\Html\Attribute\AttributeInterface $attribute */
        $attribute = (new ReflectionClass($attribute_classname))
            ->newInstanceArgs([
                $name,
                $value,
            ]);

        return $attribute;
    }
}
