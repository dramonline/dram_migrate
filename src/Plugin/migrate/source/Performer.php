<?php

namespace Drupal\dram_migrate\Plugin\migrate\source;

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
        'item_table',
        'weight',
        'hidden'
      ]);
    $query->join('track', 't', 'ai.item_id = t.id');
    $query->fields('t', [
      'id',
      'title',
    ]);
    $query->condition('ai.item_table', 'track');
    return $query;
  }

  /**
   * {@inheritdoc}
   */
  public function fields() {
    $fields = [
      'id' => $this->t('Paragraph identifier')
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
        'alias' => 'ai',
      ],
    ];
  }

}
