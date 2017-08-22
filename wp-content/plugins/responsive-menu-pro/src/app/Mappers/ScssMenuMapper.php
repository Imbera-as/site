<?php

namespace ResponsiveMenuPro\Mappers;
use ResponsiveMenuPro\Collections\OptionsCollection;

class ScssMenuMapper extends ScssMapper {

  public function map(OptionsCollection $options) {

    $css = <<<CSS

    @media screen and ( max-width: {$options['breakpoint']}px ) {

      @if '{$options['menu_close_on_body_click']}' == 'on' {
        html.responsive-menu-pro-open {
          cursor: pointer;
          #responsive-menu-pro-container {
            cursor: initial;
          }
        }
      }

      .responsive-menu-pro-fade-top,
      .responsive-menu-pro-fade-left,
      .responsive-menu-pro-fade-right,
      .responsive-menu-pro-fade-bottom {
        #responsive-menu-pro-container {
          display: none;
        }
      }

      #responsive-menu-pro-mask {
        transition: background-color {$options['animation_speed']}s,
        width 0s {$options['animation_speed']}s,
        height 0s{$options['animation_speed']}s;
        .responsive-menu-pro-open & {
          background-color: {$options['menu_overlay_colour']};
          transition: background-color {$options['animation_speed']}s;
        }
      }

      @if '{$options['page_wrapper']}' != '' {
        & {$options['page_wrapper']} {
          transition: transform {$options['animation_speed']}s;
        }
        html.responsive-menu-pro-open,
        .responsive-menu-pro-open body {
          width: 100%;
        }
      }

      #responsive-menu-pro-container {
        width: {$options['menu_width']}{$options['menu_width_unit']};
        {$options['menu_appear_from']}: 0;
        @if '{$options['menu_auto_height']}' == 'off' {
          background: {$options['menu_background_colour']};
        }
        @if '{$options['menu_background_image']}' != '' {
          background-image: url('{$options['menu_background_image']}');
          background-size: cover;
        }
        transition: transform {$options['animation_speed']}s;
        text-align: {$options['menu_text_alignment']};
        /*opacity: 0.85;*/

        & #responsive-menu-pro-wrapper {
          background: {$options['menu_background_colour']};
        }

        #responsive-menu-pro-additional-content {
          color: {$options['menu_additional_content_colour']};
        }

        .responsive-menu-pro-search-box {
          background: {$options['menu_search_box_background_colour']};
          border: 2px solid {$options['menu_search_box_border_colour']};
          color: {$options['menu_search_box_text_colour']};
          &:-ms-input-placeholder {
            color: {$options['menu_search_box_placholder_colour']};
          }
          &:-webkit-input-placeholder {
            color: {$options['menu_search_box_placholder_colour']};
          }
          &:-moz-placeholder {
            color: {$options['menu_search_box_placholder_colour']};
            opacity: 1;
          }
          &::-moz-placeholder {
            color: {$options['menu_search_box_placholder_colour']};
            opacity: 1;
          }
        }

        @if '{$options['menu_auto_height']}' == 'on' {
          @if '{$options['menu_appear_from']}' == 'bottom' {
            top: auto;
          } @else {
            bottom: '';
          }
        }

        @if '{$options['menu_maximum_width']}' != '' {
          max-width: {$options['menu_maximum_width']}{$options['menu_maximum_width_unit']};
        }
        @if '{$options['menu_minimum_width']}' != '' {
          min-width: {$options['menu_minimum_width']}{$options['menu_minimum_width_unit']};
        }

        @if '{$options['menu_font']}' != '' {
          font-family: '{$options['menu_font']}';
        }

        & .responsive-menu-pro-item-link, & #responsive-menu-pro-title, & .responsive-menu-pro-subarrow {
          transition: background-color {$options['transition_speed']}s, border-color {$options['transition_speed']}s, color {$options['transition_speed']}s;
        }

        #responsive-menu-pro-title {
          background-color: {$options['menu_title_background_colour']};
          color: {$options['menu_title_colour']};
          font-size: {$options['menu_title_font_size']}{$options['menu_title_font_size_unit']};
          a {
            color: {$options['menu_title_colour']};
            font-size: {$options['menu_title_font_size']}{$options['menu_title_font_size_unit']};
            text-decoration: none;
            &:hover {
              color: {$options['menu_title_hover_colour']};
            }
          }
          &:hover {
            background-color: {$options['menu_title_background_hover_colour']};
            color: {$options['menu_title_hover_colour']};
            a {
              color: {$options['menu_title_hover_colour']};
            }
          }
          #responsive-menu-pro-title-image {
            display: inline-block;
            vertical-align: middle;
            margin-right: 15px;
          }
        }

        #responsive-menu-pro {

          @if '{$options['fade_submenus']}' == 'on' {
            > li {
              display: none;
              @if '{$options['fade_submenus_side']}' == 'left' {
                margin-left: -150px;
              }
              @if '{$options['fade_submenus_side']}' == 'right' {
                margin-left: 150px;
              }
            }
          }

          > li.responsive-menu-pro-item:first-child > a {
              border-top: {$options['menu_border_width']}{$options['menu_border_width_unit']} solid {$options['menu_item_border_colour']};
          }

          li.responsive-menu-pro-item {
            .responsive-menu-pro-item-link {
              font-size: {$options['menu_font_size']}{$options['menu_font_size_unit']};
            }
            a {
              line-height: {$options['menu_links_height']}{$options['menu_links_height_unit']};
              border-bottom: {$options['menu_border_width']}{$options['menu_border_width_unit']} solid {$options['menu_item_border_colour']};
              color: {$options['menu_link_colour']};
              background-color: {$options['menu_item_background_colour']};
              @if '{$options['menu_word_wrap']}' != 'off' {
                word-wrap: break-word;
              }
              &:hover {
                color: {$options['menu_link_hover_colour']};
                background-color: {$options['menu_item_background_hover_colour']};
                border-color: {$options['menu_item_border_colour_hover']};
                .responsive-menu-pro-subarrow {
                  color: {$options['menu_sub_arrow_shape_hover_colour']};
                  border-color: {$options['menu_sub_arrow_border_hover_colour']};
                  background-color: {$options['menu_sub_arrow_background_hover_colour']};
                }
              }

              .responsive-menu-pro-subarrow {
                {$options['arrow_position']}: 0;
                height: {$options['submenu_arrow_height']}{$options['submenu_arrow_height_unit']};
                line-height: {$options['submenu_arrow_height']}{$options['submenu_arrow_height_unit']};
                width: {$options['submenu_arrow_width']}{$options['submenu_arrow_width_unit']};
                color: {$options['menu_sub_arrow_shape_colour']};
                border-left: {$options['menu_border_width']}{$options['menu_border_width_unit']} solid {$options['menu_sub_arrow_border_colour']};
                background-color: {$options['menu_sub_arrow_background_colour']};
                  &.responsive-menu-pro-subarrow-active {
                    color: {$options['menu_sub_arrow_shape_colour_active']};
                    border-color: {$options['menu_sub_arrow_border_colour_active']};
                    background-color: {$options['menu_sub_arrow_background_colour_active']};
                    &:hover {
                      color: {$options['menu_sub_arrow_shape_hover_colour_active']};
                      border-color: {$options['menu_sub_arrow_border_hover_colour_active']};
                      background-color: {$options['menu_sub_arrow_background_hover_colour_active']};
                    }
                  }

                  &:hover {
                    color: {$options['menu_sub_arrow_shape_hover_colour']};
                    border-color: {$options['menu_sub_arrow_border_hover_colour']};
                    background-color: {$options['menu_sub_arrow_background_hover_colour']};
                  }
              }
            }
            &.responsive-menu-pro-current-item > .responsive-menu-pro-item-link {
              background-color: {$options['menu_current_item_background_colour']};
              color: {$options['menu_current_link_colour']};
              border-color: {$options['menu_current_item_border_colour']};
              &:hover {
                background-color: {$options['menu_current_item_background_hover_colour']};
                color: {$options['menu_current_link_hover_colour']};
                border-color: {$options['menu_current_item_border_hover_colour']};
              }
            }
          }
        }
      }
        @if '{$options['menu_to_hide']}' != '' {
          & {$options['menu_to_hide']} {
            display: none !important;
          }
        }
      }

    @if '{$options['use_slide_effect']}' == 'on' {
    #responsive-menu-pro-container
      #responsive-menu-pro {
        position: relative;
        transition: transform {$options['animation_speed']}s, height {$options['animation_speed']}s;
        ul {
          position: absolute;
          top: 0;
          left: 0;
          transform: translateX(100%);
          &.responsive-menu-pro-submenu {
            display: block;
          }
        }

        .responsive-menu-pro-back {
          padding: 0 5%;
          color: {$options['menu_sub_arrow_shape_colour_active']};
          font-size: {$options['menu_font_size']}{$options['menu_font_size_unit']};
          line-height: {$options['menu_links_height']}px;
          cursor: pointer;
          border-bottom: {$options['menu_border_width']}{$options['menu_border_width_unit']} solid {$options['menu_item_border_colour']};
          border-top: {$options['menu_border_width']}{$options['menu_border_width_unit']} solid {$options['menu_item_border_colour']};
          display: none;
        }
        ul.responsive-menu-pro-submenu {
      		display: none;
      	}
      	ul.responsive-menu-pro-submenu.responsive-menu-pro-subarrow-active,
        .responsive-menu-pro-subarrow-active > .responsive-menu-pro-back {
          display: block;
        }
      }
    }
CSS;

    return $this->compiler->compile($css);
  }

}
