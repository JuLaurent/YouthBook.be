var gulp = require('gulp'),
    autoprefixer = require('gulp-autoprefixer'),
    sass = require('gulp-sass'),
    sourcemaps = require('gulp-sourcemaps'),
    plumber = require('gulp-plumber'),
    uglify = require('gulp-uglify');
    concat = require('gulp-concat');


gulp.task('scss-compile', function() {
    gulp.src('./app/webroot/scss/main.scss')
        .pipe(plumber())
        .pipe(sourcemaps.init())
            .pipe(sass({outputStyle: 'compressed'}))
            .pipe(autoprefixer('last 2 version', 'ie8', 'ie9'))
        .pipe(sourcemaps.write('./'))
        .pipe(gulp.dest('./app/webroot/css'));
});

gulp.task('compress', function() {
    return gulp.src('./app/webroot/js/production/*.js')
    //.pipe(uglify())
    .pipe(concat('main.js'))
    .pipe(gulp.dest('./app/webroot/js'));
});

gulp.task('default', function () {
    gulp.watch('./app/webroot/scss/*', ['scss-compile']);
    gulp.watch('./app/webroot/js/production/*.js', ['compress']);
});
