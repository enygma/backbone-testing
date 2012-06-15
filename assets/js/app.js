// app.js
define([
    'jQuery',
    'Underscore',
    'Backbone',
    'router'
    ], function($, _, Backbone, Router) {
        console.log('app init');

        var init = function() {
            Router.initialize();
        }

        return { initialize: init };
    }
);