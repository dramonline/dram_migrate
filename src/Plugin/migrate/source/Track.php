<?php

namespace Drupal\dram_migrate\Plugin\migrate\source;

use Drupal\migrate\Row;
use Drupal\migrate\Plugin\migrate\source\SqlBase;

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
        'id',
        'legacy_id',
        'url_code',
        'label_id',
        'album_id',
        'work_id',
        'track_number',
        'title',
        'display_subtitle',
        'runtime',
        'composition_start',
        'composition_end',
        'composition_circa',
        'recording_start',
        'recording_end',
        'recording_circa',
        'active',
        'streaming_approved',
        'disc_number',
        'disc_track_number',
      ])->condition('label_id', '36398', '<>')->orderBy('label_id')->orderBy('album_id')->orderBy('disc_number')->orderBy('track_number');

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
  public function prepareRow(Row $row) {
    $track_ids = $row->getSourceProperty('id');

    // entity reference, ensemble content type
    $ensembles = $this->select('ensemble_item', 'ei')
      ->fields('ei', ['artist_id'])
      ->condition('ei.item_id', $track_ids)
      ->execute()
      ->fetchCol();
    $row->setSourceProperty('ensemble_ids', $ensembles);

    $composers_ids = $this->select('artist_item', 'ai')
      ->fields('ai', ['artist_id'])
      ->condition('ai.item_id', $track_ids)
      ->condition('function_id', 4)
      ->execute()
      ->fetchCol();
    $row->setSourceProperty('composers_ids', $composers_ids);

    $composers_attributed = [1384, 3184, 89535];
    $composers_attributed_ids = $this->select('artist_item', 'ai')
      ->fields('ai', ['id'])
      ->condition('ai.item_id', $track_ids)
      ->condition('function_id', $composers_attributed, 'IN')
      ->execute()
      ->fetchCol();
    $row->setSourceProperty('composers_attributed_ids', $composers_attributed_ids);

    $librettists = [226, 229, 2724, 30066];
    $librettists_ids = $this->select('artist_item', 'ai')
      ->fields('ai', ['id'])
      ->condition('ai.item_id', $track_ids)
      ->condition('function_id', $librettists, 'IN')
      ->execute()
      ->fetchCol();
    $row->setSourceProperty('librettists_ids', $librettists_ids);

    $personnel = [9,427,614,1008,1455,2841,2852,2877,2917,3427,3466,4461,6952,7053,7186,7204,8370,8419,8491,10243,10582,10585,12492,13255,13856,13958,28273,28484,30121,30614,31711,34493,34538,35019,54626,54744,61020,61848,87390,87395,614233];
    $personnel_ids = $this->select('artist_item', 'ai')
      ->fields('ai', ['id'])
      ->condition('ai.item_id', $track_ids)
      ->condition('function_id', $personnel, 'IN')
      ->execute()
      ->fetchCol();
    $row->setSourceProperty('personnel_ids', $personnel_ids);

    // paragraphs, personnel
    $performers = [7,12,44,232,254,283,312,315,318,379,460,626,1127,1140,1403,1450,1780,1970,2071,2780,5436,5517,13838,13853,13869,33167,33891,53989,61200,61243,95142,107090,353161,378953,381254,674171];
    $performer_ids = $this->select('artist_item', 'ai')
      ->fields('ai', ['id'])
      ->condition('ai.item_id', $track_ids)
      ->condition('function_id', $performers)
      ->execute()
      ->fetchCol();
    $row->setSourceProperty('performer_ids', $performer_ids);

    return parent::prepareRow($row);

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
