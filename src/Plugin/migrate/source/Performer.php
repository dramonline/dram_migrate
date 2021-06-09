<?php

namespace Drupal\dram_migrate\Plugin\migrate\source;

use Drupal\migrate\Row;
use Drupal\migrate\Plugin\migrate\source\SqlBase;

/**
 * Minimalistic example for a SqlBase source plugin.
 *
 * @MigrateSource(
 *   id = "performer"
 * )
 */
class Performer extends SqlBase {

  /**
   * {@inheritdoc}
   */
  public function query() {
    $query = $this->select('artist_item', 'ai')
      ->fields('ai', [
        'id',
        'artist_id',
        'function_id',
        'instrument_id',
        'item_id',
        'item_table',
        'ancillary'
      ])
      // ->condition('item_table', 'track', '=')
      ->orderBy('id','ASC');

      return $query;
  }

  /**
   * {@inheritdoc}
   */
  public function fields() {
    $fields = [
      'id' => $this->t('Unique identifier')
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
        'alias' => 'id'
      ],
    ];
}
}

