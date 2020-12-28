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
     $fields = ['id, legacy_id, name, category'];
     return $this->select ('instrument', 'i')
       ->fields('i', $fields);
   }

   /**
    * (@inheritdoc)
    */
  public function fields(){
    $fields = [
      'id' => $this->t('DRAM identifier'),
      'legacy_id' => $this->t('Legacy identifier'),
      'name' => $this->t('Instrument name')
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
