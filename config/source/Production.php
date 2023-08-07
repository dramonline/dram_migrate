<?php

namespace Drupal\migrate_sa\Plugin\migrate\source;

use Drupal\migrate\Plugin\migrate\source\SqlBase;

/**
 * Minimalistic example for a SqlBase source plugin.
 *
 * @MigrateSource(
 *   id = "production"
 * )
 */
class Production extends SqlBase {

  /**
   * {@inheritdoc}
   */
  public function query() {
    $query = $this->select('artist_item', 'ai')
      ->fields('ai', [
        'id',
        'artist_id',
        'function_id',
        'item_id',
        'item_table',
        'ancillary',
      ]);

    // $performer_ids = [7,12,44,232,254,283,312,315,318,379,460,626,1127,1140,1403,1450,1780,1970,2071,2780,5436,5517,13838,13853,13869,33167,33891,53989,61200,61243,95142,107090,353161,378953,381254,674171];
    // $composer_ids = [1384, 3184, 89535];
    $personnel_ids = [9, 427, 614, 1008, 1455, 2841, 2852, 2877, 2917, 3427, 3466, 4461, 6952, 7053, 7186, 7204, 8370, 8419, 8491, 10243, 10582, 10585, 12492, 13255, 13856, 13958, 28273, 28484, 30121, 30614, 31711, 34493, 34538, 35019, 54626, 54744, 61020, 61848, 87390, 87395, 614233];

    $query->innerJoin('person', 'p', 'ai.artist_id = p.id');
    $query->innerJoin('track', 't', 't.id = ai.item_id');
    $query->condition('function_id', $personnel_ids, 'IN');
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
