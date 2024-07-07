<?php

declare(strict_types=1);

namespace Higgs\Html;

use Higgs\Html\Attribute\AttributeFactory;
use Higgs\Html\Attribute\AttributeInterface;
use Higgs\Html\Attributes\AttributesFactory;
use Higgs\Html\Attributes\AttributesInterface;
use Higgs\Html\Tag\TagFactory;
use Higgs\Html\Tag\TagInterface;

/**
 * Class HtmlTag.
 */
final class HtmlTag implements HtmlTagInterface
{
    public static function attribute(string $name, $value): AttributeInterface
    {
        return AttributeFactory::build($name, $value);
    }

    public static function attributes(array $attributes = []): AttributesInterface
    {
        return AttributesFactory::build($attributes);
    }

    public static function tag(string $name, array $attributes = [], $content = null): TagInterface
    {
        return TagFactory::build($name, $attributes, $content);
    }
}
