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
    $query = $this->select('track', 't')
      ->fields('t', [
        'id',
        'legacy_id',
        'url_code',
        'label_id',
        'album_id',
        'work_id',
        'track_number',
        'title',
        'display_subtitle',
        'runtime',
        'composition_start',
        'composition_end',
        'composition_circa',
        'recording_start',
        'recording_end',
        'recording_circa',
        'active',
        'streaming_approved',
        'disc_number',
      ])->condition('label_id', '36398', '<>')->condition('work_id','386174');
      // $query->join('artist_item','ai', 't.id = ai.item_id');
      // $query->fields('ai', [
      //   'artist_id',
      //   'item_id',
      //   'function_id'

      return $query;
  }

  /**
   * {@inheritdoc}
   */
  public function fields() {
    $fields = [
      'id' => $this->t('DRAM identifier')
    ];
    return $fields;
  }


  /**
   * {@inheritdoc}
   */
  public function prepareRow(Row $row) {
    $track_ids = $row->getSourceProperty('id');

    // entity reference, ensemble content type
    $ensembles = $this->select('ensemble_item', 'ei')
      ->fields('ei', ['artist_id'])
      ->condition('ei.item_id', $track_ids)
      ->execute()
      ->fetchCol();
    $row->setSourceProperty('ensemble_ids', $ensembles);

    $composer_ids = $this->select('artist_item', 'ai')
      ->fields('ai', ['artist_id'])
      ->condition('ai.item_id', $track_ids)
      ->condition('function_id', '4')
      ->execute()
      ->fetchCol();
    $row->setSourceProperty('composer_ids', $composer_ids);

    // paragraphs, personnel
    $performer_ids = $this->select('artist_item', 'ai')
      ->fields('ai', ['id'])
      ->condition('ai.item_id', $track_ids)
      ->condition('function_id', '4', '<>')
      ->execute()
      ->fetchCol();
    $row->setSourceProperty('performer_ids', $performer_ids);

    // var_dump($ensembles);
    var_dump($performer_ids);

    return parent::prepareRow($row);

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
