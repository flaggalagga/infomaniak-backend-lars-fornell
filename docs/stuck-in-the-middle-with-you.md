# Stuck in the Middle with You

This application has a special route `GET /stuck-in-the-middle`. Unfortunately it
will only respond successfully if a header `X-Stuck-In-The-Middle: no` is
present on the incoming request.


Create a middleware named `StuckInTheMiddleware` and complete it in a way that
accessing the `GET /stuck-in-the-middle` route responds successfully.




## Validating your implementation

You can validate your implementation by running the following command.

```
🟢 sail composer test:middleware
```

[middleware]: ../app/Http/Middleware/StuckInTheMiddleware.php
