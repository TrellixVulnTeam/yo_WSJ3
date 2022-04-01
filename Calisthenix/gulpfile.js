
const { src,dest, watch, parallel } = require("gulp");
const webp = require("gulp-webp");
function versionWebp( done ){
    const opciones = {
        quality : 50
    };
    src("front/static/assets/img/**/*.{png,jpg}")
    .pipe(webp(opciones))
    .pipe(dest("front/static/assets/img/build/img"))

    done();
}

exports.dev =  parallel(versionWebp);