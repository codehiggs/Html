<?php

declare(strict_types=1);

namespace Higgs\Html\Attributes;

use Higgs\Html\Attribute\AttributeFactory;
use ReflectionClass;

class AttributesFactory implements AttributesFactoryInterface
{
    /**
     * The classes registry.
     *
     * @var array
     */
    public static $registry = [
        'attribute_factory' => AttributeFactory::class,
        '*' => Attributes::class,
    ];

    public static function build(
        array $attributes = []
    )
    {
        return (new static())->getInstance($attributes);
    }

    public function getInstance(
        array $attributes = []
    )
    {
        $attribute_factory_classname = static::$registry['attribute_factory'];

        /** @var \Higgs\Html\Attribute\AttributeFactoryInterface $attribute_factory_classname */
        $attribute_factory_classname = (new ReflectionClass($attribute_factory_classname))->newInstance();

        $attributes_classname = static::$registry['*'];

        /** @var \Higgs\Html\Attributes\AttributesInterface $attributes */
        $attributes = (new ReflectionClass($attributes_classname))
            ->newInstanceArgs([
                $attribute_factory_classname,
                $attributes,
            ]);

        return $attributes;
    }
}
