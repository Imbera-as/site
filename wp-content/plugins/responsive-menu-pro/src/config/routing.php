<?php

if(is_admin()):
  add_action('admin_menu', function() use($container) {

    if(isset($_POST['responsive_menu_pro_submit'])):
      $method = 'update';
    elseif(isset($_POST['responsive_menu_pro_reset'])):
      $method = 'reset';
    elseif(isset($_POST['responsive_menu_pro_export'])):
      $controller = $container['admin_controller'];
      $controller->export();
    elseif(isset($_POST['responsive_menu_pro_add_license_key'])):
      $method = 'addLicense';
    elseif(isset($_POST['responsive_menu_pro_import'])):
      $method = 'import';
    else:
      $method = 'index';
    endif;

  add_menu_page(
    'Responsive Menu Pro',
    'Responsive Menu Pro',
    'manage_options',
    'responsive-menu-pro',
    function() use ($method, $container) {
      $controller = $container['admin_controller'];
      switch ($method) :
        case 'update':
          $controller->$method($container['default_options'], $_POST['menu']);
          break;
        case 'reset':
          $controller->$method($container['default_options']);
          break;
        case 'import':
          $file = $_FILES['responsive_menu_pro_import_file'];
          $file_options = isset($file['tmp_name']) ? (array) json_decode(file_get_contents($file['tmp_name'])) : null;
          $controller->$method($container['default_options'], $file_options);
          break;
        default:
          $controller->$method();
          break;
      endswitch;
    },
    'dashicons-menu'
  );

  });
else:
  if(isset($_GET['responsive-menu-pro-preview']) && isset($_POST['menu'])):
    add_action('template_redirect', function() use($container) {
      $container['front_controller']->preview($_POST['menu']);
    });
  else:
    add_action('template_redirect', function() use($container) {
      $container['front_controller']->index();
    });
  endif;
endif;
