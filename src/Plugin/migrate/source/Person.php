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
    $query = $this->select('person', 'p')
      ->fields('p', [
        'id',
        'legacy_id',
        'url_code',
        'display_name',
        'artist_fname',
        'artist_lname',
        'artist_suffix',
        'artist_prefix',
        'active',
        'date_start',
        'date_end',
        'move'
      ])->orderBy('artist_lname')->orderBy('artist_fname')->condition('move', '1');

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
  $date_start = $row->getSourceProperty('date_start');
  $date_end = $row->getSourceProperty('date_end');

  if (!empty($date_start)) {
    $row->setSourceProperty('date_start', $date_start . '-01-01');
  } else {
    $row->setSourceProperty('nothing', $date_start);
  }

  if (!empty($date_end)) {
    $row->setSourceProperty('date_end', $date_end . '-01-01');
  } else {
    $row->setSourceProperty('nothing', $date_end);
  }

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
