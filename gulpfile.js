/* Configure FTP */
//
const rootFolder = 'beta.darcyshairdressing.ie'; // example: 'website.com'
const hostName = 'web2.darklite.ie';
/* #Configure FTP */

// Set variables in Windows like this:
//  `set FTP_USER=username`
//  `set FTP_PWD=password123`
const user = process.env.FTP_USER || '';
const password =  process.env.FTP_PWD || '';
const host = process.env.FTP_HOST || hostName;
const remoteFolder ='/' + rootFolder + '/wp-content/themes/lightseek/';
const port = 21;
const localFilesGlob = ['./*', './fonts/*', './images/*', './inc/*', './js/*', './modules/*', './scss/*', '!./*.{css,map,js}' ];
const localFilesUpload = ['./*', './fonts/*', './images/*', './inc/*', './js/*', './modules/*', './scss/*', '!./*.{js}' ];


// Requires
const gulp = require('gulp');
const ftp = require('vinyl-ftp');
const sass = require('gulp-sass');
const gutil = require('gulp-util');
const cssnano = require('cssnano');
const postcss = require('gulp-postcss');
const autoprefixer = require('autoprefixer');
const sourcemaps = require('gulp-sourcemaps');
const flexbug = require('postcss-flexbugs-fixes');


// helper function to build an FTP connection based on our configuration
function getFtpConnection() {
  return ftp.create({
    host: host,
    port: port,
    user: user,
    password: password,
    parallel: 5,
    log: gutil.log
  });
}


// Full build
gulp.task('default', function(){
  var processors = [
    autoprefixer({
        browsers: ['last 2 versions'],
        cascade: false
    }),
    cssnano(),
    flexbug(),
  ];

  return gulp.src('./style.scss')
	  .pipe(sourcemaps.init())
	  .pipe(sass().on('error', sass.logError))
	  .pipe(postcss(processors))
	  .pipe(sourcemaps.write('./'))
    .pipe(gulp.dest('./'))
});

// build without minification
gulp.task('dev', function(){
  var processors = [
    autoprefixer({
        browsers: ['last 2 versions'],
        cascade: false
    }),
    flexbug(),
  ];

  return gulp.src('./style.scss')
    .pipe(sourcemaps.init())
    .pipe(sass().on('error', sass.logError))
    .pipe(postcss(processors))
    .pipe(sourcemaps.write('./'))
    .pipe(gulp.dest('./'))
});

// Local watch - dev
gulp.task('watch', function(){
  gulp.watch('./style.scss', ['dev']);
});

// Upload via FTP - dev
gulp.task('upload-dev', ['dev'], function(){
  var conn = getFtpConnection();
  console.log('Changes detected! Uploading file');

  return gulp.src( localFilesUpload, { base: '.', buffer: false } )
    .pipe( conn.newer( remoteFolder ) ) // only upload newer files
    .pipe( conn.dest( remoteFolder ) );
});

// upload via FTP
gulp.task('upload', ['default'], function(){
  var conn = getFtpConnection();
  console.log('Changes detected! Uploading file');

  return gulp.src( localFilesUpload, { base: '.', buffer: false } )
    .pipe( conn.newer( remoteFolder ) ) // only upload newer files
    .pipe( conn.dest( remoteFolder ) );
});

// FTP Dev watcher
gulp.task('ftp-watch', function(){
  var conn = getFtpConnection();
  gulp.watch(localFilesGlob, ['upload-dev']);
});

// FTP Live Site watcher
gulp.task('ftp-watch-live', function(){
  var conn = getFtpConnection();
  gulp.watch(localFilesGlob, ['upload']);
});
