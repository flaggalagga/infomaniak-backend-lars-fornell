# Bob the Schema Builder 🎯


Unfortunately, your colleague hasn't done much. You'll have to create a migration
for the `movies` table yourself.





## Creating the `movies` table migration



Create a new migration file for the `movies` table and complete the blueprint
definition so that it includes the columns described in the following table.


| Column   | [Data type][column-types] | [Nullable][column-modifiers] |
| -------- |---------------------------| -----------------------------|
| `title`  | string                    | no                           |
| `year`   | small int                 | no                           |
| `poster` | string                    | yes                          |

```
🟢 sail composer test:migrations:movies
```


## Creating the `review` table migration


Now we want to add the possibility to review movies.


Just like for the `movies` table, your colleague didn't add the migration file. Again, complete the blueprint
definition so that it includes the columns described in the following table.
But since you already did it once, you should be fine 🙂.


| Column     | [Data type][column-types] | [Nullable][column-modifiers] |
| ---------- |---------------------------| -----------------------------|
| `author`   | string                    | no                           |
| `body`     | text                      | no                           |
| `movie_id` | unsigned big integer      | no                           |

```
🟢 sail composer test:migrations:reviews
```

## Migrating the database

Once you are confident that your implementation is correct, you can migrate the
database by running the following command.

```shell
sail artisan migrate:fresh
```


[column-types]: https://laravel.com/docs/10.x/migrations#available-column-types
[column-modifiers]: https://laravel.com/docs/10.x/migrations#column-modifiers

