# Why are you so hardcoded ? 🎯

In the previous objective, you have created an API endpoint that lists movies.
As you remember, you were asked to implement pagination, and you were told to
provide a fallback value in the event that the `perPage` query string is not
present.

We initially hardcoded a value of `10` but we now want this value to be configurable
via an environment variable and accessible via the `config` helper.


Create a new configuration file named `movies.php` and provide a configuration
key named `per_page`. The value of that configuration key should be retrieved
from the `MOVIES_PER_PAGE` environment variable or fall back to `10` if it is
undefined.


When you have implemented this objective, replace the hardcoded value by a call
to the configuration helper in the [`MovieController`](../app/Http/Controllers/MovieController.php).

```
🟢 sail composer test:config
```

