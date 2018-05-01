@extends('semantic-ui.master')
@section('title')
	Anime List
@stop
@section('css')
	<style type="text/css">
		.card{
			margin: 10px !important;
		}

		.image img{
			object-fit: cover; /* Do not scale the image */
  			object-position: center; /* Center the image within the element */
  			height: 170px !important;
			width: 100% !important;
		}
	</style>
@stop
@section('content')
	<div class="ui container">
		<div class="right menu">
			<form method="GET" class="ui">
			<div class="item">
					<div class="ui labeled input">
					<div class="ui label">
						Sort By
					</div>
					<select class="ui compact selection dropdown" name="sortby" id="sortby">
						<option value="title" {{(Request::get('sortby') == 'title')?'selected':''}}>Judul</option>
						<option value="score" {{(Request::get('sortby') == 'score')?'selected':''}}>Score</option>
					</select>
				</div>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<div class="ui action input">
					{{-- <select class="ui compact selection dropdown">
						<option value="title">Judul</option>
					</select> --}}
					<div class="ui search selection dropdown" id="search">
									<input type="hidden" name="query">
									<input type="text" class="search" tabindex="0">
									<div class="default text">{{(Request::get('query')=='')?'Search':Request::get('query')}}</div>
									<div class="menu" tabindex="-1"></div>
							</div>
							<button class="ui button" type="submit"><i class="search icon"></i>Search</button>
					</div>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<div class="ui toggle checkbox" id="title">
					<label>Japanese Title</label>
					<input tabindex="0" class="hidden" type="checkbox">
				</div>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<div class="ui toggle checkbox" id="image">
					<label>Hidden Image</label>
					<input tabindex="0" class="hidden" type="checkbox">
				</div>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<button class="ui button" onclick="reset()">
					Clear
				</button>
			</div>
			</form>
		</div>
		<?php $counter = 0; ?>
		<div style="display: flex;">
			@foreach($animelist as $anime)
				@if($counter%4 == 0)
					</div>
					<div style="display: flex;">
				@endif
				<div class="ui card">
					<div class="image">
						<div class="ui icon orange button" style="position: absolute;">
							{{$counter+1}}
						</div>
						<img src="{{$anime->picture}}">
					</div>
					<div class="content">
						<a href="/anime/{{$anime->id}}"><div class="header" id="real_title">{{$anime->title}}</div></a>
						<a href="/anime/{{$anime->id}}"><div class="header" id="japanese_title" style="display: none;">{{$anime->japanese_title}}</div></a>
						<div class="description">
							{{substr($anime->synopsis,0,100)}}
						</div>
					</div>
					<div class="ui two bottom attached buttons">
						<div class="ui violet button">
							<i class="star icon"></i>
							{{$anime->score}}
						</div>
						<div class="ui button">
							<i class="play icon"></i>
							{{$anime->type}}
						</div>
					</div>
				</div>
				<?php $counter+=1; ?>
			@endforeach
		</div>
		<div class="ui center aligned segment" style="border:0; box-shadow: none;">
			<div class="ui horizontal pagination menu">
				<a class="item{{($animelist->currentPage() == 1)?' disabled':''}}" href="{{$animelist->url(1)}}"> << </a>
				@if($animelist->lastPage()<10)
					@for($i = 1;$i<=$animelist->lastPage();$i++)
						<a class="item {{ ($animelist->currentPage() == $i) ? ' active' : '' }}"
						   href="{{ $animelist->url($i) }}">
							{{ $i }}
						</a>
					@endfor
				@elseif($animelist->currentPage()<8 )
					@for($i = 1;$i<=10;$i++)
						<a class="item {{ ($animelist->currentPage() == $i) ? ' active' : '' }}"
						   href="{{ $animelist->url($i) }}">
							{{ $i }}
						</a>
					@endfor
				@else
					<a class="item{{($animelist->currentPage() == 1)?' disabled':''}}" href="#"> ... </a>
					@for($i=$animelist->currentPage()-5;$i<=$animelist->currentPage()+5 && $i<$animelist->lastPage();$i++)
						<a class="item {{ ($animelist->currentPage() == $i) ? ' active' : '' }}"
						   href="{{ $animelist->url($i) }}">
							{{ $i }}
						</a>
					@endfor
					<a class="item{{($animelist->currentPage() == 1)?' disabled':''}}" href="#"> ... </a>
				@endif
				<a class="item{{($animelist->lastPage() == 1)?' disabled':''}}" href="{{$animelist->url($animelist->lastPage())}}"> >> </a>
			</div>
		</div>
	</div>
@stop
@section('script')


	$('select.dropdown').dropdown();
	$('div.ui.selection.dropdown').css('border-radius','0');
	$('.ui.checkbox').checkbox();


	$('.ui.checkbox#image')
	.checkbox()
	.first().checkbox({
		onChecked: function() {
			$('div.image').hide();
		},
		onUnchecked: function() {
			$('div.image').show();
		},
		onChange:function(){
			formalize();
		}
	});

	$('.ui.checkbox#title')
	.checkbox()
	.first().checkbox({
		onChecked: function() {
			$('div.content #real_title').hide();
			$('div.content #japanese_title').show();
		},
		onUnchecked: function() {
			$('div.content #real_title').show();
			$('div.content #japanese_title').hide();
		},
		onChange:function(){
			formalize();
		}
	});

	function formalize(){
		for(var i=0;i<$('a.item').size();i++){
			$('a.item')[i].href+='&sortby='+$('#sortby').dropdown('get value')+'&query='+$('#search').dropdown('get value');
		}
	}

	function reset(){
		location.href = 'http://'+window.location.host+'/anime';
	}

	formalize();

	$('#search')
        .dropdown({
            apiSettings: {
                minCharacters   : 1,
                url   : 'http://'+window.location.host+'/api/anime?query={query}',
                beforeSend: function(settings) {
                    settings.urlData = {
                        query: $('#search .search').val()
                    };
                    return settings;
                }
            }
        });

@stop