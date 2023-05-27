<!DOCTYPE html>
<html lang="de">
    <head>
        <meta id="csrf-token" content="{{ csrf_token() }}">
        <title>Lavarel</title>
        <script defer src="{{ asset('js/newarticle.js') }}"></script>
        <style>
            #new-article {
                display: flex;
                flex-direction: column;
                max-width: 300px;
            }

            .container {
                display: flex;
                justify-content: flex-start;
                padding-left: 20px;
            }

            label,div {
                margin-bottom: 5px;
            }

            input, textarea{
                padding: 5px;
                margin-bottom: 10px;
                border-radius: 5px;
                border: 1px solid #ccc;
            }

            button {
                padding: 10px 15px;
                background-color: #4CAF50;
                color: white;
                border: none;
                border-radius: 5px;
                cursor:pointer;
            }

            button:hover {
                background-color: #45a049;
            }
        </style>
    </head>
    <body>
        <h1>new article</h1>
        <div class ="container"></div>
        <div class ="message"></div>
    </body>
</html>