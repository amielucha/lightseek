Lightseek is a starter WordPress theme we use at [iSeek](http://www.iseek.ie/).

## Installation

Lightseek requires [Gulp](http://gulpjs.com/).

First install the node dependencies:

``` npm install ```

Then build the styles:

``` gulp ```

The default build prepares a minified, production-ready CSS.

For a faster compilation process (not minified), you can use:

``` gulp dev ```

You can also watch files for changes. Watch task uses dev mode:

``` gulp watch ```


## FTP config

Version 1.5 introduces two new watchers that automatically upload changed files via FTP. `ftp-watch` is a develompent task and `ftp-watch-live` is a slower task that includes minifiers.

To configure the FTP connection under Windows set `FTP_HOST`, `FTP_USER` and `FTP_PWD` variables. Example:

````set FTP_HOST=web.darklite.ie & set FTP_USER=username & FTP_PWD=password123 & gulp ftp-watch```

You should also configure `rootFolder` and (alternative for FTP_HOST variable) `hostName` in `gulpfile.js`.

Version 1.8 adds scripts and a new build watch mode `gulp watch-full` that builds the full application on save incl. minifying.
