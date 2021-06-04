const gulp = require('gulp');
const sass = require('gulp-sass');
const postcss = require('gulp-postcss');
const sourcemaps = require('gulp-sourcemaps');
const autoprefixer = require('autoprefixer');
const cleanCSS = require('gulp-clean-css');
const uglify = require( 'gulp-uglify' );
const rename = require( 'gulp-rename' );
const include = require( 'gulp-include' );

// Build SASS with sourcemap (leave full/min copies)
gulp.task('sass', function () {   
    return gulp.src('src/scss/main.scss')
        .pipe(sourcemaps.init())
        .pipe(sass({ errLogToConsole: true }))
        .pipe(postcss([autoprefixer()]))
        .pipe(sourcemaps.write())
        .pipe(gulp.dest('build/css')) 
        .pipe(cleanCSS())
        .pipe( rename( { suffix: '.min' } ) )
        .pipe(sourcemaps.write('.'))
        .pipe(gulp.dest('build/css')) 
})

gulp.task('watch', function() {
    gulp.watch('src/scss/**/*.scss', gulp.series('sass'));
})

gulp.task( 'scripts', function() {
    return gulp.src( 'src/js/manifest.js' )
        .pipe( include() )
        .pipe( rename( { basename: 'scripts' } ) )
        .pipe( gulp.dest( 'build/js' ) )
        // Normal done, time to create the minified javascript (scripts.min.js)
        // remove the following 3 lines if you don't want it
        .pipe( uglify() )
        .pipe( rename( { suffix: '.min' } ) )
        .pipe( gulp.dest( 'build/js' ) );
} );

gulp.task('build', gulp.parallel('sass', 'scripts'));