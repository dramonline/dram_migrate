<?php

namespace Drupal\dram_migrate\Plugin\migrate\source;

use Drupal\migrate\Row;
use Drupal\migrate\Plugin\migrate\source\SqlBase;

/**
 * Minimalistic example for a SqlBase source plugin.
 *
 * @MigrateSource(
 *   id = "performer"
 * )
 */
class Performer extends SqlBase {

  /**
   * {@inheritdoc}
   */
  public function query() {
    $query = $this->select('artist_item', 'ai')
      ->fields('ai', [
        'id',
        'artist_id',
        'instrument_id',
        'item_id',
        'item_table'
      ])
      ->condition('item_table', 'track', '=')
      ->orderBy('item_id','ASC')
      ->range(0,10);

      return $query;
  }

  /**
   * {@inheritdoc}
   */
  public function fields() {
    $fields = [
      'id' => $this->t('Unique identifier'),
      'item_id' => $this->t('Item identifier'),
      'artist_id' => $this->t('Artist identifier'),
      'item_table' => $this->t('Item table'),
      'instrument' => $this->t('Instrument identifier'),
    ];
    return $fields;
  }


  /**
   * {@inheritdoc}
   */
  public function prepareRow(Row $row) {
    parent::prepareRow($row);

    $source = $row->getSourceProperty('source');
    // var_dump($row);
  }

  /**
   * {@inheritdoc}
   */
  public function getIds() {
    return [
      'id' => [
        'type' => 'integer',
        'alias' => 'id'
      ],
    ];
}
}

