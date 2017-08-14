<?php

namespace ResponsiveMenuPro\Mappers;
use ResponsiveMenuPro\Collections\OptionsCollection;

class ScssButtonMapper extends ScssMapper {

  public function map(OptionsCollection $options) {

    $hamburger_css_dir = dirname(dirname(dirname(__FILE__))) . '/public/scss/hamburgers/hamburgers.scss';
    $no_animation = $options['button_click_animation'] == 'off' ? '$hamburger-types: ();' : '';

    $css = <<<CSS

    @media screen and ( max-width: {$options['breakpoint']}px ) {

      \$hamburger-layer-height: {$options['button_line_height']}{$options['button_line_height_unit']};
      \$hamburger-layer-spacing: {$options['button_line_margin']}{$options['button_line_margin_unit']};
      \$hamburger-layer-color: {$options['button_line_colour']};
      \$hamburger-layer-width: {$options['button_line_width']}{$options['button_line_width_unit']};
      \$hamburger-hover-opacity: 1;
      {$no_animation}

      @import "{$hamburger_css_dir}";

      button#responsive-menu-pro-button {
        width: {$options['button_width']}{$options['button_width_unit']};
        height: {$options['button_height']}{$options['button_height_unit']};
        @if '{$options['button_transparent_background']}' == 'off' {
          background: {$options['button_background_colour']};
          &:hover {
            background: {$options['button_background_colour_hover']};
          }
        }
        position: {$options['button_position_type']};
        top: {$options['button_top']}{$options['button_top_unit']};
        {$options['button_left_or_right']}: {$options['button_distance_from_side']}{$options['button_distance_from_side_unit']};
        .responsive-menu-pro-box {
          color: {$options['button_line_colour']};
        }
      }

      .responsive-menu-pro-label {
        color: {$options['button_text_colour']};
        font-size: {$options['button_font_size']}{$options['button_font_size_unit']};
        line-height: {$options['button_title_line_height']}{$options['button_title_line_height_unit']};
        @if '{$options['button_font']}' != '' {
          font-family: '{$options['button_font']}';
        }
      }

      button#responsive-menu-pro-button {
          display: inline-block;
          transition: transform {$options['animation_speed']}s, background-color {$options['transition_speed']}s;
        }
      }
CSS;

    return $this->compiler->compile($css);

  }

}
