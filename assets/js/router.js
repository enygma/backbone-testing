// router.js

define([
    'jQuery',
    'Underscore',
    'Backbone'
    ], function($, _, Backbone) {

        console.log('router init');

        var AppRouter = Backbone.Router.extend({
            routes: {
                'projects' : 'showProjects',
                'users'    : 'showUsers',
                '*action'   : 'defaultAction'
            },
            showProjects : function() {
                console.log('showProjects');
            },
            showUsers : function() {
                console.log('showUsers');
            },
            defaultAction: function(actions) {
                console.log('No route: '+actions);
            }
        });

        var Init = function() {
            console.log('init AppRouter');

            var app_router = new AppRouter;
            Backbone.history.start();
        };

        return { initialize: Init };
    }
);