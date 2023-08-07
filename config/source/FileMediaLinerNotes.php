<?php

namespace Drupal\migrate_sa\Plugin\migrate\source;

use Drupal\migrate\Plugin\migrate\source\SqlBase;

/**
 * Minimalistic example for a SqlBase source plugin.
 *
 * @MigrateSource(
 *   id = "file_media_liner_notes"
 * )
 */
class FileMediaLinerNotes extends SqlBase {

  /**
   * {@inheritdoc}
   */
  public function query() {
    $query = $this->select('file_liner_notes', 'f')
      ->fields('f', [
        'id',
        'fid',
        'mid',
        'filename',
        'release_id',
        'catalog_number',
        'title',
        'label_short_name',
        'label_name',
        'media_type',
      ])->orderBy('label_name')->orderBy('catalog_number');

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
