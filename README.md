# migrate_dram
Custom Drupal migrations from SQL database to Drupal entities.

## Handling active configurations
When re-enabling a migration module, you may encounter the following error:
<pre>
Drupal\Core\Config\PreExistingConfigException: Configuration objects (migrate_plus.migration.people) provided[error]
by migration_nwr already exist in active configuration in /var/www/drupal/web/core/lib/Drupal/Core/Config/PreExistingConfigException.php:65</pre>
The following Drupal console command removes migration from active configuration
<pre>drupal config:delete active migrate_plus.migration.[migration-name]</pre>

## Adding an uninstall script to custom migrate modules

https://gist.github.com/jasloe/9293b50bad43b8d9605b30404df34e44
