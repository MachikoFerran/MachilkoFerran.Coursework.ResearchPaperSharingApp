// include gulp
var gulp                = require('gulp');
var browserSync         = require('browser-sync').create();
var localhost           = 'personal/'; // изменить на свой хост
// browser-sync task and settings
gulp.task('browserSync', function(){
    browserSync.init({
        open: 'external',
        host: localhost,
        proxy: localhost,
        port: 8080
    });
});
// start watchers
gulp.task('watch', ['browserSync'], function(){
    gulp.watch('**/*.*', browserSync.reload);
});
