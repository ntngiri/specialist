var gulp = require('gulp');
var sass = require('gulp-sass');
var minifyCSS = require('gulp-csso');
var connect = require('gulp-connect');
var imagemin = require('gulp-imagemin');
var babel = require('gulp-babel');
var coffee = require('gulp-coffee');
var concat = require('gulp-concat');
var uglify = require('gulp-uglify');
var sourcemaps = require('gulp-sourcemaps');
var del = require('del');

var paths = {
  scripts: 'app/js/*.js',
  images: 'app/assets/img/*',
  sass:'app/assets/sass/*.scss',
  html:'app/templates/*.html'
};

gulp.task('clean', function() {
  // You can use multiple globbing patterns as you would with `gulp.src`
  return del(['build']);
});

gulp.task('scripts', function() {
  // Minify and copy all JavaScript (except vendor scripts)
  // with sourcemaps all the way down
  return gulp.src(paths.scripts)
    .pipe(sourcemaps.init())
      .pipe(babel())
      .pipe(concat('all.min.js'))
    .pipe(sourcemaps.write())
    .pipe(gulp.dest('build/js'));
});

gulp.task('html', function(){
  return gulp.src('app/templates/*.html')
    .pipe(gulp.dest('build/html'))
});

gulp.task('css', function(){
  return gulp.src('app/assets/sass/*.scss')
    .pipe(sass().on('error', sass.logError))
    .pipe(minifyCSS())
    .pipe(concat('all.min.css'))
    .pipe(gulp.dest('build/css'))
    .pipe(connect.reload());
});

// gulp.task('webserver', function() {
//   connect.server({
//   	livereload: true
//   });
// });

// gulp.task('imageMin', function(){
//     gulp.src('app/assets/img/*')
//         .pipe(imagemin())
//         .pipe(gulp.dest('build/images'))
// });

// Copy all static images
gulp.task('imageMin', function() {
  return gulp.src(paths.images)
    // Pass in options to the task
    .pipe(imagemin({optimizationLevel: 5}))
    .pipe(gulp.dest('build/images'));
});

gulp.task('babelify', function () {
    return gulp.src('app/js/*.js')
        .pipe(babel())
        .pipe(gulp.dest('build/js'));
});

gulp.task('watch', function() {
  gulp.watch(paths.scripts, ['scripts']);
  gulp.watch(paths.images, ['imageMin']);
  gulp.watch(paths.sass, ['css']);
  gulp.watch(paths.html,['html']);
});



gulp.task('default', [ 'watch','html', 'css','scripts','imageMin']);
