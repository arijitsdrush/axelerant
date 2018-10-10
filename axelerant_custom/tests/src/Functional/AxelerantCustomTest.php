<?php

namespace Drupal\Tests\axelerant_custom\Functional;

use Drupal\Core\Url;
use Drupal\Tests\BrowserTestBase;
use Drupal\simpletest\NodeCreationTrait;

/**
 * Simple test to ensure that module works correct.
 *
 * @group axelerant_custom
 */
class AxelerantCustomTest extends BrowserTestBase {

  use NodeCreationTrait;
  /**
   * Modules to enable.
   *
   * @var array
   */
  public static $modules = ['axelerant_custom', 'node', 'path'];

  /**
   * A user with permission to administer site configuration.
   *
   * @var \Drupal\user\UserInterface
   */
  protected $user;

  /**
   * {@inheritdoc}
   */
  protected function setUp() {
    parent::setUp();
    $this->user = $this->drupalCreateUser([
      'administer site configuration',
      'administer nodes',
      'bypass node access',
      'access content overview',
    ]);

    $this->drupalLogin($this->user);
  }

  /**
   * Tests that site info save with API key.
   */
  public function testFormsave() {

    // Check if form saves correctlly.
    $this->drupalGet(Url::fromRoute('system.site_information_settings'));
    $this->assertSession()->statusCodeEquals(200);
    $edit = [
      'site_name' => 'Test',
      'site_mail' => 'test@guest.com',
      'siteapikey' => 'testingnow',
    ];
    $submit = 'Save configuration';
    $form_html_id = 'system-site-information-settings';
    $this->submitForm($edit, $submit, $form_html_id);

    // Set config.
    \Drupal::configFactory()->getEditable('axelerant_custom.settings')->set('siteapikey', 'testingnow')->save();

    // Article should not be displayed.
    $article = $this->createNode(['title' => 'Test article', 'type' => 'article']);
    $this->drupalGet('/page_json/testingnow/' . $article->id());
    $this->assertSession()->statusCodeEquals(403);

    // Page should be displayed.
    $page = $this->createNode(['title' => 'Test page', 'type' => 'page']);
    $this->drupalGet('/page_json/testingnow/' . $page->id());
    $this->assertSession()->statusCodeEquals(200);

    // Wrong api key should not be displayed.
    $wrong_key = $this->createNode(['title' => 'Test page', 'type' => 'page']);
    $this->drupalGet('/page_json/No_API_key_yet/' . $wrong_key->id());
    $this->assertSession()->statusCodeEquals(403);
  }

}
