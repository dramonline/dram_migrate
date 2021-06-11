<?php

namespace Drupal\dram_migrate\Plugin\migrate\source;

use Drupal\migrate\Row;
use Drupal\migrate\Plugin\migrate\source\SqlBase;

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
    $query = $this->select('person_test', 'p')
      ->fields('p', [
        'id',
        'legacy_id',
        'url_code',
        'name',
        'artist_fname',
        'artist_mname',
        'artist_lname',
        'display_name',
        'artist_suffix',
        'artist_prefix',
        'active_dates',
        'biography',
        'active'
      ]);

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
    echo('foo');
    return parent::prepareRow($row);
  }


  /**
   * {@inheritdoc}
   */
  public function getIds() {
    return [
      'id' => [
        'type' => 'integer',
        'alias' => 'p',
      ],
    ];
  }
}
