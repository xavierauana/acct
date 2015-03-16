@extends('app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            Testing Video
                            <a class="btn btn-xs btn-success pull-right" href="{{url('videos/create')}}" style="color:white; display:none">Upload new video</a>
                        </h4>

                    </div>
                    <div class="panel-body">
                        <table class="table" role="table">
                            <thead>
                                <th>name</th>
                                <th>play</th>
                            </thead>
                            <tbody>
                                <td>Our Lantau, Our Land.</td>
                                <td>
                                    <button class="btn btn-infor" data-toggle="modal" data-target="#videoModal" data-link="{{asset('assets/videos/Our_Lantau_Our_Land.mp4')}}">play</button>
                                </td>
                                {{--@foreach($videos as $video)--}}
                                    {{--<td>{{$video->name}}</td>--}}
                                    {{--<td>--}}
                                        {{--<button class="btn-sm btn btn-sm" data-toggle="modal" data-target="#videoModal" data-link="{{$video->link}}">play</button>--}}
                                    {{--</td>--}}
                                {{--@endforeach--}}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="videoModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Player</h4>
                </div>
                <div class="modal-body" style="position:relative">
                    <video id="player" width="100%" >
                        <source src="{{asset('assets/videos/Our_Lantau_Our_Land.mp4')}}" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                    <button class="btn btn-primary" id="button-play" onclick="playPause()">Play</button>
                    <button class="btn btn-primary" id="button-play" onclick="videoStop()">Stop</button>
                    <button class="btn btn-primary" id="button-play" onclick="larger(this)">Larger</button>
                </div>
                {{--<div class="modal-footer">--}}
                    {{--<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>--}}
                    {{--<button type="button" class="btn btn-primary">Save changes</button>--}}
                {{--</div>--}}
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        var player = document.getElementById("player");
        var theModal = $("#videoModal");
        var playPauseButton = $("#button-play");

        var playPause = function(){
            if(player.paused)
            {
                player.play();
                playPauseButton.text('Pause')
            }else{
                player.pause();
                playPauseButton.text('Play')
            }
        };

        var videoStop = function(){
            if(!player.paused)
            {
                playPause();
                player.currentTime = 0;
            }
        };
        var larger = function(button){
            var target = $(".modal-dialog");
            if(!target.hasClass('modal-lg'))
            {
                target.addClass('modal-lg');
                $(button).text('Smaller');
            }else{
                target.removeClass('modal-lg');
                $(button).text('Larger');
            }
        };
        theModal.on('hidden.bs.modal', function (e) {
            videoStop();
        })

    </script>
@endsection