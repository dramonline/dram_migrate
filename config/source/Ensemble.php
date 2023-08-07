<?php

namespace Drupal\migrate_sa\Plugin\migrate\source;

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
    $query = $this->select('ensemble', 'e')
      ->fields('e', [
        'id',
        'legacy_id',
        'url_code',
        'name',
        'active',
        'type',
        'moving',
      ])->orderBy('name');

    return $query;
  }

  /**
   * {@inheritdoc}
   */
  public function fields() {
    $fields = [
      'id' => $this->t('DRAM identifier'),
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
