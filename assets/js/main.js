// main.js

require.config({
    paths: {
        jQuery      : 'libs/jquery/jquery',
        Underscore  : 'libs/underscore/underscore',
        Backbone    : 'libs/backbone/backbone'
    }
});

require([
    'app',
    'order!libs/jquery/jquery-1.7.2.min',
    'order!libs/underscore/underscore-min',
    'order!libs/backbone/backbone-min',
    
    ], function(App) {
        console.log('init main');
        console.log(App);

        App.initialize();
    }
);