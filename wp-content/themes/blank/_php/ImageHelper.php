<?php
namespace WP;

/**
 * ImageHelper
 *
 * This generates multiple smaller versions of (already defined)
 * cropped and non-cropped versions and provides a simple
 * helper function to output images (in a <picture>-tag).
 *
 * example call inside template:
 * \WP\ImageHelper::img(
 *     // the actual image
 *     image: get_field('image', 2),
 *     // class
 *     class: 'test-class',
 *     // ratios; which width of the screen does the image approximately take? use for example 3 values for 3 layouts defined in new ImageHelper()
 *     ratios: [0.5, 1, 1],
 *     // do you want to use (an auto generated) cropped version of the image? use the name of the crop here
 *     cropped: '1900x1200',
 *     // custom attributes
 *     attrs: ['data-foo' => 'bar', 'alt' => 'specific alt tag'],
 *     // add lazy load attribute
 *     lazy: true,
 *     // echo output
 *     echo: false
 * );
 *
 * @author David Vielhuber <david@vielhuber.de>
 * @version 1.0.5
 */

class ImageHelper
{
    public static $init = false;

    public static $breakpoints = null;

    public static $resolutions = null;

    public function __construct($resolutions = null, $breakpoints = null)
    {
        if (ImageHelper::$init === false) {
            ImageHelper::$init = true;
            ImageHelper::$resolutions = $resolutions;
            ImageHelper::$breakpoints = $breakpoints;
            $this->addVariousImageSizesForRenderHelper();
        }
    }

    public static function img(
        $image,
        $class = null,
        $ratios = [1, 1, 1],
        $cropped = null,
        $attrs = [],
        $lazy = true,
        $echo = true
    ) {
        $obj = new ImageHelper();
        return $obj->renderImage($image, $class, $ratios, $cropped, $attrs, $lazy, $echo);
    }

    public function renderImage(
        $image,
        $class = null,
        $ratios = [1, 1, 1],
        $cropped = null,
        $attrs = [],
        $lazy = true,
        $echo = true
    ) {
        if ($image == '' || empty($image)) {
            return;
        }

        if ($echo === false) {
            ob_start();
        }

        $is_pixel = isset($image['mime_type']) && in_array(@$image['mime_type'], ['image/jpeg', 'image/png']);

        if ($is_pixel) {
            echo '<picture>';
            $default_size = null;
            foreach (ImageHelper::$resolutions as $resolutions__value) {
                $ratio = $ratios[count($ratios) - 1];
                foreach (array_reverse(ImageHelper::$breakpoints) as $breakpoints__key => $breakpoints__value) {
                    if ($resolutions__value > $breakpoints__value) {
                        $ratio = $ratios[$breakpoints__key];
                        break;
                    }
                }

                $size = array_reverse(ImageHelper::$resolutions)[0];
                $size_2x = array_reverse(ImageHelper::$resolutions)[0];
                foreach (array_reverse(ImageHelper::$resolutions) as $resolutions_reversed__value) {
                    if ($resolutions_reversed__value >= $resolutions__value * $ratio) {
                        $size = $resolutions_reversed__value;
                    }
                    if ($resolutions_reversed__value >= 2 * $resolutions__value * $ratio) {
                        $size_2x = $resolutions_reversed__value;
                    }
                }
                $default_size = $size;
                echo '<source media="(max-width: ' . $resolutions__value . 'px)"';
                // debug
                if (is_user_logged_in()) {
                    echo ' data-name-1x="' . $this->getSizeName($size, $cropped) . '"';
                    echo ' data-name-2x="' . $this->getSizeName($size_2x, $cropped) . '"';
                    echo ' data-ratio="' . $ratio . '"';
                }
                echo ' srcset="' .
                    $image['sizes'][$this->getSizeName($size, $cropped)] .
                    ' 1x, ' .
                    $image['sizes'][$this->getSizeName($size_2x, $cropped)] .
                    ' 2x">';
            }
        }

        $img_attrs = [];
        if ($class !== null) {
            $img_attrs['class'] = $class;
        }
        if ($lazy === true) {
            $img_attrs['loading'] = 'lazy';
        }
        $img_attrs['alt'] = htmlspecialchars($image['alt']);

        if ($is_pixel) {
            $img_attrs['src'] = $image['sizes'][$this->getSizeName($default_size, $cropped)];
            $img_attrs['width'] = $image['sizes'][$this->getSizeName($default_size, $cropped) . '-width'];
            $img_attrs['height'] = $image['sizes'][$this->getSizeName($default_size, $cropped) . '-height'];
        } else {
            $img_attrs['src'] = $image['url'];
        }

        foreach ($attrs as $attrs__key => $attrs__value) {
            $img_attrs[$attrs__key] = htmlspecialchars($attrs__value);
        }

        echo '<img';
        foreach ($img_attrs as $img_attrs__key => $img_attrs__value) {
            if ($img_attrs__value === null) {
                continue;
            }
            echo ' ' . $img_attrs__key . '="' . $img_attrs__value . '"';
        }
        echo ' />';

        if ($is_pixel) {
            echo '</picture>';
        }

        if ($echo === false) {
            $html = ob_get_contents();
            ob_end_clean();
            return $html;
        }
    }

    private function getSizeName($size, $cropped)
    {
        $size_name = null;
        if ($cropped === null) {
            $size_name = 'auto_generated_nocrop_' . $size . 'x';
        } else {
            $sizes = wp_get_registered_image_subsizes();
            if (!isset($sizes[$cropped])) {
                return null;
            }
            $size_name =
                'auto_generated_crop_' .
                $size .
                'x' .
                round($size / ($sizes[$cropped]['width'] / $sizes[$cropped]['height']));
        }
        return $size_name;
    }

    private function addVariousImageSizesForRenderHelper()
    {
        // no crop
        add_action(
            'after_setup_theme',
            function () {
                foreach (ImageHelper::$resolutions as $resolutions__value) {
                    add_image_size('auto_generated_nocrop_' . $resolutions__value . 'x', $resolutions__value, 0, false);
                }
            },
            PHP_INT_MAX
        );
        // cropped pendants
        add_action(
            'after_setup_theme',
            function () {
                $sizes = wp_get_registered_image_subsizes();
                foreach ($sizes as $sizes__value) {
                    if ($sizes__value['crop'] != '1') {
                        continue;
                    }
                    $ratio = $sizes__value['width'] / $sizes__value['height'];
                    $ratio_string = $this->floatToRatio($sizes__value['width'] / $sizes__value['height']);
                    foreach (ImageHelper::$resolutions as $resolutions__value) {
                        $height = round($resolutions__value / $ratio);
                        $name = 'auto_generated_crop_' . $resolutions__value . 'x' . $height;
                        add_image_size($name, $resolutions__value, $height, true);
                        // support plugin "crop image" and set correct ratio
                        add_filter(
                            'crop_thumbnails_editor_printratio',
                            function ($printRatio, $imageSizeName) use ($name, $ratio_string) {
                                if ($imageSizeName === $name) {
                                    $printRatio = $ratio_string;
                                }
                                return $printRatio;
                            },
                            10,
                            2
                        );
                    }
                }
            },
            PHP_INT_MAX
        );
    }

    private function floatToRatio($n)
    {
        $tolerance = 1e-6;
        $h1 = 1;
        $h2 = 0;
        $k1 = 0;
        $k2 = 1;
        $b = 1 / $n;
        do {
            $b = 1 / $b;
            $a = floor($b);
            $aux = $h1;
            $h1 = $a * $h1 + $h2;
            $h2 = $aux;
            $aux = $k1;
            $k1 = $a * $k1 + $k2;
            $k2 = $aux;
            $b = $b - $a;
        } while (abs($n - $h1 / $k1) > $n * $tolerance);
        return "$h1:$k1";
    }
}
