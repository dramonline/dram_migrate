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
        'oclc_id',
        'composition_start',
        'composition_end',
        'composition_circa',
        'recording_start',
        'recording_end',
        'recording_circa',
        'runtime',
      ]);
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

    $file_id = $this->select('file_liner_notes', 'ln')
      ->fields('ln', ['mid'])
      ->condition('ln.release_id', $release_ids)
      ->execute()
      ->fetchCol();
    $row->setSourceProperty('file_id', $file_id);

    $artwork_id = $this->select('file_release_artwork', 'aw')
      ->fields('aw', ['mid'])
      ->condition('aw.release_id', $release_ids)
      ->execute()
      ->fetchCol();
    $row->setSourceProperty('artwork_id', $artwork_id);

    $c_line = $this->select('copyright', 'c')
      ->fields('c', ['c_line'])
      ->condition('c.item_id', $release_ids)->condition('c.item_table','album')
      ->execute()
      ->fetchCol();
    $row->setSourceProperty('c_line', $c_line[0]);

    $p_line = $this->select('copyright', 'c')
      ->fields('c', ['p_line'])
      ->condition('c.item_id', $release_ids)->condition('c.item_table','album')
      ->execute()
      ->fetchCol();
    $row->setSourceProperty('p_line', $p_line[0]);

    $upc = $this->select('identifier', 'i')
      ->fields('i', ['code'])
      ->condition('i.item_id', $release_ids)->condition('i.item_table','upc')
      ->execute()
      ->fetchCol();
    $row->setSourceProperty('upc', $upc[0]);

    $oclc = $this->select('identifier', 'i')
      ->fields('i', ['code'])
      ->condition('i.item_id', $release_ids)->condition('i.item_table','oclc')
      ->execute()
      ->fetchCol();
    $row->setSourceProperty('oclc', $oclc[0]);

    $tags = $this->select('tag_item', 't')
      ->fields('t', ['tag_id'])
      ->condition('t.item_id', $release_ids)
      ->execute()
      ->fetchCol();
    $row->setSourceProperty('tags', $tags);

    $marc_500 = $this->select('note', 'n')
      ->fields('n', ['data'])
      ->condition('n.item_id', $release_ids)->condition('n.type','MARC500')
      ->execute()
      ->fetchCol();
    $row->setSourceProperty('marc_500', $marc_500);

    $marc_511 = $this->select('note', 'n')
      ->fields('n', ['data'])
      ->condition('n.item_id', $release_ids)->condition('n.type','MARC511')
      ->execute()
      ->fetchCol();
    $row->setSourceProperty('marc_511', $marc_511);

    $marc_518 = $this->select('note', 'n')
      ->fields('n', ['data'])
      ->condition('n.item_id', $release_ids)->condition('n.type','MARC518')
      ->execute()
      ->fetchCol();
    $row->setSourceProperty('marc_518', $marc_518);

    $liner_text = $this->select('note', 'n')
      ->fields('n', ['data'])
      ->condition('n.item_id', $release_ids)->condition('n.type','liner')
      ->execute()
      ->fetchCol();
    $row->setSourceProperty('liner_text', $liner_text);

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
