const gulp = require('gulp');
const sass = require('gulp-sass');
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
const injectVersion = require('gulp-inject-version');
const groupMediaQueries = require('gulp-group-css-media-queries');

// Watch locations
const localFilesGlob = ['./*', './fonts/*', './images/*', './inc/*', './js/src/*', './modules/*', './scss/*', '!./*.{css,map,js}'];

// build without minification
gulp.task('dev', function() {
    var processors = [
        autoprefixer({
            overrideBrowserslist: ['last 2 versions'],
            cascade: false
        }),
        flexbug(),
    ];

    return gulp.src('./style.scss')
        .pipe(injectVersion())
        .pipe(sourcemaps.init())
        .pipe(plumber({ errorHandler: notify.onError("Error: <%= error.message %>") }))
        .pipe(sass().on('error', sass.logError))
        .pipe(postcss(processors))
        .pipe(sourcemaps.write('./'))
        .pipe(gulp.dest('./'))
});

// JS
gulp.task('js', function() {
    const jsFiles = [
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
gulp.task('watch', function() {
    gulp.watch(localFilesGlob, gulp.series('dev'));
});

// Local watch - full build
gulp.task('watch-full', function() {
    gulp.watch(localFilesGlob, gulp.series('default'));
});

// Full build
gulp.task('default', gulp.series('js', function() {
    var processors = [
        autoprefixer({
            overrideBrowserslist: ['last 2 versions'],
            cascade: false
        }),
        //cssnano(),
        flexbug(),
    ];

    return gulp.src('./style.scss')
        .pipe(injectVersion())
        .pipe(sourcemaps.init())
        .pipe(plumber({ errorHandler: notify.onError("Error: <%= error.message %>") }))
        .pipe(sass().on('error', sass.logError))
        .pipe(groupMediaQueries())
        .pipe(postcss(processors))
        .pipe(sourcemaps.write('./'))
        .pipe(gulp.dest('./'))
}));