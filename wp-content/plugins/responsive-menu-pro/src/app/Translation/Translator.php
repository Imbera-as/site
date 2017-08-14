<?php

namespace ResponsiveMenuPro\Translation;
use ResponsiveMenuPro\Models\Option;
use ResponsiveMenuPro\Collections\OptionsCollection;

class Translator {

  private $translatables = [
      'menu_to_use',
      'button_title',
      'menu_title',
      'menu_title_link',
      'menu_additional_content',
      'menu_search_box_text',
      'header_bar_logo_link'
  ];

  public function translate(Option $option) {

    // WPML Support
    $translated = apply_filters('wpml_translate_single_string', $option->getValue(), 'Responsive Menu Pro', $option->getName());

    // Polylang Support
    $translated = function_exists('pll__') ? pll__($translated) : $translated;

    return $translated;
  }

  public function searchUrl() {
    return function_exists('icl_get_home_url') ? icl_get_home_url() : get_home_url();
  }

  public function saveTranslations(OptionsCollection $options) {
    foreach($this->translatables as $option_name)
      if(isset($options[$option_name]))
        do_action('wpml_register_single_string', 'Responsive Menu Pro', $option_name, $options[$option_name]->getValue());
  }

  public function allowShortcode($text) {
    return do_shortcode($text);
  }

}
