<?php

namespace Drupal\dram_migrate\Plugin\migrate\source;

use Drupal\migrate\Row;
use Drupal\migrate\Plugin\migrate\source\SqlBase;

/**
 * Minimalistic example for a SqlBase source plugin.
 *
 * @MigrateSource(
 *   id = "track"
 * )
 */
class Track extends SqlBase {

  /**
   * {@inheritdoc}
   */
  public function query() {
    $query = $this->select('track_test', 't')
      ->fields('t', [
        'id',
        'legacy_id',
        'title',
      ]);
      $query->leftJoin('artist_item','ai', 't.id = ai.item_id');
      $query->fields('ai', [
        'artist_id',
        'item_id'
      ]);

    return $query;
  }

  /**
   * {@inheritdoc}
   */
  public function fields() {
    $fields = [
      'id' => $this->t('DRAM identifier'),
      'title' => $this->t('Title'),
      'artist_id' => $this->t('Artist identifier'),
    ];
    return $fields;
  }


  /**
   * {@inheritdoc}
   */
  public function prepareRow(Row $row) {
    $track_ids = $row->getSourceProperty('id');

    // entity reference, ensemble content type
    $ensembles = $this->select('ensemble_item_test', 'eit')
      ->fields('eit', ['artist_id'])
      ->condition('eit.item_id', $track_ids)
      ->execute()
      ->fetchCol();
    $row->setSourceProperty('ensemble_ids', $ensembles);

    // paragraphs, personnel
    $performer_ids = $this->select('artist_item', 'ai')
      ->fields('ai', ['id'])
      ->condition('item_id', $row->getSourceProperty('item_id'), '=')
      ->execute()
      ->fetchCol();
    $row->setSourceProperty('performer_ids', $performer_ids);

    // var_dump($ensembles);
    var_dump($performer_ids);
    var_dump($ensembles);

  }

  /**
   * {@inheritdoc}
   */
  public function getIds() {
    return [
      'id' => [
        'type' => 'integer',
        'alias' => 't',
      ],
    ];
  }
}
