<?php

namespace ResponsiveMenuPro\Factories;
use ResponsiveMenuPro\Mappers\JsMapper;
use ResponsiveMenuPro\Formatters\Minify;
use ResponsiveMenuPro\Collections\OptionsCollection;

class JsFactory {

  public function __construct(JsMapper $mapper, Minify $minifier) {
    $this->mapper = $mapper;
    $this->minifier = $minifier;
  }

  public function build(OptionsCollection $options) {

    $js = $this->mapper->map($options);

    if($options['minify_scripts'] == 'on')
      $js = $this->minifier->minify($js);

    return $js;

  }
  
}
