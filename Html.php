<?php
/*
 * **
 *  ** █ ---------------------------------------------------------------------------------------------------------------------
 *  ** █ ░FRAMEWORK                                  2023-12-01 23:19:27
 *  ** █ ░█▀▀█ █▀▀█ █▀▀▄ █▀▀ ░█─░█ ─▀─ █▀▀▀ █▀▀▀ █▀▀ [App\Modules\Account\Views\Processes\Creator\deny.php]
 *  ** █ ░█─── █──█ █──█ █▀▀ ░█▀▀█ ▀█▀ █─▀█ █─▀█ ▀▀█ Copyright 2023 - CloudEngine S.A.S., Inc. <admin@cgine.com>
 *  ** █ ░█▄▄█ ▀▀▀▀ ▀▀▀─ ▀▀▀ ░█─░█ ▀▀▀ ▀▀▀▀ ▀▀▀▀ ▀▀▀ Para obtener información completa sobre derechos de autor y licencia,
 *  ** █                                             consulte la LICENCIA archivo que se distribuyó con este código fuente.
 *  ** █ ---------------------------------------------------------------------------------------------------------------------
 *  ** █ EL SOFTWARE SE PROPORCIONA -TAL CUAL-, SIN GARANTÍA DE NINGÚN TIPO, EXPRESA O
 *  ** █ IMPLÍCITA, INCLUYENDO PERO NO LIMITADO A LAS GARANTÍAS DE COMERCIABILIDAD,
 *  ** █ APTITUD PARA UN PROPÓSITO PARTICULAR Y NO INFRACCIÓN. EN NINGÚN CASO SERÁ
 *  ** █ LOS AUTORES O TITULARES DE LOS DERECHOS DE AUTOR SERÁN RESPONSABLES DE CUALQUIER
 *  ** █ RECLAMO, DAÑOS U OTROS RESPONSABILIDAD, YA SEA EN UNA ACCIÓN DE CONTRATO,
 *  ** █ AGRAVIO O DE OTRO MODO, QUE SURJA DESDE, FUERA O EN RELACIÓN CON EL SOFTWARE
 *  ** █ O EL USO U OTROS NEGOCIACIONES EN EL SOFTWARE.
 *  ** █ ---------------------------------------------------------------------------------------------------------------------
 *  ** █ @Author Jose Alexis Correa Valencia <jalexiscv@gmail.com>
 *  ** █ @link https://www.codehiggs.com
 *  ** █ @Version 1.5.0 @since PHP 7, PHP 8
 *  ** █ ---------------------------------------------------------------------------------------------------------------------
 *  ** █ Datos recibidos desde el controlador - @ModuleController
 *  ** █ ---------------------------------------------------------------------------------------------------------------------
 *  ** █ @authentication, @request, @dates, @parent, @component, @view, @oid, @views, @prefix
 *  ** █ ---------------------------------------------------------------------------------------------------------------------
 *  **
 */

namespace Higgs\Html;

use Higgs\Html\HtmlTag;
use Higgs\Html\Tag\TagInterface;
use InvalidArgumentException;

/**
 * Class HtmlTag.
 *   La existencia de esta clase implica:
 *   1). La modificación el archivo system/Common.php: Este archivo contiene funciones de ayuda globales. Se agrego una
 *       función helper para la clase Html: if (!function_exists('html')){function html(){return new \Higgs\Html\Html();}}
 *   2). La modificación de system/bootstrap.php: para la clase se cargue automáticamente al iniciar el sistema, se agrego
 *       esta línea al final del archivo: require_once SYSTEM_PATH . 'Html/Html.php';
 *
 */
class Html
{

    /**
     * Crea una instancia de la clase HtmlTag representando una etiqueta HTML 'div' con los atributos especificados.
     * @param array $args Un array asociativo que contiene los atributos de la etiqueta 'a'.
     * @return TagInterface La instancia de Tag representando una etiqueta HTML 'a' con los atributos especificados.
     */
    public static function get_Div2(array $args): string
    {
        $id = self::_get_Attribute($args, "id", "", false);
        $class = self::_get_Attribute($args, "class", "", false);
        $content = self::_get_Attribute($args, "content", "", false);
        $div = HtmlTag::tag('div');
        $div->attr('id', $id);
        $div->attr('class', $class);
        $div->content($content);
        return ($div->render());
    }

    /**
     * Este método devuelve el valor del atributo especificado por el parámetro $name.
     * Si el atributo no está presente en el array $this->attributes, devuelve el valor
     * predeterminado proporcionado en el parámetro $default.
     * @param $attributes
     * @param string $key El nombre del atributo cuyo valor se desea obtener.
     * @param mixed $default El valor predeterminado que se devuelve si el atributo no está presente.
     * @param bool $required Si se establece en true, se lanzará una excepción si el atributo no está presente.
     * @return mixed El valor del atributo si está presente, de lo contrario, el valor predeterminado.
     * @note En esta versión del método, hemos utilizado el operador de fusión nula ??, que devuelve el valor del
     * atributo si está presente, y el valor predeterminado si no lo está. Esto simplifica aún más el código y hace
     * que sea más legible. Además, se han agregado tipos de argumento y retorno al método.
     */
    private static function _get_Attribute($attributes, string $key, mixed $default, bool $required): mixed
    {
        if (isset($attributes[$key])) {
            if (is_string($attributes[$key])) {
                $return = trim($attributes[$key]);
            } elseif (is_array($attributes[$key])) {
                $return = $attributes[$key];
            } else {
                $return = $attributes[$key];
            }
            return ($return);
        } else {
            if ($required) {
                throw new InvalidArgumentException("El atributo '$key' es obligatorio.");
            } else {
                return ($default);
            }
        }
    }

    /**
     * Crea una instancia de la clase HtmlTag representando una etiqueta HTML 'b' con el contenido especificado.
     * @param array $args Un array asociativo que contiene los atributos de la etiqueta 'a'.
     * @return TagInterface La instancia de Tag representando una etiqueta HTML 'b' con los atributos especificados.
     */
    public static function get_B(array $args): string
    {
        $content = self::_get_Attribute($args, "content", "", false);
        if (!empty($content)) {
            $b = HtmlTag::tag('b');
            $b->content($content);
            return ($b->render());
        }
        return ("");
    }

    /**
     * Crea una instancia de la clase HtmlTag representando una etiqueta HTML 'i' con el contenido especificado.
     * @param array $args Un array asociativo que contiene los atributos de la etiqueta 'i'.
     * @return TagInterface La instancia de Tag representando una etiqueta HTML 'i' con los atributos especificados.
     */
    public static function get_I(array $args): string
    {
        $class = self::_get_Attribute($args, "class", "", false);
        $content = self::_get_Attribute($args, "content", "", false);
        $i = HtmlTag::tag('i');
        $i->attr('class', $class);
        $i->content($content);
        return ($i->render());
    }


    /**
     * Crea una instancia de la clase HtmlTag representando una etiqueta HTML 'a' con el contenido y atributos especificados.
     * @param array $args Un array asociativo que contiene los atributos de la etiqueta 'a'.
     * @return TagInterface La instancia de Tag representando una etiqueta HTML 'a' con los atributos especificados.
     */
    public static function get_A(array $args): string
    {
        $href = self::_get_Attribute($args, "href", "#", false);
        $content = self::_get_Attribute($args, "content", "", false);
        $a = HtmlTag::tag('a');
        $a->attr('href', $href);
        $a->content($content);
        return ($a->render());
    }

    /**
     * Crea una instancia de la clase HtmlTag representando una etiqueta HTML 'p' con el contenido especificado.
     * @param array $args Un array asociativo que contiene los atributos de la etiqueta 'p'.
     * @return TagInterface La instancia de Tag representando una etiqueta HTML 'p' con los atributos especificados.
     */
    public static function get_P(array $args): string
    {
        $content = self::_get_Attribute($args, "content", "", false);
        $p = HtmlTag::tag('p');
        $p->content($content);
        return ($p->render());
    }

    /**
     * Crea una instancia de la clase HtmlTag representando una etiqueta HTML 'img' con los atributos especificados.
     * @param array $args Un array asociativo que contiene los atributos de la etiqueta 'img'.
     * @return TagInterface La instancia de Tag representando una etiqueta HTML 'img' con los atributos especificados.
     */
    public static function get_Img(array $args): string
    {
        $src = self::_get_Attribute($args, "src", "", true);
        $alt = self::_get_Attribute($args, "alt", "", false);
        $img = HtmlTag::tag('img');
        $img->attr('src', $src);
        $img->attr('alt', $alt);
        return ($img->render());
    }

    /**
     * Crea una instancia de la clase HtmlTag representando una etiqueta HTML 'ul' con los elementos especificados.
     * @param array $args Un array asociativo que contiene los elementos de la lista 'ul'.
     * @return TagInterface La instancia de Tag representando una etiqueta HTML 'ul' con los elementos especificados.
     */
    public static function get_Ul(array $args): string
    {
        $items = self::_get_Attribute($args, "items", array(), false);
        $ul = HtmlTag::tag('ul');
        foreach ($items as $item) {
            $li = HtmlTag::tag('li');
            $li->content($item);
            $ul->child($li);
        }
        return ($ul->render());
    }

    /**
     * Crea una instancia de la clase HtmlTag representando una etiqueta HTML 'ol' con los elementos especificados.
     * @param array $args Un array asociativo que contiene los elementos de la lista 'ol'.
     * @return TagInterface La instancia de Tag representando una etiqueta HTML 'ol' con los elementos especificados.
     */
    public static function get_Ol(array $args): string
    {
        $items = self::_get_Attribute($args, "items", array(), false);
        $ol = HtmlTag::tag('ol');
        foreach ($items as $item) {
            $li = HtmlTag::tag('li');
            $li->content($item);
            $ol->child($li);
        }
        return ($ol->render());
    }

    /**
     * Crea una instancia de la clase HtmlTag representando una etiqueta HTML 'h1' con el contenido especificado.
     * @param array $args Un array asociativo que contiene los atributos de la etiqueta 'h1'.
     * @return TagInterface La instancia de Tag representando una etiqueta HTML 'h1' con los atributos especificados.
     */
    public static function get_H1(array $args): string
    {
        $content = self::_get_Attribute($args, "content", "", false);
        $h1 = HtmlTag::tag('h1');
        $h1->content($content);
        return ($h1->render());
    }

    // Se pueden agregar más métodos aquí para representar otros elementos HTML básicos como 'div', 'span', etc.

    /**
     * Crea una instancia de la clase HtmlTag representando una etiqueta HTML 'div' con el contenido y atributos especificados.
     * @param array $args Un array asociativo que contiene los atributos y el contenido de la etiqueta 'div'.
     * @return string Retorna la instancia de Tag representando una etiqueta HTML 'div' con los atributos y contenido especificados.
     */
    public static function get_Div(array $args): string
    {
        $content = self::_get_Attribute($args, "content", "", false);
        $div = HtmlTag::tag('div');
        $div->content($content);
        // Añadir atributos adicionales si existen
        foreach ($args as $key => $value) {
            if ($key !== 'content') {
                $div->attr($key, $value);
            }
        }
        return ($div->render());
    }


    /**
     * Crea una instancia de la clase HtmlTag representando una etiqueta HTML 'button' con el contenido y atributos especificados.
     * @param array $args Un array asociativo que contiene los atributos y el contenido del botón.
     * @return string Retorna la instancia de Tag representando una etiqueta HTML 'div' con los atributos y contenido especificados.
     */
    public static function get_Button($args = array()): string
    {
        $content = self::_get_Attribute($args, "content", "", false);
        $button = HtmlTag::tag('button');
        $button->content($content);
        // Añadir atributos adicionales si existen
        foreach ($args as $key => $value) {
            if ($key !== 'content') {
                $button->attr($key, $value);
            }
        }
        return ($button->render());
    }

    /**
     * Crea una instancia de la clase HtmlTag representando una etiqueta HTML 'span' con el contenido y atributos especificados.
     * @param array $args Un array asociativo que contiene los atributos y el contenido de la etiqueta 'span'.
     * @return TagInterface La instancia de Tag representando una etiqueta HTML 'span' con los atributos y contenido especificados.
     */
    public static function get_Span(array $args): string
    {
        $content = self::_get_Attribute($args, "content", "", false);
        $span = HtmlTag::tag('span');
        $span->content($content);
        // Añadir atributos adicionales si existen
        if (isset($args['attributes']) && is_array($args['attributes'])) {
            foreach ($args['attributes'] as $key => $value) {
                $span->attr($key, $value);
            }
        }
        return ($span->render());
    }


}

?>
