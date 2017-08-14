<?php

namespace ResponsiveMenuPro\Mappers;
use ResponsiveMenuPro\Collections\OptionsCollection;

class ScssSingleMenuMapper extends ScssMapper {

  public function map(OptionsCollection $options) {

    $css = <<<CSS
      #responsive-menu-pro-container.responsive-menu-pro-no-transition {
          transition: none;
      }
      @media screen and (min-width: {$options['breakpoint']}px) {
        #responsive-menu-pro-container {
          display: block;
          & div {
            display: none;
          }
          & #responsive-menu-pro-wrapper,
          & #responsive-menu-pro {
            display: block;
          }
        }
        #responsive-menu-pro {
          list-style-type: none;
          margin: 0;
          li {
            box-sizing: border-box;
            display: inline-block;
            position: relative;
            white-space: nowrap;
            margin: 0;
            a {
              line-height: {$options['single_menu_height']}{$options['single_menu_height_unit']};
              color: {$options['single_menu_item_link_colour']};
              background: {$options['single_menu_item_background_colour']};
              text-decoration: none;
              transition: color, background {$options['transition_speed']}s;
              display: block;
              padding: 0 15px;
              .fa {
                margin-right: 5px;
              }
              &:hover {
                color: {$options['single_menu_item_link_colour_hover']};
                background: {$options['single_menu_item_background_colour_hover']};
              }
              font-size: {$options['single_menu_font_size']}{$options['single_menu_font_size_unit']};
              @if '{$options['single_menu_font']}' != '' {
                font-family: '{$options['single_menu_font']}';
              }
            }
            .responsive-menu-pro-submenu {
              display: none;
              position: absolute;
              margin: 0;
              top: {$options['single_menu_height']}{$options['single_menu_height_unit']};
              li {
                display: block;
                width: 100%;
                a {
                  background: {$options['single_menu_item_submenu_background_colour']};
                  color: {$options['single_menu_item_submenu_link_colour']};
                  font-size: {$options['single_menu_submenu_font_size']}{$options['single_menu_submenu_font_size_unit']};
                  line-height: {$options['single_menu_submenu_height']}{$options['single_menu_submenu_height_unit']};
                  &:hover {
                    color: {$options['single_menu_item_submenu_link_colour_hover']};
                    background: {$options['single_menu_item_submenu_background_colour_hover']};
                  }
                  @if '{$options['single_menu_submenu_font']}' != '' {
                    font-family: '{$options['single_menu_submenu_font']}';
                  }
                }
                .responsive-menu-pro-submenu {
                  top: 0;
                  left: 100%;
                }
              }
            }
            &:hover > .responsive-menu-pro-submenu {
              display: block;
            }
          }
        }

    }
CSS;

    return $this->compiler->compile($css);

  }

}
