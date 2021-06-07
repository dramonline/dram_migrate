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
      $query->leftJoin('ensemble_item_test','ei', 't.id = ei.item_id');
      $query->fields('ei', [
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
      'id' => $this->t('DRAM identifier')
    ];
    return $fields;
  }


  /**
   * {@inheritdoc}
   */
  public function prepareRow(Row $row) {
    parent::prepareRow($row);
    $source_artist_id = $row->getSourceProperty('artist_id');
    $row->setSourceProperty('artist_id', $source_artist_id);
    // var_dump($source_artist_id);
    // 1. var_dump shows the content of the $row object.
    // var_dump($row->getSourceIdValues($source));

    // 2. renders an empty array

    // 3. renders the source array
    // $source = $row->getSourceProperty('source');
    // echo(gettype($source) . PHP_EOL);

    // 4. retrieves value from the artist_id source property
    // var_dump($row->getSourceProperty('artist_id'));
    // $source_artist_id = $row->getSourceProperty('artist_id');

    // echo ('the artist_id type is: ' . gettype($source_artist_id) . PHP_EOL);
    // echo ('the artist_id is: ' . $source_artist_id . PHP_EOL);
    // echo (gettype($artist_ids . PHP_EOL));

    // foreach ($artist_ids as $source_artist_id) {
    //   echo ('this is the source artist id: ' . $source_artist_id . PHP_EOL);
    // }

    // $ensemble_ids = $this->select('ensemble_item_test', 'ei')
    //   ->fields('id'])
    //   ->leftJoin('ensemble_item_test', '')
    //   ->condition('id', $row->getSourceProperty('item_id'), '=')
    //   ->execute()
    //   ->fetchCol();
    // $row->setSourceProperty('ensemble_ids', $ensemble_ids);

    // $foo = $row->getSourceProperty('item_id');
    // var_dump($foo);
    // echo ($foo . PHP_EOL);

    // $performer_ids = $this->select('ensemble_item_test', 'ai')
    //   ->fields('ai', ['id'])
    //   ->condition('item_id', $row->getSourceProperty('item_id'), '=')
    //   ->execute()
    //   ->fetchCol();
    // $row->setSourceProperty('performer_ids', $performer_ids);

    $performer_ids = $this->select('ensemble_item_test', 'eit')
      ->fields('eit', ['id'])
      ->condition('item_id', $row->getSourceProperty('item_id'), '=')
      ->execute()
      ->fetchCol();
    $row->setSourceProperty('performer_ids', $performer_ids);

    var_dump($performer_ids);

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
