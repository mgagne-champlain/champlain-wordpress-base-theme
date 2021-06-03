const gulp = require('gulp');
const sass = require('gulp-sass');
const postcss = require('gulp-postcss');
const sourcemaps = require('gulp-sourcemaps');
const autoprefixer = require('autoprefixer');
const cleanCSS = require('gulp-clean-css');

gulp.task('sass', function () {   
    return gulp.src('src/scss/main.scss')
            .pipe(sourcemaps.init())
            .pipe(sass({ errLogToConsole: true }))
            .pipe(postcss([autoprefixer()]))
            .pipe(cleanCSS())
            .pipe(sourcemaps.write('.'))
            .pipe(gulp.dest('src/css')) 
 })

 gulp.task('watch', function() {
    gulp.watch('src/scss/**/*.scss', gulp.series('sass'));
})