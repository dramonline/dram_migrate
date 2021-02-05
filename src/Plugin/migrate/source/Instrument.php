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
            'name',
            'category']
        );
        return $query;
   }

   /**
    * (@inheritdoc)
    */
  public function fields(){
    $fields = [
      'id' => $this->t('DRAM identifier'),
      'name' => $this->t('Instrument name'),
      'category' => $this->t('Category')
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
