<?php

namespace Drupal\dram_migrate\Plugin\migrate\source;

use Drupal\migrate\Row;
use Drupal\migrate\Plugin\migrate\source\SqlBase;

/**
 * Minimalistic example for a SqlBase source plugin.
 *
 * @MigrateSource(
 *   id = "release"
 * )
 */
class release extends SqlBase {

  /**
   * {@inheritdoc}
   */
  public function query() {
    $query = $this->select('album', 'a')
      ->fields('a', [
        'id',
        'legacy_id',
        'url_code',
        'active',
        'title',
        'display_subtitle',
        'label_id',
        'streaming_approved',
        'deprecated',
        'digital',
        'vendor_id',
        'upc_id',
        'oclc_id'
      ]);
    return $query;
  }

  /**
   * {@inheritdoc}
   */
  public function fields() {
    $fields = [
      'id' => $this->t('DRAM identifier'),
      'legacy_id' => $this->t('Legacy identifier'),
      'active' => $this->t('Is active'),
      'title' => $this->t('release title'),
      'display_subtitle' => $this->t('release subtitle'),
      'label_id' => $this->t('Label identifier'),
      'url_code' => $this->t('url_code'),
      'streaming_approved' => $this->t('streaming_approved'),
      'deprecated' => $this->t('deprecated'),
      'digital' => $this->t('digital'),
      'vendor_id' => $this->t('vendor_id'),
      'oclc_id' => $this->t('oclc_id'),
      'upc_id' => $this->t('upc_id'),
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
        'alias' => 'a',
      ],
    ];
  }

}
