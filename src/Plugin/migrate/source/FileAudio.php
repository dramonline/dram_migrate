<?php

namespace Drupal\dram_migrate\Plugin\migrate\source;

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
        'label_id',
      ])->orderBy('label_id')->orderBy('code');

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

  // /**
  //  * {@inheritdoc}
  //  */
  // public function prepareRow(Row $row) {
  //   $label_name = $row->getSourceProperty('label_id');

  //   $foo = $this->select('file_audio', 'f')
  //     ->fields('f', $label_name);
  //   $foo->innerJoin('')

  //   return parent::prepareRow($row);
  //   }

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
