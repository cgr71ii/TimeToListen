<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Time to Listen</title>
    @include('general-css')
    <style>
      #map {
        height: 400px;
        width: 100%;
       }
    </style>
</head>
<body>

<section class="page-section cta">
        <div class="row">
            <div class="col-xl-9 mx-auto">
                <div class="cta-inner text-center rounded">
                    <div class="container">

                        <h2 class="section-heading mb-0">
                            <span class="section-heading-lower">About Us</span>
                        </h2>

                        <hr>

                        <div id="content">
                            <div id="information">
                                <div style="margin-top:5%; font-size: 20px; text-align: justify">
                                    <p style="text-size: 20px">Time to Listen is a project developed by students of 
                                        the University of Alicante with the aim and main goal of connecting people through the most consumed
                                        product on the Internet, Music.</p>
                                        <p style="text-size: 20px">This revolutionary social media platform will enable you to connect with people, 
                                            become friends, form groups and write publications on your board, and it all revoles around music!</p>
                                </div>

                                <br><hr>
                                <h2 class="section-heading mb-0">
                                    <span class="section-heading-upper">Who we are</span>
                                    <br>
                                </h2>
                                <div class="row">
                                    <div class="col-md-10 offset-md-1">
                                        <p>Mansouri, Kamil</p>
                                        <p>Fernández Hernández, Adrián</p>
                                        <p>Mateiu, Tudor Nicolae</p>
                                        <p>García Romero, Cristian</p>
                                    </div>
                                </div>

                                

                            </div>
                        </div>


                        <hr>
                        <h2 class="section-heading mb-0">
                            <span class="section-heading-upper">Where we are</span>
                            <br>
                        </h2>
                                
                        <div id="map"></div>
                        <script>
                        function initMap() {
                            var uluru = {lat: 38.3846621, lng: -0.5157594};
                            var map = new google.maps.Map(document.getElementById('map'), {
                            zoom: 4,
                            center: uluru
                            });
                            var marker = new google.maps.Marker({
                            position: uluru,
                            map: map
                            });
                        }
                        </script>

                        <script async defer
                            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCAErBajtMD5JKzb7Q7VIP80bkx8_-84Ng&callback=initMap">
                        </script>

                        <br><hr>
                        <div class="row">
                            <div class="col-md-10 offset-md-1">
                                <p><a href="/loginsignup"> Sign up for free </a></p>
                                <a href="{{ action('UserController@show') }}">Home</a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>

</body>
</html>