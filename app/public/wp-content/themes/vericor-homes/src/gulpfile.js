const gulp = require('gulp');
const autoprefixer = require('gulp-autoprefixer');
const gulpSass = require('gulp-sass');
const minifyCss = require('gulp-minify-css');
const postcss = require('gulp-postcss');
const tailwindcss = require('tailwindcss');
const gulpImageMin = require('gulp-imagemin');

gulp.task('sass', function() {
	return gulp.src('./sass/*.scss')
		.pipe(gulpSass())
		.pipe(gulp.dest('./css'))
});

gulp.task('tailwindcss', function() {
	return gulp.src('./tailwind.css')
    .pipe(postcss([
		tailwindcss('./tailwind.js'),
	]))
	.pipe(autoprefixer())
	.pipe(minifyCss())
    .pipe(gulp.dest('css/'));
});

gulp.task('moveCss', function() {
	return gulp.src('./css/*.css')
	.pipe(gulp.dest('../'))
});
gulp.task('sassify', function() {
	return gulp.src('./sass/*.scss')
		.pipe(gulpSass())
		.pipe(autoprefixer())
		.pipe(minifyCss())
		.pipe(gulp.dest('./css'))
});

gulp.task('image', function() {
	return gulp.src('./images/*.jpg')
		.pipe(gulpImageMin())
		.pipe(gulp.dest('./build/images'))
});

gulp.task('css-minify', function() {
	return gulp.src('./sass/*.scss')
		.pipe(autoprefixer())
		.pipe(minifyCss())
		.pipe(gulp.dest('./styles.min.css'))
});

gulp.task('default', function() {
	console.log('Default');
});