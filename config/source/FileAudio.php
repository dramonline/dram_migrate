<?php

namespace Drupal\migrate_sa\Plugin\migrate\source;

use Drupal\migrate\Plugin\migrate\source\SqlBase;

/**
 * Minimalistic example for a SqlBase source plugin.
 *
 * @MigrateSource(
 *   id = "file_audio"
 * )
 */
class FileAudio extends SqlBase {

  /**
   * {@inheritdoc}
   */
  public function query() {
    $query = $this->select('file_audio', 'f')
      ->fields('f', [
        'id',
        'fid',
        'mid',
        'code',
        'title',
        'filename',
        'label_short_name',
        'catalog_number',
      ])->orderBy('fid');

    return $query;
  }

  /**
   * {@inheritdoc}
   */
  public function fields() {
    $fields = [
      'id' => $this->t('DRAM identifier'),
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
        'alias' => 'f',
      ],
    ];
  }

}
