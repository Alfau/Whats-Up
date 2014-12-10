// Include gulp
var gulp = require('gulp');

// Include plugins
var concat = require('gulp-concat');
var uglify = require('gulp-uglify');
var rename = require('gulp-rename');
var order = require('gulp-order');

// Concatenate JS Files
$filesOrder = ["init.js", "req.js", "slideshow.js", "carousel.js", "handle.js", "small_cards.js", "large_cards.js", "room_cards.js", "includes_cards.js", "render_home.js", "basic_cards.js", "helper_functions.js"];

gulp.task('concat-scripts', function() {
    return gulp.src("assets/js/dev/*.js")
		.pipe(order($filesOrder))    
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
