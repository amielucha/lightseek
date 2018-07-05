Lightseek is a starter WordPress theme we use at [iSeek](https://www.iseek.ie/).

## Installation

Lightseek requires [Gulp](https://gulpjs.com/).

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

- Updated Bootstrap to version 4.
- Updated Node SASS to fix compatibility issues.
- Tidied up the sidebar column layouts.

### 1.9.6 (2018-03-05)

- Improved the experience when logged in to WordPress and the body container is set to grid. The page height calculation is corrected for the dimensions of the WP admin bar.

### 1.10.0 (2018-03-06)

- Updated FontAwesome to version 5.
- Fixed `.top-bar` display when using Grid layout.

### 1.11.0 (2018-03-27)

- Added a custom var_dump().
- Removed bottom margin from `.btn`.
- Fixed sidebar column display on mobiles.
- Added theme `index.php` protection.

### 1.12.0 (2018-05-02)

- Added Font Awesome Pro support (requires file upload to the theme directory).
- Added Breadcrumbs action (requires Yoast SEO plugin with Breadcrumbs active).
- Updated script defer function.
- Fixed incorrect WooCommerce SCSS URL
- Commented out `.form-control-label` in Gravity Forms SCSS. It's no longer supported by Bootstrap.
- Changed the default spacer classes

### 1.13.0 (2018-06-26)

- Added Gravity Helpers CSS to prevent layout issues when default GF styles are disabled.
- Fixed the Search Form layout to display correctly using Bootstrap 4 classes and enabled Input Group styles by default.

### 1.14.0 (2018-07-05)

- Added support for WooCommerce lightbox and gallery.
