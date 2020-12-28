<?php

/**
 * @file
 * Contains Drupal\migrate_dram\Plugin\migrate\source\Label
 */

namespace Drupal\migrate_dram\Plugin\migrate\source;

use Drupal\migrate\Plugin\migrate\source\SqlBase;
use Drupal\migrate\Row;

/**
 * Minimalistic example for a SqlBase source plugin.
 *
 * @MigrateSource(
 *   id = "label"
 * )
 */
class Label extends SqlBase {

  /**
   * {@inheritdoc}
   */
  public function query() {
    $query = $this->select('label', 'l')
      ->fields('l', [
          'id',
          'legacy_id',
          'name',
          'description',
          'home_page_url'
        ]);
    return $query;
  }

  /**
   * {@inheritdoc}
   */
  public function fields() {
    $fields = [
      'id' => $this->t('dram_id'),
      'legacy_id' => $this->t('legacy_id' ),
      'name' => $this->t('title' ),
      'description' => $this->t('description'),
      'home_page_url' => $this-t('home_page_url')
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
        'alias' => 'l',
      ],
    ];
  }
}
