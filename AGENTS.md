# Repository Guidelines

## Project Structure & Module Organization
Source code lives in `src/` under the `MoySklad` namespace, organized by domain entities and utility helpers. Autoloading follows the PSR-4 map defined in `composer.json`, so new classes should mirror their namespace path. Domain-level tests sit in `tests/` with the same namespace layout under `MoySklad\Tests`, and `phpunit.xml.dist` already points the suite there. Configuration artifacts (`composer.json`, `.php_cs`, `phpunit.xml.dist`) stay in the repository root, while generated dependencies remain in `vendor/` and must not be checked in.

## Build, Test, and Development Commands
- `composer install` — install PHP 7.3+ dependencies and dev tools, respecting `composer.lock`.
- `composer dump-autoload -o` — rebuild the optimized autoloader after adding new classes.
- `vendor/bin/phpunit` — execute the entire PHPUnit suite; uses `MOYSKLAD_*` env vars from `phpunit.xml.dist`.
- `vendor/bin/php-cs-fixer fix --dry-run --diff` — check PSR-2 compliance; drop `--dry-run` to apply fixes.

## Coding Style & Naming Conventions
The `.php_cs` profile enforces PSR-2 formatting (4-space indent, braces on new lines, snake_case constants) and short array syntax. Keep files strictly ASCII and end with a newline. Classes, traits, and interfaces use PascalCase, while methods, local variables, and entity properties stay camelCase. Every new entity or request object should carry JMS Serializer annotations mirroring the API contract. Follow PSR-4: if you add `MoySklad\Service\OrderSync`, place it in `src/Service/OrderSync.php`.

## Testing Guidelines
All unit and integration tests belong in `tests/` and must end with `Test.php`. Reuse PHPUnit data providers to cover both JSON serialization and HTTP client behavior. When a test depends on live credentials, guard it with `@group integration` so contributors can run `vendor/bin/phpunit --exclude-group integration` by default. Aim to keep new code covered; reference `./src` is whitelisted for coverage, so untested modules show up in the report. Configure `MOYSKLAD_HOST`, `MOYSKLAD_LOGIN`, and `MOYSKLAD_PASSWORD` via the environment (never commit secrets).

## Commit & Pull Request Guidelines
Write imperative, present-tense commit messages with a concise summary (e.g., `Add counterparty paging support`). Explain motivation and edge cases in the body when needed, referencing issues like `#123`. Pull requests should include: purpose summary, testing evidence (`phpunit`, fixer), screenshots for behavior changes, and links to API docs when introducing new endpoints. Keep PRs focused on a single feature or fix, ensure CI passes, and request review once comments in the diff are resolved.
