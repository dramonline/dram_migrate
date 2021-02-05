<?php

/**
 * @file
 * Contains Drupal\migrate_dram\Plugin\migrate\source\Track
 */

namespace Drupal\migrate_dram\Plugin\migrate\source;

use Drupal\migrate\Plugin\migrate\source\SqlBase;
use Drupal\migrate\Row;

/**
 * Minimalistic example for a SqlBase source plugin.
 *
 * @MigrateSource(
 *   id = "album"
 * )
 */
class Album extends SqlBase {

  /**
   * {@inheritdoc}
   */
  public function query() {
    $query = $this->select('album', 'a')
      ->fields('a', [
          'id',
          'active',
          'title',
          'display_subtitle',
          'label_id'
        ]);
      return $query;
  }

  /**
   * {@inheritdoc}
   */
  public function fields() {
    $fields = [
      'id' => $this->t('DRAM identifier' ),
      'active' => $this->t('Is active' ),
      'title' => $this->t('Album title'),
      'display_subtitle' => $this->t('Album subtitle'),
      'label_id' => $this->t('Label identifier'),
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
        'alias' => 'a',
      ],
    ];
  }
}
