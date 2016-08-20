var gulp = require('gulp'),
    plumber = require('gulp-plumber'),
    rename = require('gulp-rename');
var autoprefixer = require('gulp-autoprefixer');
var babel = require('gulp-babel');
var concat = require('gulp-concat');
var uglify = require('gulp-uglify');
var imagemin = require('gulp-imagemin'),
    cache = require('gulp-cache');
var minifycss = require('gulp-clean-css');
var sass = require('gulp-sass');
var browserSync = require('browser-sync').create();

gulp.task('browser-sync', function () {
    browserSync.init({
        open: false,
        proxy: "techo.dev"
    });
});

gulp.task('bs-reload', function () {
    browserSync.reload();
});

gulp.task('images', function () {
    return gulp.src('resources/assets/images/*')
        .pipe(imagemin([], true))
.pipe(gulp.dest('public/img/front'))

});

gulp.task('styles', function () {
    return gulp.src(['resources/assets/sass/app.scss'])
        .pipe(plumber({
            errorHandler: function (error) {
                console.log(error.message);
                this.emit('end');
            }
        }))
        .pipe(sass({
            includePaths: [require('node-bourbon').includePaths, require('bourbon-neat').includePaths],
            style: 'compressed',
            quiet: true
        }))
        .pipe(autoprefixer('last 2 versions'))
        .pipe(gulp.dest('public/css/'))
        .pipe(rename({suffix: '.min'}))
        .pipe(minifycss())
        .pipe(gulp.dest('public/css/'))
        .pipe(browserSync.reload({stream: true}))
});

gulp.task('scripts', function () {
    return gulp.src('resources/assets/js/**/*.js')
        .pipe(plumber({
            errorHandler: function (error) {
                console.log(error.message);
                this.emit('end');
            }
        }))
        //.pipe(jshint())
        //.pipe(jshint.reporter('default'))
        .pipe(concat('main.js'))
        .pipe(babel({compact: false}))
        .pipe(gulp.dest('public/js/'))
        .pipe(rename({suffix: '.min'}))
        .pipe(uglify())
      //  .pipe(sourcemaps.write('maps'))// TOdo agregar este add y ver como funciona
        .pipe(gulp.dest('public/js/'))
        .pipe(browserSync.reload({stream: true}))
});

gulp.task('all', ['scripts', 'styles', /*'images'*/], function () {
});

gulp.task('default', ['all', 'browser-sync'], function () {
    gulp.watch("resources/assets/sass/**/*.scss", ['styles']);
    gulp.watch("resources/assets/js/**/*.js", ['scripts']);
    gulp.watch("resources/views/**/*.php", ['bs-reload']);
});

