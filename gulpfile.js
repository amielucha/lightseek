const gulp = require('gulp');
const sass = require('gulp-sass');

const postcss = require('gulp-postcss');
const autoprefixer = require('autoprefixer');
const cssnano = require('cssnano');
const flexbug = require('postcss-flexbugs-fixes');

//const cssnano = require('gulp-cssnano');
const sourcemaps = require('gulp-sourcemaps');
//const autoprefixer = require('gulp-autoprefixer');

gulp.task('default', function() {
  console.log('Hello Zell');
});

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

gulp.task('watch', function(){
  gulp.watch('./style.scss', ['dev']);
  // Other watchers
});
