@extends('layouts.dashboard')

@section('style')
@stop

@section('content')
<div class="page-header">
    <h1 id="timeline">LINEA DE TIEMPO</h1>
</div>
<div id="timeline-scroll">
    <ul id="results" class="timeline"></ul>
</div>
<div class="animation_image" style="display:none;" align="center">
    {{ HTML::image('images/ajax-loader.gif')}}
</div>
@stop

@section('script')
<script type="text/javascript">
    var track_load = 0;
    var loading  = false;
    var total_groups = {{ $total_groups }};
    $('.animation_image').centerToWindow();

    $('#results').load("timeline", {'page':track_load }, function() {
        track_load++;
    });

    $('#timeline-scroll').scroll(function() {
        if(parseInt($('#timeline-scroll').scrollTop()+$('#timeline-scroll').height()) == $('#results').height()) {
            if(track_load <= total_groups && loading==false) {
                loading = true;
                $('.animation_image').show();

                $.post('/timeline',{'group_no': track_load}, function(data) {
                    $("#results").append(data);
                    $('.animation_image').hide();

                    track_load++;
                    loading = false;

                }).fail(function(xhr, ajaxOptions, thrownError) {
                    alert(thrownError);
                    $('.animation_image').hide();
                    loading = false;
                });
            }
        }
    });
</script>
@stop