# goodwe
# Test Commit

## ZIP download requirement

The "Download All Files" feature requires the PHP ZIP extension (`ext-zip`) so `ZipArchive` is available.

For LEMP deployments:

- Install the ZIP package that matches the deployed PHP version, for example `php-zip` or `php8.x-zip`.
- Reload `php-fpm` and the web server after installation.

If the extension is missing, the application now returns a controlled error instead of a fatal exception.
