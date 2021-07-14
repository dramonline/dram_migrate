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
      ]);
    $query->innerJoin('person', 'p', 'ai.artist_id = p.id');
    $query->innerJoin('track', 't', 't.id = ai.item_id');
    $query->condition('function_id', '4', '<>');
    $query->condition('item_table', 'track', '=');
    $query->condition('t.label_id', '36398', '<>')->orderBy('item_id','ASC')->orderBy('p.artist_lname')->orderBy('p.artist_fname');

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

