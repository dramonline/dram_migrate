<?php

/**
 * @file
 * Contains Drupal\migration_nwrPlugin\migrate\source\Labels
 */

namespace Drupal\migration_nwr\Plugin\migrate\source;

use Drupal\migrate\Plugin\migrate\source\SqlBase;
use Drupal\migrate\Row;

/**
 * Minimalistic example for a SqlBase source plugin.
 *
 * @MigrateSource(
 *   id = "labels"
 * )
 */
class Labels extends SqlBase {

  /**
   * {@inheritdoc}
   */
  public function query() {
    $query = $this->select('labels', 'l')
      ->fields('l', [
          'label_id',
          'label_name'
        ]);
    return $query;
  }

  /**
   * {@inheritdoc}
   */
  public function fields() {
    $fields = [
      'genre_name'   => $this->t('title' )
      'label_id' => $this->t('labels_label_id' ),
    ];
    return $fields;
  }

  /**
   * {@inheritdoc}
   */
  public function getIds() {
    return [
      'label_id' => [
        'type' => 'integer',
        'alias' => 'l',
      ],
    ];
  }
}