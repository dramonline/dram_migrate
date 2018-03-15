<?php

/**
 * @file
 * Contains Drupal\migrate_dram\Plugin\migrate\source\Instrument
 */

namespace Drupal\migrate_dram\Plugin\migrate\source;

use Drupal\migrate\Plugin\migrate\source\SqlBase;
use Drupal\migrate\Row;

/**
 * Minimalistic example for a SqlBase source plugin.
 *
 * @MigrateSource(
 *   id = "instrument"
 * )
 */
class Instrument extends SqlBase {

  /**
   * {@inheritdoc}
   */
  public function query() {
    $query = $this->select('instrument', 'i')
      ->fields('i', [
          'id',
          'legacy_id',
          'name',
          'category'
        ]);
    return $query;
  }

  /**
   * {@inheritdoc}
   */
  public function fields() {
    $fields = [
      'id' => $this->t('field_instrument_id'),
      'name'   => $this->t('name'),
      'category' => $this->t('field_instrument_category'),
      'legacy_id' => $this->t('field_instrument_legacy_id')
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
        'alias' => 'i',
      ],
    ];
  }
}