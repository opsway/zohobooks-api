# CONTRIBUTING

## RESOURCES

- [Wiki](https://github.com/opsway/zohobooks-api/wiki)
- [Issues](https://github.com/opsway/zohobooks-api/issues)

## RUNNING TESTS

- Install dependencies via composer `composer install`
- Run test `composer test`


## Running Coding Standards Checks

This component uses [phpcs](https://github.com/squizlabs/PHP_CodeSniffer) for coding
standards checks, and provides configuration for our selected checks.
`phpcs` is installed by default via Composer.

To run checks only:

```console
$ composer cs-check
```

`phpcs` also includes a tool for fixing most CS violations, `phpcbf`:


```console
$ composer cs-fix
```

If you allow `phpcbf` to fix CS issues, please re-run the tests to ensure
they pass, and make sure you add and commit the changes after verification.
