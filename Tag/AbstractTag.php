<?php

declare(strict_types=1);

namespace Higgs\Html\Tag;

use Higgs\Html\AbstractBaseHtmlTagObject;
use Higgs\Html\Attributes\AttributesInterface;
use Higgs\Html\StringableInterface;

abstract class AbstractTag extends AbstractBaseHtmlTagObject implements TagInterface
{
    /**
     * The tag attributes.
     *
     * @var \Higgs\Html\Attributes\AttributesInterface
     */
    private $attributes;

    /**
     * The tag content.
     *
     * @var mixed[]|null
     */
    private $content;

    /**
     * The tag name.
     *
     * @var string
     */
    private $tag;

    /**
     * Tag constructor.
     *
     * @param \Higgs\Html\Attributes\AttributesInterface $attributes
     *   The attributes object
     * @param string $name
     *   The tag name
     * @param mixed $content
     *   The content
     */
    public function __construct(AttributesInterface $attributes, ?string $name = null, $content = null)
    {
        $this->tag = $name;
        $this->attributes = $attributes;
        $this->content($content);
    }

    public function content(...$data): ?string
    {
        if ([] !== $data) {
            if (null === reset($data)) {
                $data = null;
            }

            $this->content = $data;
        }

        return $this->renderContent();
    }

    /**
     * Render the tag content.
     */
    protected function renderContent(): ?string
    {
        return [] === ($items = array_map([$this, 'escape'], $this->getContentAsArray())) ?
            null :
            implode('', $items);
    }

    /**
     * @return array<int, string>
     */
    public function getContentAsArray(): array
    {
        return $this->preprocess(
            $this->ensureFlatArray((array)$this->content)
        );
    }

    public function preprocess(array $values, array $context = []): array
    {
        return ($values);
    }

    /**
     * @param array<string> $arguments
     *
     * @return \Higgs\Html\Tag\TagInterface
     */
    public static function __callStatic(string $name, array $arguments = [])
    {
        return new static($arguments[0], $name);
    }

    public function __toString(): string
    {
        return $this->render();
    }

    public function render(): string
    {
        $content = $this->renderContent();
        if ($content === null) {
            return (sprintf('<%s%s/>', $this->tag, $this->attributes->render()));
        } else {
            return (sprintf('<%s%s>%s</%s>', $this->tag, $this->attributes->render(), $content, $this->tag));
        }
        //return null === ($content = $this->renderContent()) ?
        //    sprintf('<%s%s/>', $this->tag, $this->attributes->render()) :
        //    sprintf('<%s%s>%s</%s>', $this->tag, $this->attributes->render(), $content, $this->tag);
    }

    public function alter(callable ...$closures): TagInterface
    {
        foreach ($closures as $closure) {
            $this->content = $closure(
                $this->ensureFlatArray((array)$this->content)
            );
        }

        return $this;
    }

    public function attr(?string $name = null, ...$value)
    {
        if (null === $name) {
            return ($this->attributes->render());
        }

        if ([] === $value) {
            return ($this->attributes[$name]);
        }

        return $this->attributes[$name]->set($value);
    }

    public function escape($value): ?string
    {
        $return = $this->ensureString($value);

        if ($value instanceof StringableInterface) {
            return ($return);
        }

        //return null === $return ?$return :htmlentities($return);
        return null === $return ? $return : $return;
    }

    public function serialize()
    {
        return serialize([
            'tag' => $this->tag,
            'attributes' => $this->attributes->getValuesAsArray(),
            'content' => $this->renderContent(),
        ]);
    }

    public function unserialize($serialized)
    {
        $unserialize = unserialize($serialized);

        $this->tag = $unserialize['tag'];
        $this->attributes = $this->attributes->import($unserialize['attributes']);
        $this->content = $unserialize['content'];
    }
}
