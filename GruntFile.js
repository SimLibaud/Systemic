var js_files = [
    'web/public/js/jquery-2.1.1.js',
    'web/public/js/bootstrap.min.js',
    'web/public/js/plugins/metisMenu/jquery.metisMenu.js',
    'web/public/js/plugins/slimscroll/jquery.slimscroll.min.js',
    'web/public/js/inspinia.js',
    'web/public/js/plugins/pace/pace.min.js',
    'web/public/js/tools.js',
];

module.exports = function(grunt){
    grunt.initConfig({

        jshint: {
            all: js_files
        },

        concat: {
            options: {
                separator: ';',
            },
            dist: {
                src: js_files,
                dest: 'web/prod/app.min.js',
            },
        },

        uglify: {
            dist : {
                files: {
                    'web/prod/app.min.js': ['web/prod/app.min.js']
                }
            }
        }

    });
    grunt.loadNpmTasks('grunt-contrib-concat');
    grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.loadNpmTasks('grunt-contrib-jshint');

    grunt.registerTask('default', [/*'jshint',*/ 'concat:dist', 'uglify:dist']);
}
