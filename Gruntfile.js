module.exports = function(grunt) {
    // time
    require('time-grunt')(grunt);

    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),

        compass: {
            options: {
                // If you can't get source maps to work, run the following command in your terminal:
                // $ sass scss/foundation.scss:css/foundation.css --sourcemap
                // (see this link for details: http://thesassway.com/intermediate/using-source-maps-with-sass )
                sourcemap: true,
                omitSourceMapUrl: false,
                cssDir: 'css',
                sassDir: 'scss'
            },
            dist: {
                options: {
                    outputStyle: 'compressed',
                    environment: 'production'
                }
            },
            dev: {
                options: {
                    environment: 'development'
                }
            }
        },

        bless: {
            css: {
                options: {force: true},
                files: {
                    'css/core.css': 'css/core.css',
                    'css/core-NoMQs.css': 'css/core-NoMQs.css'
                }
            }
        },

        copy: {
            'normalize-scss': {
                expand: true,
                cwd: 'node_modules/normalize-scss/sass/',
                src: ['**'],
                dest: 'scss/includes/'
            },
        },

        concat: {
            options: {
                separator: ';',
                sourceMap: true,
            },
            dist: {
                src: [
                    'js/src/*.js'
                ],
                // Finally, concatinate all the files above into one single file
                dest: 'js/theme.min.js',
            },
        },

        uglify: {
            options: {
                sourceMap: true,
                sourceMapIncludeSources: true,
                sourceMapIn: 'js/theme.min.js.map'
            },
            dist: {
                files: {
                    // Shrink the file size by removing spaces
                    'js/ol-wp-theme.min.js': ['js/theme.min.js']
                }
            }
        },

        watch: {
            grunt: { files: ['Gruntfile.js'] },

            compass: {
                files: 'scss/**/*.scss',
                tasks: ['compass']
            },

            js: {
                files: 'js/src/**/*.js',
                tasks: ['concat', 'uglify']
            },

            all: {
                files: '**/*.php'
            },

            tpl: {
                files: '**/*.tpl',
                tasks: []
            }
        }
    });

    grunt.loadNpmTasks('grunt-contrib-compass');
    grunt.loadNpmTasks('grunt-bless');
    grunt.loadNpmTasks('grunt-contrib-watch');
    grunt.loadNpmTasks('grunt-contrib-concat');
    grunt.loadNpmTasks('grunt-contrib-copy');
    grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.loadNpmTasks('grunt-string-replace');

    grunt.registerTask('build', ['copy', 'compass', 'concat', 'uglify']);
    grunt.registerTask('build:css', ['compass']);
    grunt.registerTask('default', ['watch']);
};
