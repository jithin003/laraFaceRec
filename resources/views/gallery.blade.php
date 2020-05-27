<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <!-- References: https://github.com/fancyapps/fancyBox -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">
        <style>

            /* html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
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
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            } */
            .gallery
            {
                display: inline-block;
                margin-top: 20px;
            }
            .close-icon{
                font-size: 10px;
                position: absolute;
                right: 5px;
                top: -10px;
                padding: 5px 8px;
            }
        </style>
    </head>
    <body>
        <div class="container">


            <h3>Laravel - Face Gallery</h3>
            <form action="{{ url('gallery') }}" class="form-image-upload" method="POST" enctype="multipart/form-data">


                {!! csrf_field() !!}


                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <strong>Whoops!</strong> There were some problems with your input.<br><br>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif


                @if ($message = Session::get('success'))
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                        <strong>{{ $message }}</strong>
                </div>
                @endif
                @if ($message = Session::get('error'))
                <div class="alert alert-danger alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                        <strong>{{ $message }}</strong>
                </div>
                @endif


                <div class="row">
                    <div class="col-md-5">
                        <strong>Image:</strong>
                        <input type="file" name="image" accept="image/x-png,image/jpeg" class="form-control">
                    </div>
                    <div class="col-md-2">
                        <br/>
                        <button type="submit" class="btn btn-success">Upload</button>
                    </div>
                </div>


            </form>


            <div class="row">
            <div class='list-group gallery'>


                    @if($images->count())
                        @foreach($images as $image)
                        <div class='col-sm-4 col-xs-6 col-md-3 col-lg-3'>
                            <a class="thumbnail fancybox" rel="ligthbox" href="/images/{{ $image->image }}">
                                <img class="img-responsive" alt="" src="/images/{{ $image->image }}" />
                                <div class='text-center'>
                                    <small class='text-muted'>{{ $image->image }}</small>
                                </div> <!-- text-center / end -->
                            </a>
                            <form action="{{ url('gallery',$image->id) }}" method="POST">
                            <input type="hidden" name="_method" value="delete">
                            {!! csrf_field() !!}
                            <button type="submit" class="close-icon btn btn-danger"><i class="glyphicon glyphicon-remove"></i></button>
                            </form>
                        </div> <!-- col-6 / end -->
                        @endforeach
                    @endif


                </div> <!-- list-group / end -->
            </div> <!-- row / end -->
        </div> <!-- container / end -->
    </body>
</html>
