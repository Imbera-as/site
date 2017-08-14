<?php

namespace ResponsiveMenuPro\Mappers;
use ResponsiveMenuPro\Collections\OptionsCollection;

class ScssHeaderBarMapper extends ScssMapper {

  public function map(OptionsCollection $options) {

    $css = <<<CSS

    @media screen and (max-width: {$options['header_bar_breakpoint']}px) {

      #responsive-menu-pro-header {
        position: {$options['header_bar_position_type']};
        background-color: {$options['header_bar_background_color']};
        height: {$options['header_bar_height']}{$options['header_bar_height_unit']};
        color: {$options['header_bar_text_color']};
        display: block;
        font-size: {$options['header_bar_font_size']}{$options['header_bar_font_size_unit']};
        @if '{$options['header_bar_font']}' != '' {
          font-family: '{$options['header_bar_font']}';
        }
        .responsive-menu-pro-header-bar-item {
          line-height: {$options['header_bar_height']}{$options['header_bar_height_unit']};
        }
        a {
          color: {$options['header_bar_text_color']};
          text-decoration: none;
        }
      }

    }

CSS;

    return $this->compiler->compile($css);

  }

}
