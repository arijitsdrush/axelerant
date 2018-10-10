<?php

namespace Drupal\axelerant_custom\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\node\NodeInterface;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Class AxelearentCustomController.
 */
class AxelearentCustomController extends ControllerBase {

  /**
   * Index.
   *
   * @return string
   *   Return Node data in JSON or permission denied.
   */
  public function index($apikey, NodeInterface $nid) {

    $config = \Drupal::config('axelerant_custom.settings');
    // When no API key avilable set value null.
    $saved_apikey = $config->get('siteapikey') == "No API key yet" ? "" : $config->get('siteapikey');
    // If API Key match and content type is page.
    if ($apikey == $saved_apikey && $nid->getType() == "page") {
      $node = $nid->toArray();
      return new JsonResponse($node, 200, ['Content-Type' => 'application/json']);
    }
    else {
      $data = ["403" => "Access denied"];
      return new JsonResponse($data, 403, ['Content-Type' => 'application/json']);
    }
  }

}
