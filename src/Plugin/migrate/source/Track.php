<?php

namespace Drupal\dram_migrate\Plugin\migrate\source;

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
        'streaming_approved',
        'deprecated',
        'track_number',
        'disc_track_number',
        'disc_number',
      ]);
    return $query;
  }

  /**
   * {@inheritdoc}
   */
  public function fields() {
    $fields = [
      'id' => $this->t('DRAM identifier'),
      'legacy_id' => $this - t('Legacy identifier'),
      'title' => $this->t('Track title'),
      'display_subtitle' => $this->t('Track subtitle'),
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
