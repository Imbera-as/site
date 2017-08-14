<?php

namespace ResponsiveMenuPro\Database;
use ResponsiveMenuPro\Collections\OptionsCollection;
use ResponsiveMenuPro\Database\Database;
use ResponsiveMenuPro\Services\OptionService;

class Migration {

	protected $db;

  protected $current_version;
  protected $old_version;
  protected $old_options;
  protected $defaults;

  protected static $table = 'responsive_menu_pro';
  protected static $version_var = 'responsive_menu_pro_version';

	public function __construct(Database $db, OptionService $service, $defaults, $current_version, $old_version, $old_options) {
    $this->db = $db;
		$this->service = $service;
    $this->defaults = $defaults;
    $this->current_version = $current_version;
    $this->old_version = $old_version;
    $this->old_options = $old_options;
	}

	public function addNewOptions() {
    $options = $this->service->all();
    if($options->isEmpty())
      $this->service->createOptions($this->defaults);
    else
	    $this->service->createOptions($this->getNewOptions($options));
	}

	public function tidyUpOptions() {
    foreach($this->getOptionsToDelete() as $delete)
      $this->db->delete(self::$table, array('name' => $delete));
	}

  public function getNewOptions(OptionsCollection $options) {
    $current = [];
    foreach($options->all() as $converted)
      $current[$converted->getName()] = $converted->getValue();
    return array_diff_key($this->defaults, $current);
  }

  public function setup() {
    if(!$this->isVersion3()):
      $this->db->createTable(self::$table);
      $this->synchronise();
    endif;
	}

	public function synchronise() {

    # First Thing we need to do is migrate any old options
    if($this->old_options && !$this->isVersion3())
      $this->migrateVersion2Options();

    if($this->needsUpdate()):

      # Now we can add any new options
  		$this->addNewOptions();

      # Finally delete any that are no longer used
      $this->tidyUpOptions();

      # And Update Version
			$this->updateVersion();

    endif;

	}

	public function needsUpdate() {
		return version_compare($this->old_version, $this->current_version, '<');
	}

	protected function updateVersion() {
		$this->db->updateOption(self::$version_var, $this->current_version);
    $this->old_version = $this->current_version;
	}

  public function isVersion3() {
    return substr($this->old_version, 0, 1) == 3;
  }

  public function migrateVersion2Options() {
    $this->service->createOptions($this->getMigratedOptions());
    $this->addNewOptions();
    $this->updateVersion();
  }

  public function getOptionsToDelete() {
    return array_diff(
          array_map(function($a) { return $a->getName(); }, $this->service->all()->all()),
          array_keys($this->defaults)
        );
  }

  public function getMigratedOptions() {
    $old_options = $this->old_options;

    $new_options = [
      'menu_to_use' => isset($old_options['menu']) ? $old_options['menu'] : '',
      'breakpoint' => isset($old_options['breakpoint']) ? $old_options['breakpoint'] : '',
      'menu_depth' => isset($old_options['depth']) ? $old_options['depth'] : '',
      'button_top' => isset($old_options['top']) ? $old_options['top'] : '',
      'button_distance_from_side' => isset($old_options['right']) ? $old_options['right'] : '',
      'menu_to_hide' => isset($old_options['css']) ? $old_options['css'] : '',
      'menu_title' => isset($old_options['title']) ? $old_options['title'] : '',
      'button_line_colour' => isset($old_options['button_line_colour']) ? $old_options['button_line_colour'] : '',
      'button_background_colour' => isset($old_options['button_background_colour']) ? $old_options['button_background_colour'] : '',
      'button_title' => isset($old_options['button_text']) ? $old_options['button_text'] : '',
      'button_transparent_background' => isset($old_options['is_button_background_transparent']) ? 'on' : '',
      'menu_font' => isset($old_options['font']) ? $old_options['font'] : '',
      'button_position_type' => isset($old_options['is_fixed']) ? 'fixed' : '',
      'menu_title_image' => isset($old_options['title_image']) ? $old_options['title_image'] : '',
      'menu_width' => isset($old_options['width']) ? $old_options['width'] : '',
      'menu_item_background_colour' => isset($old_options['background_colour']) ? $old_options['background_colour'] : '',
      'menu_background_colour' => isset($old_options['background_colour']) ? $old_options['background_colour'] : '',
      'menu_sub_arrow_background_colour' => isset($old_options['background_colour']) ? $old_options['background_colour'] : '',
      'menu_item_background_hover_colour' => isset($old_options['background_colour_hover']) ? $old_options['background_colour_hover'] : '',
      'menu_sub_arrow_background_hover_colour' => isset($old_options['background_colour_hover']) ? $old_options['background_colour_hover'] : '',
      'menu_title_colour' => isset($old_options['title_colour']) ? $old_options['title_colour'] : '',
      'menu_link_colour' => isset($old_options['text_colour']) ? $old_options['text_colour'] : '',
      'menu_sub_arrow_shape_colour' => isset($old_options['text_colour']) ? $old_options['text_colour'] : '',
      'menu_item_border_colour' => isset($old_options['link_border_colour']) ? $old_options['link_border_colour'] : '',
      'menu_item_border_colour_hover' => isset($old_options['link_border_colour']) ? $old_options['link_border_colour'] : '',
      'menu_sub_arrow_border_colour' => isset($old_options['link_border_colour']) ? $old_options['link_border_colour'] : '',
      'menu_sub_arrow_border_hover_colour' => isset($old_options['link_border_colour']) ? $old_options['link_border_colour'] : '',
      'menu_link_hover_colour' => isset($old_options['text_colour_hover']) ? $old_options['text_colour_hover'] : '',
      'menu_sub_arrow_shape_hover_colour' => isset($old_options['text_colour_hover']) ? $old_options['text_colour_hover'] : '',
      'menu_title_hover_colour' => isset($old_options['title_colour_hover']) ? $old_options['title_colour_hover'] : '',
      'animation_type' => isset($old_options['animation_type']) && $old_options['animation_type'] == 'push' ? 'push' : '',
      'page_wrapper' => isset($old_options['push_animation_container_css']) ? $old_options['push_animation_container_css'] : '',
      'menu_title_background_colour' => isset($old_options['title_background_colour']) ? $old_options['title_background_colour'] : '',
      'menu_title_background_hover_colour' => isset($old_options['title_background_colour']) ? $old_options['title_background_colour'] : '',
      'menu_font_size' => isset($old_options['link_text_size']) ? $old_options['link_text_size'] : '',
      'menu_title_font_size' => isset($old_options['title_text_size']) ? $old_options['title_text_size'] : '',
      'button_font_size' => isset($old_options['button_text_size']) ? $old_options['button_text_size'] : '',
      'menu_current_item_background_colour' => isset($old_options['current_page_link_background']) ? $old_options['current_page_link_background'] : '',
      'menu_current_link_colour' => isset($old_options['current_page_link_colour']) ? $old_options['current_page_link_colour'] : '',
      'animation_speed' => isset($old_options['animation_speed']) ? $old_options['animation_speed'] : '',
      'transition_speed' => isset($old_options['transition_speed']) ? $old_options['transition_speed'] : '',
      'menu_text_alignment' => isset($old_options['text_align']) ? $old_options['text_align'] : '',
      'auto_expand_all_submenus' => isset($old_options['auto_expand_submenus']) ? 'on' : '',
      'menu_links_height' => isset($old_options['link_height']) ? $old_options['link_height'] + 24 : '',
      'submenu_arrow_height' => isset($old_options['link_height']) ? $old_options['link_height']  + 24 : '',
      'submenu_arrow_width' => isset($old_options['link_height']) ? $old_options['link_height'] + 24 : '',
      'external_files' => isset($old_options['create_external_scripts']) ? 'on' : '',
      'menu_appear_from' => isset($old_options['slide_side']) ? $old_options['slide_side'] : '',
      'scripts_in_footer' => isset($old_options['scripts_in_footer']) ? 'on' : '',
      'button_image' => isset($old_options['button_image']) ? $old_options['button_image'] : '',
      'minify_scripts' => isset($old_options['minify']) ? 'on' : '',
      'menu_close_on_link_click' => isset($old_options['ignore_parent_clicks']) ? 'on' : '',
      'menu_minimum_width' => isset($old_options['min_width']) ? $old_options['min_width'] : '',
      'menu_maximum_width' => isset($old_options['max_width']) ? $old_options['max_width'] : '',
      'auto_expand_current_submenus' => isset($old_options['expand_parents']) ? 'on' : '',
      'menu_item_click_to_trigger_submenu' => isset($old_options['close_on_link_click']) ? 'on' : '',
      'menu_close_on_body_click' => isset($old_options['click_to_close']) ? 'on' : '',
      'menu_title_link' => isset($old_options['title_link']) ? $old_options['title_link'] : '',
      'menu_title_link_location' => isset($old_options['title_target']) ? $old_options['title_target'] : '',
      'menu_additional_content' => isset($old_options['html']) ? $old_options['html'] : '',
      'shortcode' => isset($old_options['use_shortcode']) ? 'on' : '',
      'button_line_height' => isset($old_options['line_height']) ? $old_options['line_height'] : '',
      'button_line_width' => isset($old_options['line_width']) ? $old_options['line_width'] : '',
      'button_line_margin' => isset($old_options['line_margin']) ? $old_options['line_margin'] : '',
      'button_image_when_clicked' => isset($old_options['button_image_clicked']) ? $old_options['button_image_clicked'] : '',
      'accordion_animation' => isset($old_options['use_accordion']) ? 'on' : '',
      'active_arrow_shape' => isset($old_options['arrow_shape_active']) ? json_decode($old_options['arrow_shape_active']) : '',
      'inactive_arrow_shape' => isset($old_options['arrow_shape_inactive']) ? json_decode($old_options['arrow_shape_inactive']) : '',
      'active_arrow_image' => isset($old_options['array_image_active']) ? $old_options['array_image_active'] : '',
      'inactive_arrow_image' => isset($old_options['arrow_image_inactive']) ? $old_options['arrow_image_inactive'] : '',
      'menu_current_item_background_hover_colour' => isset($old_options['current_background_hover']) ? $old_options['current_background_hover'] : '',
      'menu_current_link_hover_colour' => isset($old_options['current_colour_hover']) ? $old_options['current_colour_hover'] : '',
      'custom_walker' => isset($old_options['walker']) ? $old_options['walker'] : '',
      'button_left_or_right' => isset($old_options['location']) ? $old_options['location'] : '',
      'theme_location_menu' => isset($old_options['theme_location']) ? $old_options['theme_location'] : '',
      'button_title_position' => isset($old_options['click_title_position']) ? $old_options['click_title_position'] : '',
      'header_bar_logo_link' => isset($old_options['header_bar_logo_link']) ? $old_options['header_bar_logo_link'] : '',
      'custom_css' => isset($old_options['custom_css']) ? $old_options['custom_css'] : '',
      'menu_search_box_text' => isset($old_options['search_text']) ? $old_options['search_text'] : '',
      'menu_word_wrap' => isset($old_options['word_wrap']) ? 'on' : 'off',
      'menu_disable_scrolling' => isset($old_options['disable_scrolling']) ? 'on' : '',
      'single_menu_item_link_colour_hover' => isset($old_options['single_menu_link_colour_hover']) ? $old_options['single_menu_link_colour_hover'] : '',
      'single_menu_link_colour' => isset($old_options['single_menu_link_colour']) ? $old_options['single_menu_link_colour'] : '',
      'single_menu_item_submenu_link_colour' => isset($old_options['single_menu_link_colour']) ? $old_options['single_menu_link_colour'] : '',
      'single_menu_item_submenu_link_colour_hover' => isset($old_options['single_menu_link_colour_hover']) ? $old_options['single_menu_link_colour_hover'] : '',
      'single_menu_height' => isset($old_options['single_menu_height']) ? $old_options['single_menu_height'] : '',
      'header_bar_background_color' => isset($old_options['header_bar_background_colour']) ? $old_options['header_bar_background_colour'] : '',
      'header_bar_height' => isset($old_options['header_bar_height']) ? $old_options['header_bar_height'] : '',
      'header_bar_html_content' => isset($old_options['header_bar_html']) ? $old_options['header_bar_html'] : '',
      'header_bar_logo' => isset($old_options['header_bar_logo']) ? $old_options['header_bar_logo'] : '',
      'use_header_bar' => isset($old_options['use_header_bar']) ? 'on' : '',
      'menu_auto_height' => isset($old_options['set_auto_menu_height']) ? $old_options['set_auto_menu_height'] : '',
      'use_single_menu' => isset($old_options['use_single_site_menu']) ? 'on' : '',
      'mobile_only' => isset($old_options['use_only_on_mobile']) ? 'on' : '',
    ];

    $to_save = [];

    foreach(array_filter($new_options) as $key => $val)
      $to_save[$key] = $val;

    return $to_save;
  }

}
