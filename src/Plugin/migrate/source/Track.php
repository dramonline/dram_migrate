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
      ->fields('t', ['id','legacy_id','title']);
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

    $ensembles = $this->select('ensemble_item_test', 'eit')
      ->fields('eit', ['artist_id'])
      ->condition('eit.item_id', $track_ids)
      ->execute()
      ->fetchCol();
    $row->setSourceProperty('ensemble_ids', $ensembles);

    $artists = $this->select('artist_item', 'ait')
      ->fields('ait', ['id'])
      ->condition('ait.item_id', $track_ids)
      ->execute()
      ->fetchCol();
    $row->setSourceProperty('artist_ids', $artists);

    // echo ($track_ids . PHP_EOL);
    // echo ($ensemble . PHP_EOL);

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
