var gulp = require('gulp');
var minifyCss = require('gulp-minify-css');
var rename = require("gulp-rename");
var watch = require('gulp-watch');
var imagemin = require('gulp-imagemin');

gulp.task('css', function(){
	return gulp.src('css/style.css')
	.pipe(rename("style.min.css"))
    .pipe(minifyCss({compatibility: 'ie8'}))
    .pipe(gulp.dest('css/'));
});

gulp.task('watch', function(){
	gulp.watch('./css/style.css', ['css']);
});

gulp.task('images', function(){
	return gulp.src('./img/**/*')
        .pipe(imagemin({
            progressive: true,
            svgoPlugins: [{removeViewBox: false}]
        }))
        .pipe(gulp.dest('dist'));
});

gulp.task('default', ['css']);	