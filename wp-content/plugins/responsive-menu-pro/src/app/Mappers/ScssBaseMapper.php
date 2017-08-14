<?php

namespace ResponsiveMenuPro\Mappers;
use ResponsiveMenuPro\Collections\OptionsCollection;

class ScssBaseMapper extends ScssMapper {

  public function map(OptionsCollection $options) {

    $css = <<<CSS

      @if '{$options['menu_disable_scrolling']}' == 'on' {
        #responsive-menu-pro-overlay {
          left: 0;
          top: 0px;
          right: 0px;
          bottom: 0px;
          width: 0;
          position: fixed;
        }
        .responsive-menu-pro-open #responsive-menu-pro-overlay {
          width: 100%;
        }
        #responsive-menu-pro-noscroll-wrapper {
          height: 100%;
          overflow-y: scroll;
          overflow-x: hidden;
          position: relative;
        }
        html,
        body {
          height: 100%;
        }
      }

      #responsive-menu-pro-mask {
        position: fixed;
        z-index: 99997;
        top: 0;
        left: 0;
        overflow: hidden;
        width: 0;
        height: 0;
        background-color: rgba(0,0,0,0);
        .responsive-menu-pro-open & {
          width: 100%;
          height: 100%;
        }
      }

      button#responsive-menu-pro-button,
      #responsive-menu-pro-container {
        display: none;
        -webkit-text-size-adjust: 100%;
      }

      #responsive-menu-pro-header {
        width: 100%;
        padding: 0 5%;
        box-sizing: border-box;
        top: 0;
        right: 0;
        left: 0;
        display: none;
        z-index: 99998;
        .responsive-menu-pro-header-box {
          display: inline-block;
          &, & img {
            vertical-align: middle;
            max-width: 100%;
          }
        }
        button#responsive-menu-pro-button {
          position: relative;
          margin: 0;
          left: auto;
          right: auto;
          bottom: auto;
        }
        .responsive-menu-pro-header-box {
          margin-right: 2%;
        }
      }

      #responsive-menu-pro-container {
        z-index: 99998;
      }

      @media screen and (max-width: {$options['breakpoint']}px) {

        #responsive-menu-pro-container {
          display: block;
        }

      #responsive-menu-pro-container {
        position: fixed;
        top: 0;
        bottom: 0;
        /* Fix for scroll bars appearing when not needed */
        padding-bottom: 5px;
        margin-bottom: -5px;
        outline: 1px solid transparent;
        overflow-y: auto;
        overflow-x: hidden;
        .responsive-menu-pro-search-box {
          width: 100%;
          padding: 0 2%;
          border-radius: 2px;
          height: 50px;
          -webkit-appearance: none;
        }

        &.push-left,
        &.slide-left {
          transform: translateX(-100%);
          -ms-transform: translateX(-100%);
          -webkit-transform: translateX(-100%);
          -moz-transform: translateX(-100%);
          .responsive-menu-pro-open & {
            transform: translateX(0);
            -ms-transform: translateX(0);
            -webkit-transform: translateX(0);
            -moz-transform: translateX(0);
          }
        }

        &.push-top,
        &.slide-top {
          transform: translateY(-100%);
          -ms-transform: translateY(-100%);
          -webkit-transform: translateY(-100%);
          -moz-transform: translateY(-100%);
          .responsive-menu-pro-open & {
            transform: translateY(0);
            -ms-transform: translateY(0);
            -webkit-transform: translateY(0);
            -moz-transform: translateY(0);
          }
        }

        &.push-right,
        &.slide-right {
          transform: translateX(100%);
          -ms-transform: translateX(100%);
          -webkit-transform: translateX(100%);
          -moz-transform: translateX(100%);
          .responsive-menu-pro-open & {
            transform: translateX(0);
            -ms-transform: translateX(0);
            -webkit-transform: translateX(0);
            -moz-transform: translateX(0);
          }
        }

        &.push-bottom,
        &.slide-bottom {
          transform: translateY(100%);
          -ms-transform: translateY(100%);
          -webkit-transform: translateY(100%);
          -moz-transform: translateY(100%);
          .responsive-menu-pro-open & {
            transform: translateY(0);
            -ms-transform: translateY(0);
            -webkit-transform: translateY(0);
            -moz-transform: translateY(0);
          }
        }

        // Reset Styles for all our elements
        &, &:before, &:after, & *, & *:before, & *:after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
          }

        #responsive-menu-pro-search-box,
        #responsive-menu-pro-additional-content,
        #responsive-menu-pro-title {
          padding: 25px 5%;
        }

        #responsive-menu-pro {
          &, ul {
            width: 100%;
          }
          & ul.responsive-menu-pro-submenu {
            display: none;
            &.responsive-menu-pro-submenu-open {
              display: block;
            }
          }
          @if '{$options['use_slide_effect']}' == 'off' {
            @for \$i from 1 through 6 {
              & ul.responsive-menu-pro-submenu-depth-#{\$i}
              a.responsive-menu-pro-item-link {
                  padding-{$options['menu_text_alignment']}: 5% + (5% * \$i);
              }
            }
          }

        }

        li.responsive-menu-pro-item {
          width: 100%;
          list-style: none;
          a {
            width: 100%;
            display: block;
            text-decoration: none;
            padding: 0 5%;
            position: relative;
            .fa {
              margin-right: 15px;
            }
            .responsive-menu-pro-subarrow {
              position: absolute;
              top: 0;
              bottom: 0;
              text-align: center;
              overflow: hidden;
              .fa {
                margin-right: 0;
              }
            }
          }
        }
      }

      button#responsive-menu-pro-button {
        .responsive-menu-pro-button-icon-inactive {
          display: none;
        }
      }

      button#responsive-menu-pro-button {
        z-index: 99999;
        display: none;
        overflow: hidden;
        img {
          max-width: 100%;
        }
      }

      .responsive-menu-pro-label {
        display: inline-block;
        font-weight: 600;
        margin: 0 5px;
        vertical-align: middle;
      }

      .responsive-menu-pro-accessible {
        display: inline-block;
      }

      .responsive-menu-pro-accessible .responsive-menu-pro-box {
        display: inline-block;
        vertical-align: middle;
      }

      .responsive-menu-pro-label.responsive-menu-pro-label-top,
      .responsive-menu-pro-label.responsive-menu-pro-label-bottom
      {
        display: block;
        margin: 0 auto;
      }

    }
CSS;

    return $this->compiler->compile($css);
  }

}
