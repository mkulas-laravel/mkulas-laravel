@extends('layouts.default')


@section('navbar')
    <li><a href="/">Hlavná stránka</a></li>
@endsection


@section('content')

    @if($posts !== 'Error code SD100 . Please contact support.')
        @foreach($posts as $post)

            <div class="card text-center">
                <div class="card-header">
                    @if(!isset($dayname))
                        <h5>Dňa: </span>{{\Carbon\Carbon::parse($post->dates)->format('d.m.Y')}} </h5>
                    @else
                        <h5>Dnes je: <span>{{$dayname ?? ''}},</span>{{\Carbon\Carbon::parse($post->dates)->format('d.m.Y')}} </h5>
                    @endif
                </div>
                <div class="card-body">
                    <h5 class="card-title bold">
                        @if(!isset($dayname))
                            Meniny má
                        @else
                            Kto má dnes meniny ?
                        @endif
                    </h5>
                    <p class="card-header"> {{$post->names}}</p>
                </div>
            </div>
        @endforeach
    @else
        {{$posts}}
    @endif

@endsection


