/* Configure FTP */
//
const rootFolder = ''; // example: 'website.com'
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
const localFilesGlob = ['./*', './fonts/*', './images/*', './inc/*', './js/src/*', './modules/*', './scss/*', '!./*.{css,map,js}' ];
const localFilesUpload = ['./*', './fonts/*', './images/*', './inc/*', './js/*', './modules/*', './scss/*', '!./*.{js}' ];


// Requires
const gulp = require('gulp');
const ftp = require('vinyl-ftp');
const sass = require('gulp-sass');
const gutil = require('gulp-util');
const cssnano = require('cssnano');
const babel = require('gulp-babel');
const concat = require('gulp-concat');
const rename = require('gulp-rename');
const uglify = require('gulp-uglify');
const notify = require('gulp-notify');
const plumber = require('gulp-plumber');
const postcss = require('gulp-postcss');
const autoprefixer = require('autoprefixer');
const sourcemaps = require('gulp-sourcemaps');
const flexbug = require('postcss-flexbugs-fixes');
const groupMediaQueries = require('gulp-group-css-media-queries');

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
gulp.task('default', ['js'],  function(){
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
    .pipe(plumber({errorHandler: notify.onError("Error: <%= error.message %>")}))
    .pipe(sass().on('error', sass.logError))
    .pipe(groupMediaQueries())
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
    .pipe(plumber({errorHandler: notify.onError("Error: <%= error.message %>")}))
    .pipe(sass().on('error', sass.logError))
    .pipe(postcss(processors))
    .pipe(sourcemaps.write('./'))
    .pipe(gulp.dest('./'))
});

// ES2015
gulp.task('js', function () {
  const jsFiles = [
    // './js/src/bootstrap/alert.js,
    // './js/src/bootstrap/button.js,
    // './js/src/bootstrap/carousel.js,
    // './js/src/bootstrap/collapse.js,
    // './js/src/bootstrap/dropdown.js,
    // './js/src/bootstrap/modal.js,
    // './js/src/bootstrap/popover.js,
    // './js/src/bootstrap/scrollspy.js,
    // './js/src/bootstrap/tab.js,
    // './js/src/bootstrap/tooltip.js,
    // './js/src/bootstrap/util.js,
    //'./js/src/jquery.fitvids.js',
    //'./js/src/maps.noscroll.js',
    './js/src/scripts.js'
  ];

  return gulp.src(jsFiles)
    .pipe(sourcemaps.init())
    .pipe(concat('main.js'))
    .pipe(babel())
    .pipe(rename('main.min.js'))
    .pipe(uglify())
    .pipe(sourcemaps.write('.'))
    .pipe(gulp.dest('./js/'));
});

// Local watch - dev
gulp.task('watch', function(){
  gulp.watch(localFilesGlob, ['dev']);
});

// Local watch - full build
gulp.task('watch-full', function(){
  gulp.watch(localFilesGlob, ['default']);
});

// Upload via FTP - dev
gulp.task('upload-dev', ['dev'], function(){
  var conn = getFtpConnection();
  console.log('Changes detected! Uploading file');

  return gulp.src( localFilesUpload, { base: '.', buffer: false } )
    .pipe(plumber({errorHandler: notify.onError("Error: <%= error.message %>")}))
    .pipe( conn.newer( remoteFolder ) ) // only upload newer files
    .pipe( conn.dest( remoteFolder ) );
});

// upload via FTP
gulp.task('upload', ['default'], function(){
  var conn = getFtpConnection();
  console.log('Changes detected! Uploading file');

  return gulp.src( localFilesUpload, { base: '.', buffer: false } )
    .pipe(plumber({errorHandler: notify.onError("Error: <%= error.message %>")}))
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
