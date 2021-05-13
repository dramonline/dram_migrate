<?php

namespace Drupal\dram_migrate\Plugin\migrate\source;

use Drupal\migrate\Row;
use Drupal\migrate\Plugin\migrate\source\SqlBase;

/**
 * Minimalistic example for a SqlBase source plugin.
 *
 * @MigrateSource(
 *   id = "performer"
 * )
 */
class Performer extends SqlBase {


  /**
   * {@inheritdoc}
   */
  public function query() {
    $query = $this->select('track', 't')
      ->fields('t', [
        'id',
        'title',
      ]);
      $query->join('artist_item','ai', 't.id = ai.item_id');
      $query->fields('ai', [
        'artist_id',
        'item_id'
      ])->range(0,3);

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
    parent::prepareRow($row);
    // 1. var_dump shows the content of the $row object.
    // var_dump($row->getSourceIdValues($source));

    // 2. renders an empty array

    // 3. renders the source array
    $source = $row->getSourceProperty('source');
    // echo(gettype($source) . PHP_EOL);

    // 4. retrieves value from the artist_id source property
    // var_dump($row->getSourceProperty('artist_id'));
    $source_artist_id = $row->getSourceProperty('artist_id');

    // echo ('the artist_id type is: ' . gettype($source_artist_id) . PHP_EOL);
    // echo ('the artist_id is: ' . $source_artist_id . PHP_EOL);
    // echo (gettype($artist_ids . PHP_EOL));

    // foreach ($artist_ids as $source_artist_id) {
    //   echo ('this is the source artist id: ' . $source_artist_id . PHP_EOL);
    // }

    // $artist_ids = $this->select('artist_item', 'ai')
    //   ->fields('ai', ['artist_id'])
    //   ->condition('id', $row->getSourceProperty('item_id'), '=')
    //   ->execute()
    //   ->fetchCol();
    // $row->setSourceProperty('artists', $artist_ids);

    // $foo = $row->getSourceProperty('item_id');
    // var_dump($foo);
    // echo ($foo . PHP_EOL);

    $artist_ids = $this->select('artist_item', 'ai')
      ->fields('ai', ['artist_id'])
      ->condition('item_id', $row->getSourceProperty('item_id'), '=')
      ->execute()
      ->fetchCol();
    $row->setSourceProperty('names', $artist_ids);
    var_dump($artist_ids);
    var_dump($item_id);
  }

  /**
   * {@inheritdoc}
   */
  public function getIds() {
    return [
      'id' => [
        'type' => 'integer',
        'alias' => 'ai',
      ],
    ];
  }
}
