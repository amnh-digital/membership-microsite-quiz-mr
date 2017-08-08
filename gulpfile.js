var gulp        	= require( 'gulp' );
var sass        	= require( 'gulp-sass' );
var watch       	= require( 'gulp-watch' );
var insert      	= require( 'gulp-insert' );
var rename      	= require( 'gulp-rename' );
var mainBowerFiles 	= require('main-bower-files');
var cleanCSS 		= require('gulp-clean-css');
var image 			= require('gulp-image');

// Include plugins
var plugins = require("gulp-load-plugins")({
	pattern: ['gulp-*', 'gulp.*', 'main-bower-files'],
	replaceString: /\bgulp[\-.]/
});

//
//  SCSS
//
/*
gulp.task( 'sass', function() {
  gulp.src( './src/sass/main.scss' )
    .pipe( sass() )
    .pipe( gulp.dest( './dist/css/' ) )
});*/

gulp.task( 'sass', function() {
	var cssFiles = ['./src/sass/main.scss'];

	console.log(plugins.mainBowerFiles());

	gulp.src(plugins.mainBowerFiles().concat(cssFiles))
		.pipe(plugins.filter(['**/*.css','**/*.scss']))
		.pipe(plugins.order([
			'normalize.css',
			'*'
		]))
		.pipe( sass() )
		.pipe(plugins.concat('main.css'))
		.pipe(cleanCSS({compatibility: 'ie8'}))
		.pipe(gulp.dest( './web/dist/css/' ));

});

gulp.task('fonts', function() {
    return gulp.src([
                    'public/vendor/components-font-awesome/fonts/fontawesome-webfont.*'])
            .pipe(gulp.dest('./web/dist/fonts/'));
});


//
//  Watch
//
gulp.task( 'watch', function() {
  gulp.watch( './src/sass/**/*.scss', ['sass'] );
  gulp.watch( './src/sass/**/*.css', ['sass'] );
  gulp.watch( './src/js/**/*.js', ['js'] );
});

gulp.task('js', function() {

	var jsFiles = ['src/js/*'];

	gulp.src(plugins.mainBowerFiles().concat(jsFiles))
		.pipe(plugins.filter('**/*.js'))
		.pipe(plugins.concat('main.js'))
		.pipe(plugins.uglify())
		.pipe(gulp.dest('./web/dist/js/'));

});

gulp.task('image', function () {
  gulp.src('./src/img/*')
    .pipe(image())
    .pipe(gulp.dest('./web/dist/img/'));
});

//
//  Build tasks
//
gulp.task( 'heroku:production', ['sass','js','image','fonts'] );
gulp.task( 'default', ['sass','js','fonts'] );