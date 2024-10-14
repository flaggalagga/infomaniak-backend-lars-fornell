# Put the review to REST 🧠

You added the possibility to review a movie in your application but there is no way to do it from outside your app.
You'll need to write a review API and update the movie API for this.

The review API must support the following actions:

- [Creating a review for a movie](creating-a-review-for-a-movie)
- [Listing all review of a movie](#listing-all-review-of-movie)
- [Updating a review](#updating-a-movie)
- [Deleting a review](#deleting-a-movie)




--------------------------------------------------------------------------------

## Creating a review for a movie

`POST /api/movies/{movie}/reviews`

This endpoint creates a new review for a movie.

<details>
    <summary>Example payload</summary>

```json
{
    "author": "The author name",
    "body": "A review for the movie"
}
```
</details>

```
🟢 sail composer test:review:create
```


--------------------------------------------------------------------------------

## Listing all review of a movie

`GET /api/movies/{movie}/reviews?perPage={n}`

This endpoint returns all the reviews of a movie.
Like the movie API, it will need to support pagination with the parameter perPage and with the default value in a
config file.


Create a new configuration file named `reviews.php` and provide a configuration
key named `per_page`. The value of that configuration key should be retrieved
from the `REVIEWS_PER_PAGE` environment variable or fall back to `5` if it is
undefined.


<details>
    <summary>Example response</summary>

```json
{
    "data": [
        {
            "author": "The author name",
            "body": "A review for the movie"
            "created_at": "2021-06-01T12:13:58.000000Z",
            "updated_at": "2021-06-01T12:13:58.000000Z"
        },
        {
            "author": "Another author name",
            "body": "Another review for the movie"
            "created_at": "2021-06-01T12:13:58.000000Z",
            "updated_at": "2021-06-01T12:13:58.000000Z"
        }
    ]
}
```
</details>

```
🟢 sail composer test:review:list
```


--------------------------------------------------------------------------------

## Updating a review

`PATCH /api/reviews/{review}`

This endpoint updates a review with new attributes.

```
🟢 sail composer test:review:update
```

<details>
    <summary>Example payload</summary>

```json
{
    "body": "Some updated review body"
}
```
</details>



--------------------------------------------------------------------------------

## Deleting a movie

`DELETE /api/reviews/{review}`

This endpoint permanently deletes a review.

```
🟢 sail composer test:review:delete
```


