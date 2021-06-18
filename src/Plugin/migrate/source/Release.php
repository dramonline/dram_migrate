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
class Release extends SqlBase {

  /**
   * {@inheritdoc}
   */
  public function query() {
    $query = $this->select('album', 'a')
      ->fields('a', [
        'id',
        'legacy_id',
        // 'url_code',
        'active',
        'title',
        // 'display_subtitle',
        'label_id',
        // 'streaming_approved',
        // 'deprecated',
        // 'digital',
        'vendor_id',
        // 'upc_id',
        // 'oclc_id',
        // 'composition_start',
        // 'composition_end',
        // 'composition_circa',
        // 'recording_start',
        // 'recording_end',
        // 'recording_circa'
      ])->condition('a.id', '979070');
      // ]);
      $query->leftJoin('copyright','c','a.id = c.item_id');
      $query->leftJoin('file_liner_notes', 'f', 'a.id = f.release_id');
      // $query->join('note','n','a.id = n.item_id');
      $query->fields('c', [
        'item_id',
        'c_line',
        'p_line',
      ]);
      // $query->leftJoin('track_test', 'tt', 'a.id = tt.album_id');
      // $query->orderBy('tt.disc_track_number');

      // $query->fields('n', [
      //   'type',
      //   'data',
      // ]);
    return $query;
  }

  /**
   * {@inheritdoc}
   */
  public function fields() {
    $fields = [
      'id' => $this->t('DRAM identifier'),
      'release_tracks' => $this->t('List of tracks associated with release.')
    ];
    return $fields;
  }

   /**
   * {@inheritdoc}
   */
  public function prepareRow(Row $row) {
    $release_ids = $row->getSourceProperty('id');

    $track_ids = $this->select('track', 't')
      ->fields('t', ['id'])
      ->condition('t.album_id', $release_ids)
      ->orderBy('t.disc_number')
      ->orderBy('t.disc_track_number')
      ->execute()
      ->fetchCol();
    $row->setSourceProperty('release_tracks', $track_ids);

    $file_id = $this->select('file_liner_notes', 'f')
      ->fields('f', ['fid'])
      ->condition('f.release_id', $release_ids)
      ->execute()
      ->fetchCol();
    $row->setSourceProperty('file_id', $file_id);

    return parent::prepareRow($row);

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
