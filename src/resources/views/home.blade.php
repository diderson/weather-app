<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

        <link href="/css/style.css?v={{date('Ymddssii')}}" rel="stylesheet">

    </head>
    <body>

    <div class="container-fluid" id ="weather_card">
	    <div class="row justify-content-center">
	        <div class="col-12 col-md-4 col-sm-12 col-xs-12">
	            <div class="card p-4">
	            	@if ($weather)
	            		<div class="d-flex">
		                    <h6 class="flex-grow-1">{{$weather->city->name}}</h6>
		                    <h6>{{$weather->last_updated}}</h6>
		                </div>
		                <div class="d-flex flex-column temp mt-5 mb-3">
		                    <h1 class="mb-0 font-weight-bold" id="heading"> {{$weather->temp_c}}° C </h1> <span class="small grey">{{$weather->condition_text}}</span>
		                </div>
		                <div class="d-flex">
		                    <div class="temp-details flex-grow-1">
		                        <p class="my-1"> <img src="https://i.imgur.com/B9kqOzp.png" height="17px"> <span> {{$weather->wind_kph}} kph </span> </p>
		                        <p class="my-1"> <i class="fa fa-tint mr-2" aria-hidden="true"></i> <span> {{$weather->humidity}}% </span> </p>
		                        <p class="my-1"> <img src="https://i.imgur.com/wGSJ8C5.png" height="17px"> <span> {{$weather->wind_mph}} mph </span> </p>
		                    </div>
		                    <div> <img src="https://{{$weather->condition_icon}}" width="80px"> </div>
		                </div>
	            	@else
	                <div class="d-flex">
	                    <h6 class="flex-grow-1">Montreal</h6>
	                    <h6>16:08</h6>
	                </div>
	                <div class="d-flex flex-column temp mt-5 mb-3">
	                    <h1 class="mb-0 font-weight-bold" id="heading"> 13° C </h1> <span class="small grey">Stormy</span>
	                </div>
	                <div class="d-flex">
	                    <div class="temp-details flex-grow-1">
	                        <p class="my-1"> <img src="https://i.imgur.com/B9kqOzp.png" height="17px"> <span> 40 km/h </span> </p>
	                        <p class="my-1"> <i class="fa fa-tint mr-2" aria-hidden="true"></i> <span> 84% </span> </p>
	                        <p class="my-1"> <img src="https://i.imgur.com/wGSJ8C5.png" height="17px"> <span> 0.2h </span> </p>
	                    </div>
	                    <div> <img src="https://i.imgur.com/Qw7npIg.png" width="100px"> </div>
	                </div>
	                @endif
	            </div>
	        </div>
	    </div>
	</div>
	@if ($weather_latest)
	<div class="container-fluid" id ="weather_table">
		<div class="row justify-content-center">
			<div class="col-12 col-md-8 col-sm-12 col-xs-12">
				<table class="table table-dark">
				  <thead>
				    <tr>
				      <th scope="col">Temp</th>
				      <th scope="col">kph</th>
				      <th scope="col">mph </th>
				      <th scope="col">%</th>
				      <th scope="col">comments</th>
				      <th scope="col">Icon</th>
				      <th scope="col">Last Updated</th>
				    </tr>
				  </thead>
				  <tbody>
				  	@foreach($weather_latest as $weather)
				    <tr>
				      <th scope="row">{{$weather->temp_c}}° C </th>
				      <td>{{$weather->wind_kph}}</td>
				      <td>{{$weather->wind_mph}}</td>
				      <td>{{$weather->humidity}}%</td>
				      <td>{{$weather->condition_text}}</td>
				      <td><img src="https://{{$weather->condition_icon}}" width="30px"></td>
				      <td>{{$weather->last_updated}}</td>
				    </tr>
				    @endforeach
				  </tbody>
				</table>
			</div>
		</div>
	</div>
	@endif
    </body>
    <script type="text/javascript">

    	function reloadWeather() {
		 //we are realoding weather in this page every 1minute to get latest data
		 $('#weather_card').load(document.URL +  ' #weather_card');
		 $('#weather_table').load(document.URL +  ' #weather_table');
		}
		setInterval(reloadWeather, 60000);// 2,400,000 40min to reload the weather

    </script>
</html>
