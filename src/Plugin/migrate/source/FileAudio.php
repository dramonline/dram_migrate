<?php

namespace Drupal\dram_migrate\Plugin\migrate\source;

use Drupal\migrate\Row;
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
        'label_short_name',
        'catalog_number'
      ])->orderBy('label_id')->orderBy('catalog_number')->orderBy('disc_number')->orderBy('track_number');

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
    $code = $row->getSourceProperty('code');
    $filename = $row->getSourceProperty('filepath');
    $catalog_number = $row->getSourceProperty('catalog_number');

    $code = strtolower($code);
    $filename = strtolower($filename);
    $catalog_number = strtolower($catalog_number);

    if (!empty($code)) {
      $row->setSourceProperty('filename', $code . '.m4a');
      } else {
      $row->setSourceProperty('nothing', $code);
    }

    $row->setSourceProperty('catalog_number', $catalog_number);

    return parent::prepareRow($row);

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
