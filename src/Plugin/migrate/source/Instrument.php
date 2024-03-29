<?php

namespace Drupal\dram_migrate\Plugin\migrate\source;

use Drupal\migrate\Plugin\migrate\source\SqlBase;

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
        'legacy_id',
        'category',
        'url_code',
      ]
    );
    return $query;
  }

  /**
   * (@inheritdoc)
   */
  public function fields() {
    $fields = [
      'id' => $this->t('DRAM identifier'),
      'legacy' => $this->t('Legacy identifier'),
      'name' => $this->t('Instrument name'),
      'category' => $this->t('Category'),
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
