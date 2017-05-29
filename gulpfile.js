var gulp = require('gulp'), 
    sass = require('gulp-sass') ,
    notify = require("gulp-notify") ,
    bower = require('gulp-bower'),
    gulpCopy = require('gulp-copy');

var config = {
 sassPath: './interface/themes/src',
 bowerDir: './public/assets' ,
    outputPath: './interface/themes/dist',
};

gulp.task('bower', function() { 
    return bower().pipe(gulp.dest(config.bowerDir)) 
});

gulp.task('css', function(cb) { 
    let options = {
        outputStyle: 'compressed'
    };
    let stream = gulp.src(config.sassPath+'/*.scss')
        .pipe(sass(options).on('error', sass.logError))
        .pipe(gulp.dest(config.outputPath));
    return stream;
});

// Rerun the task when a file changes
 gulp.task('watch', function() {
    gulp.watch(config.sassPath + '/**/*.scss', ['css']);
});

  gulp.task('default', ['bower', 'css']);
