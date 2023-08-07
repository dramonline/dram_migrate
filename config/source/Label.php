<?php

namespace Drupal\migrate_sa\Plugin\migrate\source;

use Drupal\migrate\Plugin\migrate\source\SqlBase;

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
        'home_page_url',
        'url_code',
        'label_short_name',
      ]);
    return $query;
  }

  /**
   * {@inheritdoc}
   */
  public function fields() {
    $fields = [
      'id' => $this->t('dram_id'),
      'legacy_id' => $this->t('legacy_id'),
      'name' => $this->t('title'),
      'description' => $this->t('description'),
      'home_page_url' => $this->t('home_page_url'),
      'url_code' => $this->t('url_code'),
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
