document.addEventListener("DOMContentLoaded", function() {

    /* eslint-disable */
    acf.add_filter('color_picker_args', function( args, $field ){
        
        // do something to args
        args.palettes = [
            '#8b1e20', //bf-red
            '#037172', //bf-green
            '#006fba', //hpp-blue
            '#0f8c44', //hpp-red
            '#ffffff', //white
            '#000000' //black
            ]
        
        
        // return
        return args;
                
    });
    /* eslint-enable */
});