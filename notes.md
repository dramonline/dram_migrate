track
65314
65327
65340

album id
583

work id
53354

<code>
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
      ]);
    $query->join('identifier', 'i', 'a.id = i.item_id');
    $query->fields('i', [
      'code',
      'item_id',
      'item_table',
      'type',
    ]);
    $query->condition('i.type', 'vendor');
    return $query;
  }
</code

<code>
  /**
   * {@inheritdoc}
   */
  public function prepareRow(Row $row) {
    $field1 = $row->getSourceProperty("type");
    $row->setDestinationProperty("test_id", $field1);
    return parent::prepareRow($row);
  }
</code>
