<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Sample Vue</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/vue@2.6.12"></script>
        <script src="https://unpkg.com/feather-icons"></script>

        <style>
            input[placeholder] {
            text-align: center;
            }

            .input-code{
                border-radius: 1rem; 
                width:50%; 
                height:60px;
                background-color: #eeeeee;
                border-color: none !important;
                border: none;
                font-size: 30px;
                color: #663399
            }

            .resend-btn{
                border-radius: 1.5rem; border-color: #663399;background-color:#fff; color:#663399; width:15%; height: 50px
            }

            .verify-btn{
                border-radius: 1.5rem; background-color:#663399; color:#fff; width:15%; height: 50px
            }
        </style>
    </head>
    <body>
        @include('login.signup')
    </body>
</html>
