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
 *   id = "track"
 * )
 */
class Track extends SqlBase {

  /**
   * {@inheritdoc}
   */
  public function query() {
    $query = $this->select('track', 't')
      ->fields('t', [
          'title',
          'id',
          'legacy_id'
        ]);
    return $query;
  }

  /**
   * {@inheritdoc}
   */
  public function fields() {
    $fields = [
      'title' => $this->t('title'),
      'id' => $this->t('track_dram_id' ),
      'legacy_id'   => $this->t('track_legacy_id' )
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