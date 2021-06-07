<?php

namespace Drupal\dram_migrate\Plugin\migrate\source;

use Drupal\migrate\Plugin\migrate\source\SqlBase;

/**
 * Minimalistic example for a SqlBase source plugin.
 *
 * @MigrateSource(
 *   id = "ensemble"
 * )
 */
class Ensemble extends SqlBase {


  /**
   * {@inheritdoc}
   */
  public function query() {
    $query = $this->select('ensemble_test', 'e')
      ->fields('e', [
        'id',
        'legacy_id',
        'url_code',
        'name',
        'active',
        'type'
      ]);

    return $query;
  }

  /**
   * {@inheritdoc}
   */
  public function fields() {
    $fields = [
      'id' => $this->t('DRAM identifier')
    ];
    return $fields;
  }

  /**
   * {@inheritdoc}
   */
  public function getIds() {
    return [
      'id' => [
        'type' => 'integer',
        'alias' => 'e',
      ],
    ];
  }
}
