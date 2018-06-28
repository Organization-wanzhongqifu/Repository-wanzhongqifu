'use strict';

var gulp = require('gulp'),
    sass = require('gulp-sass'),
    autoprefixer = require('gulp-autoprefixer'),
    sourcemaps = require('gulp-sourcemaps'),
    browserSync = require('browser-sync');


// Start browserSync server
gulp.task('browserSync', function() {
    browserSync({
        server: {
            baseDir: './'
        },
        notify: false,
        port: 5200 //Default port is 5200, multiple projects can be customized port operation
    })
})

// sass
gulp.task('sass', function() {
    return gulp.src('./style/sass/**/*.scss')
        .pipe(sourcemaps.init())
        .pipe(sass({
            outputStyle: 'compressed'
        }))
        .pipe(autoprefixer('last 15 version'))
        .pipe(sourcemaps.write('./'))
        .pipe(gulp.dest('./style/'))
        .pipe(browserSync.stream({ match: '**/*.css' }))
        .on('error', function(err) {
            console.error('Error!', err.message);
        });
});

//watch
gulp.task('watch', function() {
    gulp.watch('style/sass/**/*.scss', ['sass']);
    gulp.watch('**/*.html', browserSync.reload);
    gulp.watch('js/**/*.js', browserSync.reload);
});

//gulp 启动
gulp.task('default', ['watch', 'sass', 'browserSync']);
