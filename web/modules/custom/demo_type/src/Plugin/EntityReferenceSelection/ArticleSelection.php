<?php

namespace Drupal\demo_type\Plugin\EntityReferenceSelection;

use Drupal\Core\Form\FormStateInterface;
use Drupal\node\Plugin\EntityReferenceSelection\NodeSelection;

/**
 * Provides specific access control for the node entity type.
 *
 * @EntityReferenceSelection(
 *   id = "demo_type_article_node",
 *   label = @Translation("Chemical constituent selection"),
 *   entity_types = {"node"},
 *   group = "demo_type_article_node",
 *   weight = 5
 * )
 */
class ArticleSelection extends NodeSelection {

  /**
   * {@inheritdoc}
   */
  public function defaultConfiguration() {
    return [
      // For the 'target_bundles' setting, a NULL value is equivalent to "allow
      // entities from any bundle to be referenced" and an empty array value is
      // equivalent to "no entities from any bundle can be referenced".
      'target_bundles' => ['article'],
    ] + parent::defaultConfiguration();
  }

  /**
   * {@inheritdoc}
   */
  public function buildConfigurationForm(array $form, FormStateInterface $form_state) {
    $form = parent::buildConfigurationForm($form, $form_state);
    \Drupal::logger('demo_type')->info(json_encode($form));
    $options = $form['target_bundles']['#options'];
    $new_options = ['article' => $options['article']];
    $form['target_bundles']['#options'] = $new_options;
    $form['target_bundles']['#disabled'] = TRUE;
    $form['auto_create']['#access'] = FALSE;

    return $form;
  }

}
