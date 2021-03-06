<?php

namespace ResponsiveMenuPro\Mappers;
use ResponsiveMenuPro\Collections\OptionsCollection;

class JsMapper {

  public function map(OptionsCollection $options) {

    $animation_speed = $options['animation_speed'] ? $options['animation_speed']->getValue() * 1000 : 500;

    $js = <<<JS

    jQuery(document).ready(function($) {

      var ResponsiveMenuPro = {
        trigger: '{$options['button_click_trigger']}',
        animationSpeed: {$animation_speed},
        breakpoint: {$options['breakpoint']},
        pushButton: '{$options['button_push_with_animation']}',
        animationType: '{$options['animation_type']}',
        animationSide: '{$options['menu_appear_from']}',
        pageWrapper: '{$options['page_wrapper']}',
        disableScrolling: '{$options['menu_disable_scrolling']}',
        isOpen: false,
        triggerTypes: 'click',
        activeClass: 'is-active',
        container: '#responsive-menu-pro-container',
        openClass: 'responsive-menu-pro-open',
        accordion: '{$options['accordion_animation']}',
        activeArrow: '{$options->getActiveArrow()}',
        inactiveArrow: '{$options->getInActiveArrow()}',
        wrapper: '#responsive-menu-pro-wrapper',
        closeOnBodyClick: '{$options['menu_close_on_body_click']}',
        closeOnLinkClick: '{$options['menu_close_on_link_click']}',
        itemTriggerSubMenu: '{$options['menu_item_click_to_trigger_submenu']}',
        linkElement: '.responsive-menu-pro-item-link',
        fadeLinksIn: '{$options['fade_submenus']}',
        isSingleMenu: '{$options['use_single_menu']}',
        useSlideEffects: '{$options['use_slide_effect']}',
        originalHeight: '',
        openMenu: function() {
          $(this.trigger).addClass(this.activeClass);
          $('html').addClass(this.openClass);
          $('.responsive-menu-pro-button-icon-active').hide();
          $('.responsive-menu-pro-button-icon-inactive').show();

          if(this.isSingleMenu == 'on'){
            $(this.container).removeClass('responsive-menu-pro-no-transition');
          }
          if(this.animationType != 'fade') {
            this.setWrapperTranslate();
          } else {
            this.fadeMenuIn();
          }
          if(this.fadeLinksIn == 'on') {
            $("#responsive-menu-pro > li").each(function(index) {
              $(this).show();
              $(this).animate({opacity: 0}, 0);
              $(this).delay({$options['fade_submenus_delay']}*index).animate({
                  'margin-left': "0",
                  'opacity': 1
              }, {$options['fade_submenus_speed']});
            });
          }
          if(this.useSlideEffects == 'on') {
            var self = this;
            $('#responsive-menu-pro').promise().done(function(){
              self.originalHeight = $('#responsive-menu-pro').height();
              $('#responsive-menu-pro').css({'height': self.originalHeight});
            });
          }
          this.isOpen = true;
        },
        closeMenu: function() {
          $(this.trigger).removeClass(this.activeClass);
          $('html').removeClass(this.openClass);
          $('.responsive-menu-pro-button-icon-inactive').hide();
          $('.responsive-menu-pro-button-icon-active').show();
          if(this.animationType != 'fade') {
            this.clearWrapperTranslate();
          } else {
            this.fadeMenuOut();
          }
          $("#responsive-menu-pro > li").removeAttr('style');
          this.isOpen = false;
        },
        triggerMenu: function() {
          this.isOpen ? this.closeMenu() : this.openMenu();
        },
        backUpSlide: function(backButton) {
          translate_to = parseInt($('#responsive-menu-pro')[0].style.transform.replace(/^\D+/g, '')) - 100;
          $('#responsive-menu-pro').css({'transform': 'translateX(-' + translate_to + '%)'});
          var previous_submenu_height = $(backButton).parent('ul').parent('li').parent('.responsive-menu-pro-submenu').height();
          if(!previous_submenu_height) {
            $('#responsive-menu-pro').css({'height': this.originalHeight});
          } else {
            $('#responsive-menu-pro').css({'height': previous_submenu_height + 'px'});
          }
        },
        triggerSubArrow: function(subarrow) {
          var sub_menu = $(subarrow).parent().next('.responsive-menu-pro-submenu');
          var self = this;

          if(this.useSlideEffects == 'on') {
            $('.responsive-menu-pro-subarrow-active').removeClass('responsive-menu-pro-subarrow-active');
            sub_menu.addClass('responsive-menu-pro-subarrow-active');
            sub_menu.parentsUntil('#responsive-menu-pro').addClass('responsive-menu-pro-subarrow-active');
            current_depth = $(subarrow).parent().parent().parent().data('depth');
            current_depth = typeof current_depth == 'undefined' ? 1 : current_depth;
            translation_amount = current_depth * 100;
            $('#responsive-menu-pro').css({'transform': 'translateX(-' + translation_amount + '%)'});
            $('#responsive-menu-pro').css({'height': sub_menu.height() + 'px'});
          } else {
            if(this.accordion == 'on') {
              /* Get Top Most Parent and the siblings */
              var top_siblings = sub_menu.parents('.responsive-menu-pro-item-has-children').last().siblings('.responsive-menu-pro-item-has-children');
              var first_siblings = sub_menu.parents('.responsive-menu-pro-item-has-children').first().siblings('.responsive-menu-pro-item-has-children');
              /* Close up just the top level parents to key the rest as it was */
              top_siblings.children('.responsive-menu-pro-submenu').slideUp(200, 'linear').removeClass('responsive-menu-pro-submenu-open');
              /* Set each parent arrow to inactive */
              top_siblings.each(function() {
                $(this).find('.responsive-menu-pro-subarrow').first().html(self.inactiveArrow);
                $(this).find('.responsive-menu-pro-subarrow').first().removeClass('responsive-menu-pro-subarrow-active');
              });
              /* Now Repeat for the current item siblings */
              first_siblings.children('.responsive-menu-pro-submenu').slideUp(200, 'linear').removeClass('responsive-menu-pro-submenu-open');
              first_siblings.each(function() {
                $(this).find('.responsive-menu-pro-subarrow').first().html(self.inactiveArrow);
                $(this).find('.responsive-menu-pro-subarrow').first().removeClass('responsive-menu-pro-subarrow-active');
              });
            }
            if(sub_menu.hasClass('responsive-menu-pro-submenu-open')) {
              sub_menu.slideUp(200, 'linear',function() {
                $(this).css('display', '');
              }).removeClass('responsive-menu-pro-submenu-open');
              $(subarrow).html(this.inactiveArrow);
              $(subarrow).removeClass('responsive-menu-pro-subarrow-active');
            } else {
              sub_menu.slideDown(200, 'linear').addClass('responsive-menu-pro-submenu-open');
              $(subarrow).html(this.activeArrow);
              $(subarrow).addClass('responsive-menu-pro-subarrow-active');
            }
          }
        },
        menuHeight: function() {
          return $(this.container).height();
        },
        menuWidth: function() {
          return $(this.container).width();
        },
        wrapperHeight: function() {
          return $(this.wrapper).height();
        },
        setWrapperTranslate: function() {
          switch(this.animationSide) {
            case 'left':
              translate = 'translateX(' + this.menuWidth() + 'px)'; break;
            case 'right':
              translate = 'translateX(-' + this.menuWidth() + 'px)'; break;
            case 'top':
              translate = 'translateY(' + this.wrapperHeight() + 'px)'; break;
            case 'bottom':
              translate = 'translateY(-' + this.menuHeight() + 'px)'; break;
            }
            if(this.animationType == 'push') {
              $(this.pageWrapper).css({'transform':translate});
              $('html, body').css('overflow-x', 'hidden');
            }
            if(this.pushButton == 'on') {
              $('#responsive-menu-pro-button').css({'transform':translate});
            }
        },
        clearWrapperTranslate: function() {
          var self = this;
          if(this.animationType == 'push') {
            $(this.pageWrapper).css({'transform':''});
            setTimeout(function() {
              $('html, body').css('overflow-x', '');
            }, self.animationSpeed);
          }
          if(this.pushButton == 'on') {
            $('#responsive-menu-pro-button').css({'transform':''});
          }
        },
        fadeMenuIn: function() {
          $(this.container).fadeIn(this.animationSpeed);
        },
        fadeMenuOut: function() {
          $(this.container).fadeOut(this.animationSpeed);
        },
        init: function() {
          var self = this;
          if(this.disableScrolling == 'on') {
            $('body > *').not('#responsive-menu-pro-container, #responsive-menu-pro-overlay, #responsive-menu-pro-mask').wrapAll('<div id="responsive-menu-pro-noscroll-wrapper"></div>');
          }
          $(this.trigger).on(this.triggerTypes, function(e){
            e.stopPropagation();
            self.triggerMenu();
          });
          $('.responsive-menu-pro-subarrow').on('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            self.triggerSubArrow(this);
          });
          $(window).resize(function() {
            if($(window).width() > self.breakpoint) {
              if(self.isOpen){
                  self.closeMenu();
              }
              $('.responsive-menu-pro-submenu').removeAttr('style');
            } else {
              if(self.isSingleMenu == 'on'){
                $(self.container).addClass('responsive-menu-pro-no-transition');
              }
              if($('.responsive-menu-pro-open').length>0){
                self.setWrapperTranslate();
              }
            }
          });
          if(this.closeOnLinkClick == 'on') {
            $(this.linkElement).on('click', function(e) {
              if($(window).width() < self.breakpoint) {
                e.preventDefault();
                /* Fix for when close menu on parent clicks is on */
                if(self.itemTriggerSubMenu == 'on' && $(this).is('.responsive-menu-pro-item-has-children > ' + self.linkElement)) {
                  return;
                }
                old_href = $(this).attr('href');
                old_target = typeof $(this).attr('target') == 'undefined' ? '_self' : $(this).attr('target');
                if(self.isOpen) {
                  if($(e.target).closest('.responsive-menu-pro-subarrow').length) {
                    return;
                  }
                  if(typeof old_href != 'undefined') {
                    self.closeMenu();
                    setTimeout(function() {
                      window.open(old_href, old_target);
                    }, self.animationSpeed);
                  }
                }
              }
            });
          }
          if(this.closeOnBodyClick == 'on') {
            $(document).on('click', 'body', function(e) {
              if(self.isOpen) {
                if($(e.target).closest('#responsive-menu-pro-container').length || $(e.target).closest('#responsive-menu-pro-button').length) {
                  return;
                }
              }
              self.closeMenu();
            });
          }
          if(this.itemTriggerSubMenu == 'on') {
            $('.responsive-menu-pro-item-has-children > ' + this.linkElement).on('click', function(e) {
              e.preventDefault();
              self.triggerSubArrow($(this).children('.responsive-menu-pro-subarrow').first());
            });
          }
          if(this.useSlideEffects == 'on') {
            $('.responsive-menu-pro-back').on('click', function() {
              self.backUpSlide(this);
            });
          }
        }
      };
      ResponsiveMenuPro.init();
    });

JS;

  return $js;

  }

}
