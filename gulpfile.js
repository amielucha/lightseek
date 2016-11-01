const gulp = require('gulp');
const sass = require('gulp-sass');
const cssnano = require('gulp-cssnano');
const sourcemaps = require('gulp-sourcemaps');
const autoprefixer = require('gulp-autoprefixer');

gulp.task('default', function() {
  console.log('Hello Zell');
});

// Full build
gulp.task('default', function(){
  return gulp.src('./style.scss')
	  .pipe(sourcemaps.init())
	  .pipe(sass().on('error', sass.logError))
	  .pipe(autoprefixer({
        browsers: ['last 2 versions'],
        cascade: false
    }))
	  .pipe(cssnano())
	  .pipe(sourcemaps.write('./'))
    .pipe(gulp.dest('./'))
});

// build without minification
gulp.task('dev', function(){
  return gulp.src('./style.scss')
	  .pipe(sourcemaps.init())
	  .pipe(sass().on('error', sass.logError))
	  .pipe(autoprefixer({
        browsers: ['last 2 versions'],
        cascade: false
    }))
	  .pipe(sourcemaps.write('./'))
    .pipe(gulp.dest('./'))
});

gulp.task('watch', function(){
  gulp.watch('./style.scss', ['dev']);
  // Other watchers
});
