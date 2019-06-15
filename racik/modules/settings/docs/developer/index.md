# Site Settings

**Sections**

- [Developer Documentation](#developer)
    - [Settings_lib](#settings_lib)


## Developer Settings {#developer}

#### Show Admin Profiler?

If checked, the profiler will be shown on the admin pages.

#### Show Front End Profiler?

If checked, the profiler will also be shown on the front-end pages.

### Settings_lib {#settings_lib}

The Settings library (Settings_lib) acts as an interface to the Settings_model and the system's configuration files. It also manages caching of the settings to reduce the need to access the database and filesystem when reading site settings.

#### <tt>item($name)</tt> {#settings_lib-item}

Retrieves the requested setting (<tt>$name</tt>) from the database. If the setting was not found in the database, it attempts to retrieve it from the config files. Caches the value so subsequent requests will retrieve it from the cache.

#### <tt>set($name, $value, $module='core')</tt>

Updates/inserts a setting in the database, and caches the new value.

#### <tt>delete($name, $module='core')</tt>

Deletes a setting from the database and removes it from the cache.

#### <tt>find_all()</tt>

Returns all of the settings in the database or the cache. If the cache is not set, initializes the cache with all of the returned settings.

#### <tt>find_by($field, $value)</tt> {#settings_lib-find_by}

Attempts to find a setting that matches the given <tt>$field</tt>/<tt>$value</tt> pair and caches the returned result.
To retrieve multiple settings that match a <tt>$field</tt>/<tt>$value</tt> pair, see [<tt>find_all_by()</tt>](#settings_lib-find_all_by).

#### <tt>find_all_by()</tt> {#settings_lib-find_all_by}

Attempts to Find all settings that match the given <tt>$field</tt>/<tt>$value</tt> pair and caches the returned results.
To retrieve a single setting that matches a <tt>$field</tt>/<tt>$value</tt> pair, see [<tt>find_by($field, $value)</tt>](#settings_lib-find_by).

#### <tt>settings_item($name)</tt> helper method

The <tt>settings_item()</tt> helper method calls [<tt>Settings_lib::item($name)</tt>](#settings_lib-item), and returns the requested setting.
