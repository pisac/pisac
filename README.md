## Pisac - Keep git commit histories clean


Commits are one of the key parts of a Git repository, and more so, the commit message is a life log for the repository. As the project/repository evolves over time (new features getting added, bugs being fixed, architecture being refactored), commit messages are the place where one can see what was changed and how. So it's important that these messages reflect the underlying change in a short, precise manner.


#### Git commit history is very easy to mess up, here's how you can fix it!


**Pisac** is added to your CI, and when they commit description failed validation, an error occurs. Usually, everyone in the project gets an error message, so you can stop your friends from writing a bad description.


## Configuration

To configure the validation rules, you need to create a new file called `pisac.json` in the project root. For example:

```json
{
  "pattern": "(Added|Changed|Deprecated|Removed|Fixed|Security) \\w+",
  "message": "The commit must start with words (Added|Changed|Deprecated|Removed|Fixed|Security)",
  "limit": 5,
  "skip": [
    "Fix styling",
    "Initial commit"
  ]
}
```

## Github Actions

You can use it as a Github Actions by creating a file `.github/workflows/pisac.yml` with the following content:

```yaml
TODO:
```

## Docker

A Docker-Image is built automatically and located here:https://hub.docker.com/r/...

You can run it in any given directory like this:

```bash
TODO:
```

## Phar

TODO:

## Composer

You can also install it as a composer dependency (Not recommended):

```bash
$ composer require pisac/pisac
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

