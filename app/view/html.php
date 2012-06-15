<html>
    <head>
        <script src="/assets/js/jquery-1.7.2.min.js"></script>
        <script src="/assets/js/require.js"></script>
        <script src="/assets/js/underscore-min.js"></script>
        <script src="/assets/js/backbone-min.js"></script>


        <script src="/assets/js/test.js"></script>

        <style>
        #container {
            height: 100px;
            width: 100px;
            border: 1px solid #000000;
        }
        </style>
    </head>
    <body>
        <h3>HTML Content:</h3>
        <?php echo $this->content; ?>

        <div id="container"></div>

        <div id="user-template"><a href=""></a></div>

        <hr/>

        Username: <input type="text" name="username" id="username" size="20">
        <button id="find" name="find">Find user</button>
        <br/><br/>
    </body>
</html>