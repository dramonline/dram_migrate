<?php

namespace Drupal\migrate_sa\Plugin\migrate\source;

use Drupal\migrate\Plugin\migrate\source\SqlBase;

/**
 * Minimalistic example for a SqlBase source plugin.
 *
 * @MigrateSource(
 *   id = "category"
 * )
 */
class Category extends SqlBase {

  /**
   * {@inheritdoc}
   */
  public function query() {
    $query = $this->select('instrument', 'i')
      ->fields('i', [
        'id',
        'name',
        'category',
      ]
    );
    return $query;
  }

  /**
   * (@inheritdoc)
   */
  public function fields() {
    $fields = ['category' => $this->t('Category')];

    return $fields;
  }

  /**
   * {@inheritdoc}
   */
  public function getIds() {
    return ['category' => ['type' => 'text', 'alias' => 'i']];
  }

}
