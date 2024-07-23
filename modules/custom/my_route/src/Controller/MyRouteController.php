<?php

declare(strict_types=1);

namespace Drupal\my_route\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Returns responses for My route routes.
 */
final class MyRouteController extends ControllerBase {

  /**
   * Builds the response.
   */
  public function hello($id) {
    return [
      '#markup' => "The value of the parameter is $id"
    ];
  }

}
