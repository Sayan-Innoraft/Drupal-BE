<?php

namespace Drupal\module2\Controller;

use \Drupal\Core\Controller\ControllerBase;

/**
 * An example controller.
 */
class Module2Controller extends ControllerBase {

  /**
   * Returns a render array for a test page.
   *
   * @return []
   */
  public function hello() {
    return [
      '#theme' => 'greet_theme',
      '#name' => \Drupal::currentUser()->getAccountName(),
    ];
  }
}
