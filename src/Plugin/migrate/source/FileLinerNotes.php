<?php

namespace Drupal\dram_migrate\Plugin\migrate\source;

use Drupal\migrate\Row;
use Drupal\migrate\Plugin\migrate\source\SqlBase;

/**
 * Minimalistic example for a SqlBase source plugin.
 *
 * @MigrateSource(
 *   id = "file_liner_notes"
 * )
 */
class FileLinerNotes extends SqlBase {

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
        'label_name,'
      ])->orderBy('label_name')->orderBy('catalog_number');

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
    $filename = $row->getSourceProperty('filename');
    $filename = strtolower($filename);

    $row->setSourceProperty('filename', $filename);
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
