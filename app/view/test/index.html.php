<html>
    <head>
        <title>grid testing</title>
        <script src="/assets/js/libs/jquery/jquery-1.7.2.min.js" type="text/javascript"></script>
        <script src="/assets/js/libs/underscore/underscore-min.js" type="text/javascript"></script>
        <script src="/assets/js/libs/backbone/backbone-min.js" type="text/javascript"></script>

        <style>
        td { border: 1px solid #000000; }
        th { border: 1px solid #000000; }
        </style>

        <script type="text/javascript">

        var GridRowModel = Backbone.Model.extend({
            // nothing to see move along
        });

        var GridDataCollection = Backbone.Collection.extend({

            sortDirection: 'ASC',
            sortField    : '',

            // nothing to see, move along
            comparator: function(data) {
                //console.log(data);
                console.log(this.sortDirection);
                
                if (this.sortDirection == 'ASC') {
                    return data.get('test');
                } else {
                    return -data.get('test');
                }
            }
        });

        var gridDataConnection = new GridDataCollection({
            model:GridRowModel
        });

        // make our grid view
        var GridView = Backbone.View.extend({

            defaults: {
                properties: [
                    {title: 'Data Grid'}
                ],
                title   : 'Data Grid',
                columns : [],
                data    : []
            },

            events: {
                'click .header .colHeaderLink' : 'headerClick'
            },

            headerClick: function(evt) {
                evt.preventDefault();
                var colIndex = $(evt.currentTarget).attr('name');
                console.log('i:'+colIndex);

                // _.sortBy(this.collection,function(data){
                //     return data.get(colIndex);
                // });
                
                this.collection.sortDirection = 'DESC';
                this.collection.sort();
            },

            properties: [],

            getData: function() {
                return (typeof this.data == 'undefined') 
                    ? defaults.data : this.data;
            },
            getColumns: function() {
                return (typeof this.columns == 'undefined') 
                    ? defaults.columns : this.columns;
            },
            getProperty: function(propName) {
                return (typeof this.properties[propName]) 
                    ? defaults.properties[propName] : this.properties[propName];
            },

            initialize: function() {
                // take the data that's given and push it into a collection of models
                var models = [];
                $.each(this.options.data,function(k,values){
                    console.log(values);
                    models.push(new GridRowModel(values));
                });

                this.collection = new GridDataCollection(models);
            },
            render: function() {

                // for each item in the collection, render the row according to the template
                var cells = [];

                this.template = _.template($('#grid_table').html());

                this.$el.append(this.template({
                    headers: this.options.columns,
                    rows: this.collection
                }));
            }

        });

        </script>
    </head>
    <body>
        Backbone grid demo

        <div id="container"></div>
        <script>

        $(function(){
            // -------------------------
            var gridData = [
                {
                    test : "foobarbaz"
                },
                {
                    test: 'abc'
                },
                {
                    test: 'zxy'
                },
                {
                    test: 'lmn'
                }
            ];
            var columns = [
                {
                    title: "Test",
                    dataIndex: "test"
                },
                {
                    title: 'Test #1',
                    dataIndex: 'test1'
                }
            ];

            var grid = new GridView({
                el: $('#container'),
                columns: columns,
                data: gridData
            });
            grid.render();
            // -------------------------
        });
        </script>

        <!-- templates -->
        <script type="text/template" id="grid_table">
            <table id="grid">
                <tr>
                    <% 
                    var indexes = [];
                    for(var i=0; i<headers.length; i++){ %>
                        <% 
                            var header = headers[i];
                            indexes.push(header.dataIndex);
                        %>
                        <th class="header">
                            <a href="#" class="colHeaderLink" name="<%= header.dataIndex %>"><%= header.title %></a>
                        </th>
                    <% } %>
                </tr>
                <%
                    rows.each(function(data){ %>
                        <tr>
                        <%  var cellData = data.toJSON(); %>
                        <% $.each(indexes,function(k,index){
                            if (typeof cellData[index] !== 'undefined'){ 
                                %> <td><%= cellData[index] %></td> <%
                            } else {
                                %> <td>&nbsp;</td> <%
                            }
                        }); %>
                        </tr>
                        <%
                    });
                %>
            </table>
        </script>
    </body>
</html>
