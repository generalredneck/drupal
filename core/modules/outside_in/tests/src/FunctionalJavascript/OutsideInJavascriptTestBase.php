<?php

namespace Drupal\Tests\outside_in\FunctionalJavascript;

use Drupal\FunctionalJavascriptTests\JavascriptTestBase;

/**
 * Base class contains common test functionality for the Outside-In module.
 */
abstract class OutsideInJavascriptTestBase extends JavascriptTestBase {

  /**
   * Enables a theme.
   *
   * @param string $theme
   *   The theme.
   */
  public function enableTheme($theme) {
    // Enable the theme.
    \Drupal::service('theme_installer')->install([$theme]);
    $theme_config = \Drupal::configFactory()->getEditable('system.theme');
    $theme_config->set('default', $theme);
    $theme_config->save();
  }

  /**
   * Waits for Off-canvas tray to open.
   */
  protected function waitForOffCanvasToOpen() {
    $this->waitForElement('#offcanvas');
  }

  /**
   * Waits for Off-canvas tray to close.
   */
  protected function waitForOffCanvasToClose() {
    $condition = "(jQuery('#offcanvas').length == 0)";
    $this->assertJsCondition($condition);
  }

  /**
   * Waits for an element to appear on the page.
   *
   * @param string $selector
   *   CSS selector.
   * @param int $timeout
   *   (optional) Timeout in milliseconds, defaults to 1000.
   */
  protected function waitForElement($selector, $timeout = 1000) {
    $condition = "(jQuery('$selector').length > 0)";
    $this->assertJsCondition($condition, $timeout);
  }

  /**
   * Gets the Off-Canvas tray element.
   *
   * @return \Behat\Mink\Element\NodeElement|null
   */
  protected function getTray() {
    return $this->getSession()->getPage()->findById('offcanvas');
  }

}