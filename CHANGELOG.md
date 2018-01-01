# Changelog
All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](http://keepachangelog.com/)
and this project adheres to [Semantic Versioning](http://semver.org/).

## [4.0.18] - 2018-01-01
### Changed
- Core: Refactor integration tests. [#126](https://github.com/laravel-zero/framework/pull/126)

## [4.0.17] - 2018-01-01
### Changed
- More clear integration test example. [#102](https://github.com/laravel-zero/laravel-zero/pull/102)

## [4.0.16] - 2017-12-14
### Fixed
- Core: Fixes command build with namespace reading from composer.json.

## [4.0.15] - 2017-12-13
### Fixed
- Core: Namespace is now found from composer.json.

## [4.0.14] - 2017-12-13
### Fixed
- Core: Scheduler working with PHAR buids. [#115](https://github.com/laravel-zero/framework/pull/115)

## [4.0.12] - 2017-12-06
### Added
- Core: Adds `task` method on command class.
- Core: Adds log component.
- Core: Adds seeds related commands.
- New database.php configuration `with-seeds => true`.

## [4.0.10] - 2017-11-28

### Fixed

- Core: Fixes build on Mac/Linux.

## [4.0.9] - 2017-11-27

### Fixed

- Core: Fixes build on Windows. [#102](https://github.com/laravel-zero/framework/pull/102)

## [4.0.8] - 2017-11-22

### Changed

- Core: Disables `Collision` on production.

## [4.0.4] - 2017-11-14

### Fixed

- Core: Fixes commands detector.
- On the config/app.php the config `commands-namespaces` was replaced by `commands-paths`.

## [4.0.2] - 2017-11-11

### Fixed

- Core: Fixes missing `league/flysystem` package.

## [4.0.0] - 2017-11-08

### Added
- Core: All configs are auto detected.
- Core: `nunomaduro/collision` added on require section of composer.
- Core: Database component installer now publishes a `database.php` config.
- Core: Improves builder & renamer command signature.
- Core: Adds `with-scheduler` config option.
- Core: Adds `command:make` feature.
- Core: Adds support to `Storage` facade & Flysystem.
- `config/app.php` added containing now only app config.

## [3.10.0] - 2017-11-01
### Changed
- Uses symfony default command by default.

## [3.9.2] - 2017-10-26
### Added
- Core: Auto-detect commands.
- Removes commands entry from `config.php`.

## [3.9.0] - 2017-10-25
### Added
- Core: Moves cache config exists now by default on core.
- Core: Fixes bug on renamer if the file with the same name already exists.
- Cache config remove from `config.php`.

## [3.8.0] - 2017-10-20
### Added
- Requires from composer Laravel Zero Framework `3.8.*`.
- Moves Collision from composer `require-dev` to `require`.
- Adds option `with-migrations` to database config.
- Core: Migrations feature.

## [3.7.0] - 2017-10-12
### Added
- Adds Collision to composer `require-dev`.
- Adds Collision listener to `phpunit.xml`.
- Core: Auto registers collision.

## [3.6.11] - 2017-10-01
### Added
- Core: Adds `config_path` helper.

## [3.6.6] - 2017-09-29
### Added
- Core: Removes output global helpers.

## [3.6.5] - 2017-09-24
### Added
- Core: Adds output global helpers.

## [3.6] - 2017-09-21
### Added
- Core: Adds Scheduler.
- Core: Adds Facades.
- Core: Adds `illuminate/filesystem` component

### Changed
- Renamed base command `AbstractCommand` to `Command`.
- Cache config added to `config.php`.

### Removed
- Core: Removes `illuminate/cache` component. It's now by default.

## [3.5.0] - 2017-09-12
### Added
- Core: Adds `illuminate/filesystem` component.
- Core: Adds `illuminate/cache` component.
- Renames default command to `Hello command`.

## [3.4.0] - 2017-09-04
### Added
- Core: Bumps Laravel components version to 5.5.

## [3.3.0] - 2017-08-27
### Added
- Core: Core commands are not available in production by production. [#29](https://github.com/nunomaduro/laravel-zero/pull/29)
- Core: Adds component:install command.
- Core: Adds illuminate/database component.

## [3.2.0] - 2017-08-22
### Added
- Core: Adds the executable bit on the compiled standalone phar on the builder command.
- Core: Add shebang on the builder command.

## [3.1.0] - 2017-07-21
### Changed
- Core: Fixes bootstrap of service providers.

## [3.0.5] - 2017-07-19
### Changed
- Fixes bind of app container.

## [3.0.0] - 2017-07-16
### Added
- Splits core framework from the project.

### Changed
- Removes performance analyser.
