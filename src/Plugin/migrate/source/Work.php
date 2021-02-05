<?php

/**
 * @file
 * Contains Drupal\migrate_dram\Plugin\migrate\source\Person
 */

namespace Drupal\migrate_dram\Plugin\migrate\source;

use Drupal\migrate\Plugin\migrate\source\SqlBase;
use Drupal\migrate\Row;

/**
 * Minimalistic example for a SqlBase source plugin.
 *
 * @MigrateSource(
 *   id = "work"
 * )
 */
class Work extends SqlBase {

  /**
   * {@inheritdoc}
   */
  public function query() {
    $query = $this->select('work', 'w')
      ->fields('w', [
          'id',
          'title',
          'display_subtitle',
          'composition_start',
          'composition_end',
          'recording_start',
          'recording_end'
        ]);
    return $query;
  }

  /**
   * {@inheritdoc}
   */
  public function fields() {
    $fields = [
      'id' => $this->t('dram_id' ),
      'title'   => $this->t('title' ),
      'display_subtitle'   => $this->t('Display subtitie' ),
      'composition_start'   => $this->t('Composition start date' ),
      'composition_end'   => $this->t('Composition end date' ),
      'recording_start'   => $this->t('Recording start date' ),
      'recording_end'   => $this->t('Recording end date' )
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
        'alias' => 'w',
      ],
    ];
  }
}
