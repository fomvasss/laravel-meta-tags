# Upgrading

## From v2 to v3

The database schema for `meta_tags` table have change, you should update the table accordingly.

-   ~~`metatagable_id`~~ -> `model_id`
-   ~~`metatagable_type`~~ -> `model_type`

To rename the columns see [Laravel's Documenation on Modifiyng Columns](https://laravel.com/docs/8.x/migrations#modifying-columns)
