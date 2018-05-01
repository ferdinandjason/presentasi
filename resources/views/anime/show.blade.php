@extends('semantic-ui.master')
@section('title')
	Anime {{$anime->title}}
@stop

@section('content')
	<div class="ui container">
		<div class="ui two column grid">
			<div class="four wide column">
				<div>
					<div class="ui card">
					  	<div class="image">
					    	<img src="{{$anime->picture}}">
					  	</div>
					  	<div class="content">
					    	<a class="header">{{$anime->title}}</a>
						    <!--<div class="description">
						      	{{substr($anime->synopsis,0,500)}}
						    </div>-->
					  	</div>
						<div class="extra content">
						    <p>
						      	<i class="play icon"></i>
						      	{{$anime->status}}
						    </p>
						    <p>
						    	<i class="calendar icon"></i>
						    	{{$anime->aired}}
						    </p>
						    <p>
						    	<i class="video icon"></i>
						    	{{$anime->episodes}}
						    </p>
						    <p>
						    	<i class="file video outline icon"></i>
						    	{{$anime->type}}
						    </p>
						    <p>
						    	<i class="clock icon"></i>
						    	{{$anime->duration}}
						    </p>
						    <p>
						    	<i class="user icon"></i>
						    	{{$anime->rating}}
						    </p>
						    <p>
						    	<i class="star icon"></i>
						    	{{$anime->score}}
						    </p>
						    <div class="ui slider checkbox" id="hide-trailer">
  								<input type="checkbox">
  								<label>Trailer</label>
							</div>
							<div class="ui slider checkbox" id="hide-synopsis">
  								<input type="checkbox">
  								<label>Synopsis</label>
							</div>
							<div class="ui horizontal divider">Interested?</div>
							<div class="ui center aligned">
								<div class="ui primary button">
    								<i class="plus icon"></i> Add to Wishlist
  								</div>
							</div>
					  	</div>
					</div>
				</div>
			</div>
			<div class="twelve wide column">
				<div class="ui top attached tabular menu">
					<div class="active item">Information</div>
					<div class="item">Episodes</div>
					<div class="item">Reviews</div>
					<div class="item">Recommendations</div>
					<div class="item">Characters and Staff</div>
				</div>
				<div class="ui bottom attached active tab segment">
					<div class="ui raised segment" id="trailer">
						<div class="ui embed" data-source="youtube" data-id="{{substr($anime->trailer,30,11)}}">
						</div>
					</div>
					<div class="column">
						<div class="ui raised segment" id="synopsis">
							<h1>Synopsis</h1>
							<p>{{$anime->synopsis}}</p>
						</div>
					</div>			
				</div>
			</div>
		</div>
	</div>
@stop
@section('script')
	$('#trailer').hide();
	$('#synopsis').hide();
	$('.ui.embed').embed();

	$('.ui.checkbox#hide-trailer')
	.checkbox()
	.first().checkbox({
		onChecked: function() {
			$('#trailer').show();
		},
		onUnchecked: function() {
			$('#trailer').hide();
		}
	});

	$('.ui.checkbox#hide-synopsis')
	.checkbox()
	.first().checkbox({
		onChecked: function() {
			$('#synopsis').show();
		},
		onUnchecked: function() {
			$('#synopsis').hide();
		}
	});
@stop