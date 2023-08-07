<?php

namespace Drupal\migrate_sa\Plugin\migrate\source;

use Drupal\migrate\Plugin\migrate\source\SourcePluginBase;
use Drupal\migrate\Row;

/**
 * Source plugin for retrieving data via URLs.
 *
 * @MigrateSource(
 *   id = "sa_issue"
 * )
 */
class SaIssue extends SourcePluginBase {

  /**
   * {@inheritdoc}
   */
  public function prepareRow(Row $row) {
    $foo = $row->getSourceProperty('title');
    var_dump($foo);

    return parent::prepareRow($row);
  }

}
