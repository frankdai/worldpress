module.exports = function(grunt) {
	grunt.initConfig({
		uglify:{
			options:{
				preserveComments:false,
			},
			my_target: {
				files: {
					'js/script.min.js':'js/script.js'
				}
			}
		},
		less: {
  			development: {
    			options: {
      				paths: ["less/"]
    			},
    		files: {
      			"style.css": "less/main.less"
    			}
    		}
  		},
  		watch: {
  			less:{
  				files:['less/*.less'],
  				tasks:'less',
  			}
  		}
	});
	 grunt.loadNpmTasks('grunt-contrib-uglify');
	 grunt.loadNpmTasks('grunt-contrib-less');
	 grunt.loadNpmTasks('grunt-contrib-watch');
	 grunt.registerTask('default',['uglify','less']);
}


