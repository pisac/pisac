## Pisac - Keep git commit histories clean


Commits are one of the critical parts of a Git repository, and more so, the commit message is a lifelog for the repository. As the project evolves (new features getting added, bugs being fixed, architecture being refactored), commit letters can see what was changed and how. So these messages must reflect the underlying change in a short, precise manner.


#### Git commits history is straightforward to mess up. Here's how you can fix it!


**Pisac** is added to your CI, and when they commit description failed validation, an error occurs. Usually, everyone in the project gets an error message, so you can stop your friends from writing the ugly story. 😈


## Configuration

To configure the validation rules, you need to create a new file called `pisac.json` in the project root. For example:

```json
{
  "pattern": "(Added|Changed|Deprecated|Removed|Fixed|Security) .*",
  "message": "The commit must start with words (Added|Changed|Deprecated|Removed|Fixed|Security)",
  "limit": 5,
  "skip": [
    "Fix styling",
    "Initial commit"
  ]
}
```

#### Pattern

A regular expression that will be used to check messages.

#### Message

The message will be displayed if the message does not match the template. It is good practice to show an example of how to describe

#### Limit

Indicates how many messages in history Pisac should check. Don't use too many.

#### Skip

A set of words or their combinations, if present, you need to skip the check. Example:

```json
"skip": [
  "Initial commit",
  "Build",
  "Skip"
]
```


## GitHub Actions

You can use it as a GitHub Actions by creating a file `.github/workflows/pisac.yml` with the following content:

```yaml
name: Pisac

on: [ push ]

jobs:
  pisac-cheker:
    runs-on: ubuntu-20.04
    steps:
      - name: Checkout code
        uses: actions/checkout@v2
        with:
          ref: ${{ github.head_ref }}
      - name: Setup PHP 🔧
        uses: shivammathur/setup-php@v2
        with:
          php-version: 8.0
          extensions: mbstring
          coverage: none
          tools: composer:v2
      - name: Install 👀
        run: composer global require "pisac/pisac:0.*" -q -n
      - name: Execute 🔧
        run: pisac check
```

## Composer

> **Not recommended.** Sometimes your project can conflict with one or more of Pisac dependencies.

Alternatively, you can also install Pisac as part of your development dependencies. You will likely want to use the require-dev section to exclude Pisac in your production environment. You can either modify your `composer.json` manually or run the following command to include the latest tagged release:

```bash
$ composer require --dev pisac/pisac
```

And then run as executable:

```bash
$ php vendor/bin/pisac check
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Maintainers

Pisac is developed and maintained by [Alexandr Chernyaev](https://github.com/tabuna).

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

