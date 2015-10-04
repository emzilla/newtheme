// Include gulp and plugins
var gulp    = require('gulp'),
      autoprefixer = require('gulp-autoprefixer'),
      sass    = require('gulp-sass'),
      concat  = require('gulp-concat'),
      uglify  = require('gulp-uglify'),
      gutil   = require('gulp-util'),
      newer = require('gulp-newer'),
      imagemin = require('gulp-imagemin'),
      notify = require('gulp-notify')
      plumber = require('gulp-plumber');

var onError = function(err) {
    // Notfiy (message and sound)
    notify.onError({
        title:    "Gulp",
        subtitle: "Failure!",
        message:  "Error: <%= error.message %>",
        sound:    "Funk"
    })(err);

    this.emit('end');
};


// Compile Our Sass
gulp.task('sass', function() {
	return gulp.src('css/scss/**/*.scss')
		.pipe(plumber({ errorHandler: onError }))
		.pipe(sass())
		.pipe(autoprefixer('last 2 version'))
		.pipe(gulp.dest('css'));
});

// Concatenate & Minify JS
gulp.task('scripts', function() { 
	return gulp.src(['js/vendors/*.js'])
		.pipe(plumber({ errorHandler: onError }))
		.pipe(concat('scripts.min.js'))
		.pipe(gulp.dest('js'))
		.pipe(uglify())
		.pipe(gulp.dest('js'));
});

// Optimize images
gulp.task('images', function() {
  return gulp.src('img/**/*')
	// .pipe(plumber({ errorHandler: onError }))
      .pipe(newer('img'))
      .pipe(imagemin())
      .pipe(gulp.dest('img'));
});

// Watch Files For Changes
gulp.task('watch', function() {
	// gulp.watch('js/**/*.js', ['scripts']);
	gulp.watch('css/scss/**/*.scss', ['sass']);
	gulp.watch('img/**/*', ['images']);
});

// Default Task
gulp.task('default', ['sass', 'images']);