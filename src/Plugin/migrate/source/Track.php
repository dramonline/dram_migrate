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
    return $this->select('track_test', 't')
      ->fields('t');
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
    $tid = $row->getSourceProperty('id');

    $ensemble = $this->select('ensemble_item_test', 'eit')
      ->fields('eit', ['item_id'])
      ->condition('eit.item_id', $tid)
      ->execute()
      ->fetchCol();
    $row->setSourceProperty('ensemble_ids', $ensemble);

    echo ($tid . PHP_EOL);
    echo ($ensemble . PHP_EOL);

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
