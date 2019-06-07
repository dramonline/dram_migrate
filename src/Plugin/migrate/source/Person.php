<?php

/**
 * @file
 * Contains Drupal\migrate_dram\Plugin\migrate\source\Person
 */

namespace Drupal\migrate_dram\Plugin\migrate\source;

use Drupal\migrate\Plugin\migrate\source\SqlBase;
use Drupal\migrate\Row;

/**
 * Minimalistic example for a SqlBase source plugin.
 *
 * @MigrateSource(
 *   id = "person"
 * )
 */
class Person extends SqlBase {

  /**
   * {@inheritdoc}
   */
  public function query() {
    $query = $this->select('artist', 'a')
      ->fields('a', [
          'id',
          'name'
        ]);
    return $query;
  }

  /**
   * {@inheritdoc}
   */
  public function fields() {
    $fields = [
      'id' => $this->t('person_dram_id' ),
      'name'   => $this->t('title' )
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
        'alias' => 'a',
      ],
    ];
  }
}
