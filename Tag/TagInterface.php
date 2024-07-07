<?php

declare(strict_types=1);

namespace Higgs\Html\Tag;

use Higgs\Html\AlterableInterface;
use Higgs\Html\EscapableInterface;
use Higgs\Html\PreprocessableInterface;
use Higgs\Html\RenderableInterface;
use Higgs\Html\StringableInterface;


interface TagInterface extends
    AlterableInterface,
    EscapableInterface,
    PreprocessableInterface,
    RenderableInterface,
    StringableInterface
{
    /**
     * Get the attributes as string or a specific attribute if $name is provided.
     *
     * @param string $name
     *   The name of the attribute
     * @param mixed ...$value
     *   The value.
     *
     * @return \Higgs\Html\Attribute\AttributeInterface|string
     *   The attributes as string or a specific Attribute object
     */
    public function attr(?string $name = null, ...$value);

    /**
     * Set or get the content.
     *
     * @param mixed ...$data
     *   The content.
     *
     * @return string|null
     *   The content
     */
    public function content(...$data): ?string;

    /**
     * Get the content.
     *
     * @return array<int, string>
     *   The content as an array
     */
    public function getContentAsArray(): array;
}
