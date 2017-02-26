<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" 
        integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <link rel="stylesheet" href="{{asset('/css/app.css')}}">
        <link rel="stylesheet" href="{{asset('/css/w3.css')}}">
        <link rel="stylesheet" href="{{asset('/css/my_style.css')}}">
        <link rel="stylesheet" href="{{asset('/css/chosen.css')}}">
         <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.4.2/chosen.css">


        <!-- Styles -->
        <style>
        .img{
    border-right:solid 5px black;}

        html, body {
                /*background-color: #fff;*/
                font-family: 'Raleway', sans-serif;
                font-weight: 670;
                height: 100vh;
                margin: 0;
            }

            #contain{
                     background: url("images/African-Rhythm-7.png") no-repeat center center fixed; 
                -webkit-background-size: cover;
                -moz-background-size: cover;
                -o-background-size: cover;
                background-size: cover;
                overflow:hidden;
                height:100vh;
                margin-bottom:16px;
                /*color: #636b6f;*/

            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
                font-weight:3em;
                color:#fff;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }

            .cat{
                color:#fff;
            }

            
        </style>
        <script src="http://code.jquery.com/jquery-1.8.3.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.4.2/chosen.jquery.js"></script>-->
       <!-- <script src="./js/combox.js"> </script>-->
 <script src="{{asset('/js/app.js')}}"></script>

    </head>
    <body>

        <div class="flex-center position-ref full-height" id="contain">
            @if (Route::has('login'))
           
                <div class="top-right links">
                    <div class = "row">
                    <div class="col-sm-8"></div><!-- dummy col-sm-8-->
                     <a href="#" style="color:white;" onclick="openMail('id02')">Request Quotes</a>
                    <div class="col-sm-2">
                         @include('app_view.shared.search')
                    </div><!-- include(shared.search) col-sm-2-->
                   <div class="col-sm-2">

                   @if (Auth::check())
                    <a href="{{url('/home')}}" style ="color:white">Home</a>
                
                        <a href="{{ url('/logout') }}"
                                            style ="color:white"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                    @else
                        <a href="{{ url('/login') }}" style ="color:white">Login</a>
                    @endif
                    </div><!-- col-sm-1-->
                   
                    </div><!-- row -->
                </div><!-- top-right links -->
                
            @endif

            <div class="content">
                <div class="title m-b-md">
                    eVenting
                </div>

                <div class="">
                    @include('app_view.shared.search_cat_form')
                </div>
            </div>
        </div>
        <div class="container-fluid">
        
           @include('app_view.shared.partial_list_template',['companies'=>$companies])
           @include('app_view.email_view_folders.quotation_form',['states'=>$states,'events'=>$events])
        </div>
         <script src="{{asset('/js/chosen.jquery.js')}}"></script>
         <script src="{{asset('/js/combox.js')}}"></script>
          <script src="{{asset('/js/formstep.js')}}"></script>
        <script>
            /*if('serviceWorker' in navigator){
                navigator.serviceWorker.register('sw.js').then(function(){
                    console.log('Service worker Registered');
                })
            }*/

            $(".chzn-select").chosen();
        </script>

    </body>
</html>
