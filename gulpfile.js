var gulp = require('gulp'),
        concat = require('gulp-concat'),
        uglify = require('gulp-uglify'),
        uglifycss = require('gulp-uglifycss'),
        sourcemaps = require('gulp-sourcemaps'),
        clean = require('gulp-clean'),
        gulpwatch = require('gulp-watch'),
        rev = require('gulp-rev'),
        revOutdated = require('gulp-rev-outdated'),
        gulpif = require('gulp-if'),
        rename = require('gulp-rename'),
        merge = require('gulp-merge'),
        asyncForeach = require('async-foreach'),
        less = require('gulp-less'),
        replacePath = require('gulp-replace-path'),
        replace = require('gulp-replace'),
        autoprefixer = require('gulp-autoprefixer');

var path = require('path');
var rimraf = require('rimraf');
var through2 = require('through2');
var fs = require('fs');

function cleaner() {
    return through2.obj(function (file, enc, cb) {
        rimraf(path.resolve((file.cwd || process.cwd()), file.path), function (err) {
            rimraf(path.resolve((file.cwd || process.cwd()), file.path + '.map'), function (err) {});
            this.push(file);

            cb();
        }.bind(this));
    });
}

var isProd = process.env.SYMFONY_DEBUG != 1;

gulp.task('vendors:prepare', function (cb) {
    var assets = [
        {
            src: './bower_components/jquery/dist/jquery.js',
            concat: 'jquery.js',
            dest: 'js'
        },
        {
            src: './bower_components/lodash/dist/lodash.js',
            concat: 'lodash.js',
            dest: 'js'
        },
        {
            src: './bower_components/owl.carousel/dist/owl.carousel.js',
            concat: 'owl.carousel.js',
            dest: 'js'
        },
        {
            src: './bower_components/bootstrap/dist/js/bootstrap.js',
            concat: 'bootstrap.js',
            dest: 'js'
        },
        {
            src: './bower_components/slick-carousel/slick/slick.min.js',
            concat: 'slick.min.js',
            dest: 'js'
        },
        {
            src: './bower_components/jquery-form/src/jquery.form.js',
            concat: 'jquery.form.js',
            dest: 'js'
        },
        {
            src: './bower_components/bootstrap/less/bootstrap.less',
            concat: 'bootstrap.css',
            dest: 'css'
        },
        {
            src: './bower_components/slick-carousel/slick/slick.css',
            concat: 'slick.css',
            dest: 'css'
        },
        {
            src: './bower_components/slick-carousel/slick/slick-theme.css',
            concat: 'slick-theme.css',
            dest: 'css'
        },
        {
            src: './bower_components/owl.carousel/dist/assets/owl.carousel.min.css',
            concat: 'owl.carousel.min.css',
            dest: 'css'
        },
        {
            src: './bower_components/owl.carousel/dist/assets/owl.theme.default.min.css',
            concat: 'owl.theme.default.min.css',
            dest: 'css'
        },
        {
            src: './bower_components/bootstrap/fonts/*',
            dest: 'fonts'
        },
        {
            src: './bower_components/slick-carousel/slick/fonts/*',
            dest: 'fonts'
        },
        {
            src: [
                './bower_components/blueimp-file-upload/js/jquery.iframe-transport.js',
                './bower_components/blueimp-file-upload/js/vendor/jquery.ui.widget.js',
                './bower_components/blueimp-file-upload/js/jquery.fileupload.js',
                './bower_components/blueimp-file-upload/js/jquery.fileupload-process.js'
            ],
            concat: 'fileupload.js',
            dest: 'js'
        },
        {
            src: './bower_components/blueimp-file-upload/css/jquery.fileupload.css',
            concat: 'fileupload.css',
            dest: 'css'
        },
        {
            src: './bower_components/blueimp-file-upload/css/jquery.fileupload-noscript.css',
            concat: 'fileupload-noscript.css',
            dest: 'css'
        },
        {
            src: './bower_components/jquery-mask-plugin/dist/jquery.mask.js',
            concat: 'mask.js',
            dest: 'js'
        },
        {
            src: './bower_components/jquery.maskedinput/dist/jquery.maskedinput.js',
            concat: 'maskedinput.js',
            dest: 'js'
        },
        {
            src: './bower_components/jquery-touchswipe/jquery.touchSwipe.js',
            concat: 'jquery.touchSwipe.js',
            dest: 'js'
        },
        {
            src: './bower_components/ionrangeslider/js/ion.rangeSlider.js',
            concat: 'ion.rangeSlider.js',
            dest: 'js'
        },
        {
            src: './bower_components/ionrangeslider/css/ion.rangeSlider.css',
            concat: 'ion.rangeSlider.css',
            dest: 'css'
        },
        {
            src: './bower_components/ionrangeslider/css/ion.rangeSlider.skinNice.css',
            concat: 'ion.rangeSlider.skinNice.css',
            dest: 'css'
        },
        {
            src: './bower_components/es6-promise-polyfill/promise.js',
            concat: 'promise.js',
            dest: 'js'
        },
        {
            src: './bower_components/es6-promise/es6-promise.js',
            concat: 'es6-promise.js',
            dest: 'js'
        },
        {
            src: './bower_components/es6-promise/es6-promise.auto.js',
            concat: 'es6-promise.auto.js',
            dest: 'js'
        },
        {
            src: './bower_components/moment/moment.js',
            concat: 'moment.js',
            dest: 'js'
        },
        {
            src: './bower_components/moment/locale/ru.js',
            concat: 'moment/locale/ru.js',
            dest: 'js'
        },
        {
            src: './bower_components/select2/dist/js/select2.js',
            concat: 'select2.js',
            dest: 'js'
        },
        {
            src: './bower_components/select2/dist/css/select2.css',
            concat: 'select2.css',
            dest: 'css'
        }

    ];

    asyncForeach.forEach(assets, function (asset, index) {
        var concatPipe = 'none';
        if (asset.concat) {
            concatPipe = concat(asset.concat);
        }

        var done = this.async();

        gulp
                .src(asset.src)
                .pipe(gulpif(/\.less/i, less()))
                .pipe(gulpif(concatPipe !== 'none', concatPipe))
                .pipe(gulp.dest('./web/assets-vendor/' + (asset.dest ? asset.dest : '')))
                .on('end', function () {
                    done();
                })

    }, function () {
        cb()
    });


});

gulp.task('vendors:copy', ['vendors:prepare'], function () {
    return gulp.src([
        './web/assets-vendor/fonts/**'
    ], {'base': './web/assets-vendor/'})
            .pipe(rev())
            .pipe(through2.obj(function (file, enc, cb) {
                if (file.revOrigPath) {
                    file.path = file.revOrigPath
                }
                return cb(null, file)
            }))
            .pipe(gulp.dest('./web'))
            .pipe(rev.manifest({merge: true}))
            .pipe(gulp.dest('./'))

});

gulp.task('vendors:compile', ['vendors:copy'], function () {
    return gulp.src([
        './web/assets-vendor/**/*.css',
        './web/assets-vendor/**/*.js',
        './web/assets-vendor/images/**'
    ], {base: './web/assets-vendor'})
            .pipe(rev())
            .pipe(gulpif(/\.less/, less()))
            .pipe(gulpif(/\.(css|js)/, sourcemaps.init()))
            .pipe(gulpif(/\.css/, uglifycss()))
            .pipe(gulpif(/\.js/, uglify()))
            .pipe(gulpif(/\.(css|js)/, sourcemaps.write('.')))
            .pipe(gulp.dest('./web'))
            .pipe(rev.manifest({merge: true}))
            .pipe(through2.obj(function (file, enc, cb) {
                var manifest = JSON.parse(file.contents.toString());
                var newManifest = {};
                for (var i in manifest) {
                    var key = i;
                    if (i.indexOf('assets') !== 0) {
                        key = 'assets-vendor/' + i;
                    }
                    newManifest[key] = manifest[i];

                }
                file.contents = new Buffer(JSON.stringify(newManifest, null, '  '));
                return cb(null, file)
            }))
            .pipe(gulp.dest('./'))
});

gulp.task('assets:copy', function () {
    return gulp.src([
        './web/assets-src/images/**',
        './web/assets-src/landing/images/**',
        './web/assets-src/fonts/**'
    ], {'base': './web/assets-src/'})
            .pipe(rev())
            .pipe(through2.obj(function (file, enc, cb) {
                if (file.revOrigPath) {
                    file.path = file.revOrigPath;
                }
                return cb(null, file)
            }))
            .pipe(gulp.dest('./web'))
            .pipe(rev.manifest({merge: true}))
            .pipe(through2.obj(function (file, enc, cb) {
                var manifest = JSON.parse(file.contents.toString());
                var newManifest = {};
                for (var i in manifest) {
                    var key = i;
                    if (i.indexOf('assets') !== 0) {
                        key = 'assets-src/' + i;
                    }
                    newManifest[key] = manifest[i];
                }
                file.contents = new Buffer(JSON.stringify(newManifest, null, '  '));
                return cb(null, file)
            }))
            .pipe(gulp.dest('./'))

});

gulp.task('assets:compile', ['assets:copy'], function () {
    return gulp.src([
        './web/assets-src/css/**/*.less',
        './web/assets-src/css/**/*.css',
        './web/assets-src/landing/less/**/*.less',
        './web/assets-src/js/**/*.js'
    ], {base: './web/assets-src'})
            .pipe(rev())
            .pipe(gulpif(/\.less/, less()))
            .pipe(replace(/[\\.\/]*(assets-src\/[^\\?#"']+)/g, function (find, replacement) {
                var manifest = JSON.parse(fs.readFileSync('./rev-manifest.json'));
                if (manifest[replacement]) {
                    return '/' + manifest[replacement];
                }
                throw 'Unknown asset path: ' + replacement;
            }))
            .pipe(gulpif(/\.css/, autoprefixer({
                browsers: ['last 2 versions'],
                cascade: false
            })))
            .pipe(gulpif(/\.(css|js)/, sourcemaps.init()))
            .pipe(gulpif(/\.css/, uglifycss()))
            .pipe(gulpif(/\.js/, uglify()))
            .pipe(gulpif(/\.(css|js)/, sourcemaps.write('.')))
            .pipe(gulp.dest('./web'))
            .pipe(rev.manifest({merge: true}))
            .pipe(through2.obj(function (file, enc, cb) {
                var manifest = JSON.parse(file.contents.toString());
                var newManifest = {};
                for (var i in manifest) {
                    var key = i;
                    if (i.indexOf('assets') !== 0) {
                        key = 'assets-src/' + i;
                    }
                    newManifest[key] = manifest[i];
                }
                file.contents = new Buffer(JSON.stringify(newManifest, null, '  '));
                return cb(null, file)
            }))
            .pipe(gulp.dest('./'))
});

gulp.task('clean', function () {
    return gulp.src([
        'web/assets-vendor/*',
        'web/css/*',
        'web/js/*',
        'web/images/*',
        'web/fonts/*',
        'rev-manifest.json'
    ]).pipe(clean());
});

gulp.task('default', ['clean'], function () {
    asyncForeach.forEach(['vendors:compile', 'assets:compile'], function (taskName) {
        var cb = this.async();
        gulp.start(taskName, function () {
            cb();
        })
    });
});

gulp.task('assets:outdated', function () {
    return gulp.src([
        './web/js/**.js',
        './web/css/**.css',
        './web/images/**.*',
        './web/fonts/**.*'
    ], {read: false})
            .pipe(revOutdated(1))
            .pipe(cleaner());
});

gulp.task('watch', function () {
    gulp.watch([
        './web/assets-src/images/**',
        './web/assets-src/landing/images/**'
    ], ['assets:copy']);

    gulp.watch([
        './web/assets-src/css/**/*.less',
        './web/assets-src/landing/less/**/*.less',
        './web/assets-src/css/**/*.css',
        './web/assets-src/js/**/*.js'
    ], ['assets:outdated', 'assets:compile']);
});
