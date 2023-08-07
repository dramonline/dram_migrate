<?php

namespace Drupal\migrate_sa\Plugin\migrate\source;

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
        'ancillary',
      ]);

    $performer_ids = [7, 12, 44, 232, 254, 283, 312, 315, 318, 379, 460, 626, 1127, 1140, 1403, 1450, 1780, 1970, 2071, 2780, 5436, 5517, 13838, 13853, 13869, 33167, 33891, 53989, 61200, 61243, 95142, 107090, 353161, 378953, 381254, 674171];

    $query->innerJoin('person', 'p', 'ai.artist_id = p.id');
    $query->innerJoin('track', 't', 't.id = ai.item_id');
    $query->condition('function_id', $performer_ids, 'IN');
    $query->condition('item_table', 'track');
    $query->condition('t.label_id', '36398', '<>')->orderBy('item_id', 'ASC')->orderBy('p.artist_lname')->orderBy('p.artist_fname');

    return $query;
  }

  /**
   * {@inheritdoc}
   */
  public function fields() {
    $fields = [
      'id' => $this->t('Unique identifier'),
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
        'alias' => 'id',
      ],
    ];
  }

}
