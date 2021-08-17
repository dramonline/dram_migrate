<?php

namespace Drupal\dram_migrate\Plugin\migrate\source;

use Drupal\migrate\Plugin\migrate\source\SqlBase;

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
        'legacy_id',
        'url_code',
        'label_id',
        'album_id',
        'work_number',
        'title',
        'display_subtitle',
        'composition_start',
        'composition_end',
        'composition_circa',
        'recording_start',
        'recording_end',
        'recording_circa',
        'active',
        'streaming_approved',
        'deprecated',
        'runtime'
      ])->condition('label_id', '36398', '<>')->orderBy('label_id')->orderBy('album_id')->orderBy('work_number');
    return $query;
  }

  /**
   * {@inheritdoc}
   */
  public function fields() {
    $fields = [
      'id' => $this->t('dram_id'),
      'title'   => $this->t('title'),
      'display_subtitle'   => $this->t('Display subtitie'),
      'composition_start'   => $this->t('Composition start date'),
      'composition_end'   => $this->t('Composition end date'),
      'recording_start'   => $this->t('Recording start date'),
      'recording_end'   => $this->t('Recording end date'),
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
