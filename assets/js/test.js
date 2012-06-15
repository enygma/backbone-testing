// test javascript

// var Game = Backbone.Model.extend({
//     initialize: function() {
//         console.log('woot!');
//     },
//     defaults: {
//         name: 'Default Title',
//         releaseDate: 2012
//     }
// });

// var portal = new Game({name:'Portal 2', releaseDate: 2000});

// var release = portal.get('releaseDate');
// console.log('release date: '+release);

// portal.set({releaseDate:'1999'});
// var release = portal.get('releaseDate');
// console.log('release date: '+release);

// portal.save();

$(function(){ 


    var User = Backbone.Model.extend({
        initialize: function() {
            //console.log('init user!');
            
            this.bind('change:username',function(){
                var username = this.get('username');
                console.log('username changed to "'+username+'"');
            });
        },
        defaults: {
            username : 'test',
            name     : 'Chris Cornutt',
            location : 'Dallas, Tx',
            id: 0
        },
    });

    var newUser = new User();
    //newUser.save();

    var UserCollection = Backbone.Collection.extend({

        url   : '/user/index.json',
        model : User,

        initialize: function() {
            //console.log('init collection');
        },
        comparator: function (user) {
            return user.get('username');
        },
        equals: function(username) {
            return this.filter(function(user) {
                return user.get('username') == username;
            })
        }
    });

    uc = new UserCollection();
    uc.fetch({
        success: function(response) {
            console.log(response);

            var usernames = uc.pluck('username');
            console.log(usernames);
        }
    });

    UserView = Backbone.View.extend({
        tagName: 'div',
        className: 'user',
        initialize: function() {
            _.bindAll(this,'changeName');
            this.model.bind('change:name',this.changeName);
        },
        render: function() {
            console.log('rendering view');

            this.el.innertHTML = this.model.get('name');
        },
        events: {
            'click .name': 'handleClick'
        },
        handleClick: function() {
            console.log('clicked!');
        },
        changeName: function() {
            console.log('change name!');
        }
    });

    MainView = Backbone.View.extend({
        el: $('body'),

        initialize: function() {
            _.bindAll(this,'render','addItem');

            this.counter = 0;
            this.render();
        },
        render: function() {
            $(this.el).append('test');
            $(this.el).append('<button id="add">Add new item</button>');
            $(this.el).append('<ul></ul>');
        },
        events: {
            'click button#add' : 'addItem'
        },
        addItem: function() {
            this.counter++;
            $('ul',this.el).append('<li>test '+this.counter+'</li>');
        }
    });
    var mv = new MainView();


    var myUser = new User();
    myUser.set({username:'testing123'});


    var View = Backbone.View.extend({
        el : $('#container'),

        created : null,

        initialize: function() {
            console.log('init! -- '+this.options.blankOption);
            console.log($(this.el));
            console.log(this.model);

            this.template = $('#user-template'); //.children();
        },
        events      : {
            'click' : 'render',
            'click button#update' : 'updateModel'
        },
        render: function() {
            console.log('rendering!');

            var data = this.model.get('username');

            if (this.created == null) {
                this.created = this.template.clone().find('a').attr('href','foo').text(data).end();
                console.log(this.created);
                this.$el.append(this.created);

                $(this.el).append('<button id="update">Update store</button>');
            } else {
                this.created = this.created.find('a').attr('href','foo').text(data).end();
            }
        },
        updateModel: function() {
            this.model.set({username:'foodles'});
        }
    });
    var v = new View({ model : myUser });

    //sample router....
    var appRouter = Backbone.Router.extend({
        routes: {
            'find/:id' : 'getUser',
            '*actions'  : 'defaultRoute'
        },
        defaultRoute: function(actions) {
            console.log('routed!');
            console.log(actions);
        },
        getUser: function(id) {
            console.log('getting user: '+id);
        }
    });
    var r = new appRouter();
    Backbone.history.start();
});

//console.log(uc.get(0));

//uc.add([{username:'foo'},{username:'zaphod'},{username:'bob'}]);



// console.log(uc.where({username:'bob'}));

// uc.sort();

// console.log('TEST');
// var u = uc.equals('bob');
// console.log(u);

// make a user model and populate it from the service
//var cUser = new User();





