// Include gulp
var gulp = require('gulp');

// Include plugins
var concat = require('gulp-concat');
var uglify = require('gulp-uglify');
var rename = require('gulp-rename');

// Concatenate JS Files
gulp.task('concat-scripts', function() {
    return gulp.src("assets/js/dev/*.js")
      .pipe(concat('main.js'))
      	.pipe(gulp.dest('assets/js'))
      	.pipe(rename({suffix: '.min'}))
      	.pipe(uglify())
      	.pipe(gulp.dest('assets/js'));
});

// Default Task
gulp.task('default', ['watch']);

//watch task
gulp.task('watch', function(){
	gulp.watch('assets/js/dev/*.js', ['concat-scripts']);
});
