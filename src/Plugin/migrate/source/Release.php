<?php

namespace Drupal\dram_migrate\Plugin\migrate\source;

use Drupal\migrate\Row;
use Drupal\migrate\Plugin\migrate\source\SqlBase;

/**
 * Minimalistic example for a SqlBase source plugin.
 *
 * @MigrateSource(
 *   id = "release"
 * )
 */
class release extends SqlBase {

  /**
   * {@inheritdoc}
   */
  public function query() {
    $query = $this->select('album', 'a')
      ->fields('a', [
        'id',
        'legacy_id',
        'url_code',
        'active',
        'title',
        'display_subtitle',
        'label_id',
        'streaming_approved',
        'deprecated',
        'digital',
      ]);
    $query->join('identifier', 'i', 'a.id = i.item_id');
    $query->fields('i', [
      'code',
      'item_id',
      'item_table',
      'type',
    ]);
    $query->condition('i.type', 'vendor');
    return $query;
  }

  /**
   * {@inheritdoc}
   */
  public function fields() {
    $fields = [
      'id' => $this->t('DRAM identifier'),
      'legacy_id' => $this->t('Legacy identifier'),
      'active' => $this->t('Is active'),
      'title' => $this->t('release title'),
      'display_subtitle' => $this->t('release subtitle'),
      'label_id' => $this->t('Label identifier'),
      'url_code' => $this->t('url_code'),
      'streaming_approved' => $this->t('streaming_approved'),
      'deprecated' => $this->t('deprecated'),
      'digital' => $this->t('digital'),
      'test_id' => $this->t('code'),
    ];
    return $fields;
  }

  /**
   * {@inheritdoc}
   */
  public function prepareRow(Row $row) {
    $field1 = $row->getSourceProperty("type");
    $row->setDestinationProperty("test_id", $field1);
    return parent::prepareRow($row);
  }

  /**
   * {@inheritdoc}
   */
  public function getIds() {
    return [
      'id' => [
        'type' => 'integer',
        'alias' => 'a',
      ],
    ];
  }

}
