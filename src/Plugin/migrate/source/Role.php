<?php

namespace Drupal\dram_migrate\Plugin\migrate\source;

use Drupal\migrate\Row;
use Drupal\migrate\Plugin\migrate\source\SqlBase;

/**
 * Minimalistic example for a SqlBase source plugin.
 *
 * @MigrateSource(
 *   id = "role"
 * )
 */
class Role extends SqlBase {

  /**
   * {@inheritdoc}
   */
  public function query() {
    $query = $this->select('function', 'f')
      ->fields('f', [
        'id',
        'legacy_id',
        'name'
      ]
    )->orderBy('name','ASC');

    return $query;
  }

  /**
   * (@inheritdoc)
   */
  public function fields() {
    $fields = ['name' => $this->t('name')];

    return $fields;
  }

  /**
   * {@inheritdoc}
   */
  public function prepareRow(Row $row) {
    parent::prepareRow($row);
    $source = $row->getSourceProperty('name');
    $name = strtolower($source);
    $row->setSourceProperty('name', $name);
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


