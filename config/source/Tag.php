<?php

namespace Drupal\migrate_sa\Plugin\migrate\source;

use Drupal\migrate\Plugin\migrate\source\SqlBase;

/**
 * Minimalistic example for a SqlBase source plugin.
 *
 * @MigrateSource(
 *   id = "tag"
 * )
 */
class Tag extends SqlBase {

  /**
   * {@inheritdoc}
   */
  public function query() {
    $query = $this->select('tag', 't')
      ->fields('t', [
        'id',
        'tag',
      ]
    );
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
        'alias' => 't',
      ],
    ];
  }

}
