const gulp = require("gulp");
// const cleanCSS = require('gulp-clean-css');
// const concat = require('gulp-concat');
const sass = require('gulp-sass');
const fileinclude = require("gulp-file-include");
const imagemin = require("gulp-imagemin");
const browserSync = require('browser-sync').create();
const reload = browserSync.reload;
sass.compiler = require('node-sass');


// 壓縮css
// gulp.task("minicss", function () {
//   return gulp
//     .src("css/*.css") //來源
//     .pipe(cleanCSS({ compatibility: "ie8" }))
//     .pipe(gulp.dest("dest/css")); //目的地
// });
//合併 css
// gulp.task("concat", ["sass"], function () {
//   return gulp
//     .src("css/*.css") //來源
//     .pipe(concat("all.css")) //合併
//     .pipe(cleanCSS({ compatibility: "ie8" })) //壓縮
//     .pipe(gulp.dest("dest/css")); //目的地
// });

//js 搬家
gulp.task('move',function(){
  gulp
    .src('./dev/js/*.js') //來源
    .pipe(gulp.dest('dest/js/')) //目的地
})

// sass 轉譯
gulp.task("sass", function () {
  gulp
    .src(["./dev/sass/*.scss" , "./dev/sass/**/*.scss" ]) //來源
    .pipe(sass().on("error", sass.logError)) //sass轉譯
    .pipe(gulp.dest("./dest/css")); //目的地
});
/* 監聽sass */
gulp.task('sass:watch', function () {
  gulp.watch('./sass/**/*.scss', ['sass']);
});

// html 樣板
gulp.task("fileinclude", ["miniimg"], function () {
  gulp
    .src(["./dev/*.html", "./dev/*.php"])
    .pipe(
      fileinclude({
        prefix: "@@",
        basepath: "@file",
      })
    )
    .pipe(gulp.dest("./dest"));
});

// 壓圖
gulp.task("miniimg", function () {
  gulp.src("./dev/images/**")
  .pipe(imagemin())
  .pipe(gulp.dest("dest/images"));
});

// 同步
gulp.task("default", function () {
  gulp.watch(
    ["./dev/*.html", "./dev/**/*.html", "./dev/*.php", "./dev/**/*.php","./dev/js/*.js"],
    ["fileinclude","move","sass","sass:watch"],
    
  );
});

