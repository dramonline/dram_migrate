# migrate-dram
Custom Drupal migrations from SQL database to Drupal entities

#### A few handy commands for troubleshooting migrations
When re-enabling a migration module, you may encounter the following error:
<pre>
Drupal\Core\Config\PreExistingConfigException: Configuration objects (migrate_plus.migration.people) provided[error]
by migration_nwr already exist in active configuration in /var/www/drupal/web/core/lib/Drupal/Core/Config/PreExistingConfigException.php:65</pre>
The following Drupal console command removes migration from active configuration
<pre>drupal config:delete active migrate_plus.migration.[migration-name]</pre>
