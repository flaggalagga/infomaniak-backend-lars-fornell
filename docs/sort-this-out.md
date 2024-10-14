# Sort this out 🧠

`GET /api/movies?sort=title&dir=asc`

In this *optional* objective, you'll need to implement a sorting mechanism on the
that lists movies. We want the sorting column and direction to be configurable
via the `sort` and `dir` query parameters respectively.

Much like the other features of this endpoint, we want the sorting to be applied
only if the `sort` query parameter has been supplied.

```
🟢 sail composer test:sorting
```




