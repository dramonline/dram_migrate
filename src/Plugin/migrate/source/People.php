<?php

/**
 * @file
 * Contains Drupal\migration_nwrPlugin\migrate\source\People
 */

namespace Drupal\migration_nwr\Plugin\migrate\source;

use Drupal\migrate\Plugin\migrate\source\SqlBase;
use Drupal\migrate\Row;

/**
 * Minimalistic example for a SqlBase source plugin.
 *
 * @MigrateSource(
 *   id = "people"
 * )
 */
class People extends SqlBase {

  /**
   * {@inheritdoc}
   */
  public function query() {
    $query = $this->select('composers', 'c')
      ->fields('c', [
          'composer_id',
          'first_name',
          'last_name'
        ]);
    return $query;
  }

  /**
   * {@inheritdoc}
   */
  public function fields() {
    $fields = [
      'composer_id' => $this->t('composer_id' ),
      'first_name'   => $this->t('people_name_first' ),
      'last_name'    => $this->t('people_name_last')
    ];
    return $fields;
  }

  /**
   * {@inheritdoc}
   */
  public function getIds() {
    return [
      'composer_id' => [
        'type' => 'integer',
        'alias' => 'p',
      ],
    ];
  }
}