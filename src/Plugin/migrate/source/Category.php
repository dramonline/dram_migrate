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
 *   id = "category"
 * )
 */
class Category extends SqlBase {

  /**
   * {@inheritdoc}
   */

  public function query() {
    $query = $this->select('instrument', 'i')
        ->fields('i', [
            'category']
        );
        return $query;
   }

   /**
    * (@inheritdoc)
    */
  public function fields(){
    $fields = [
      'category' => $this->t('Category')
    ];

    return $fields;
  }

  /**
   * {@inheritdoc}
   */
  public function getIds() {
    return [
      'category' => [
        'type' => 'text',
        'alias' => 'i',
      ],
    ];
  }
}
