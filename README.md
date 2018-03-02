Lightseek is a starter WordPress theme we use at [iSeek](http://www.iseek.ie/).

## Installation

Lightseek requires [Gulp](http://gulpjs.com/).

First install the node dependencies:

`npm install`

Then build the styles:

`gulp`

The default build prepares a minified, production-ready CSS.

For a faster compilation process (not minified), you can use:

`gulp dev`

You can also watch files for changes. Watch task uses dev mode:

`gulp watch`

## FTP config

Version 1.5 introduces two new watchers that automatically upload changed files via FTP. `ftp-watch` is a develompent task and `ftp-watch-live` is a slower task that includes minifiers.

To configure the FTP connection under Windows set `FTP_HOST`, `FTP_USER` and `FTP_PWD` variables. Example:

```set FTP_HOST=web.darklite.ie & set FTP_USER=username & FTP_PWD=password123 & gulp ftp-watch```

You should also configure `rootFolder` and (alternative for FTP_HOST variable) `hostName` in `gulpfile.js`.

Version 1.8 adds scripts and a new build watch mode `gulp watch-full` that builds the full application on save incl. minifying.

## Changelog

### 1.9.0 (2017-08-03)

- added opening and closing theme hooks, so all opening/closing tags can be edited in one place: `inc/template-wrappers.php`.
- fixed IE11 issue when `main` element would not behave as a `.container` despite having the class.

### 1.9.3 (2017-10-17)

- Updated Bootstrap to version 4.0-beta. Bootstrap files are no longer shipped with the theme.

### 1.9.5 (2018-03-02)

- Updated Bootstrap to version 4.0-beta. Bootstrap files are no longer shipped with the theme.
