<?php

add_action('plugins_loaded', function() {
  load_plugin_textdomain('responsive-menu-pro', false, basename(dirname(dirname(dirname(__FILE__)))) . '/translations/');
});

if(is_admin()):
    /*
    Polylang Integration Section */
    add_action('plugins_loaded', function() use($container) {
      if(function_exists('pll_register_string')):
        $repo = $container['option_repository'];
        $options = $repo->all();

        $menu_to_use = isset($options['menu_to_use']) ? $options['menu_to_use']->getValue() : '';
        $button_title = isset($options['button_title']) ? $options['button_title']->getValue() : '';
        $menu_title = isset($options['menu_title']) ? $options['menu_title']->getValue() : '';
        $menu_title_link = isset($options['menu_title_link']) ? $options['menu_title_link']->getValue() : '';
        $menu_additional_content = isset($options['menu_additional_content']) ? $options['menu_additional_content']->getValue() : '';
        $menu_search_box_text = isset($options['menu_search_box_text']) ? $options['menu_search_box_text']->getValue() : '';
        $header_bar_logo_link = isset($options['header_bar_logo_link']) ? $options['header_bar_logo_link']->getValue() : '';

        pll_register_string('menu_to_use', $menu_to_use, 'Responsive Menu Pro');
        pll_register_string('button_title', $button_title, 'Responsive Menu Pro');
        pll_register_string('menu_title', $menu_title, 'Responsive Menu Pro');
        pll_register_string('menu_title_link', $menu_title_link, 'Responsive Menu Pro');
        pll_register_string('menu_additional_content', $menu_additional_content, 'Responsive Menu Pro');
        pll_register_string('menu_search_box_text', $menu_search_box_text, 'Responsive Menu Pro');
        pll_register_string('header_bar_logo_link', $header_bar_logo_link, 'Responsive Menu Pro');
      endif;
    });
endif;
