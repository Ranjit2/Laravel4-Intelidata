<style type="text/css">
    /* CSS REQUIRED */
    .state-icon {
        left: -5px;
    }
    .list-group-item-primary {
        color: rgb(255, 255, 255);
        background-color: rgb(66, 139, 202);
    }

    /* DEMO ONLY - REMOVES UNWANTED MARGIN */
    .well .list-group {
        margin-bottom: 0px;
    }

    .border-titulo{
        border-bottom: 3px solid;
    }
</style>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">

<script>

$(document).ready(function(){
    $("#botonRegistrar").click(function(){
        var cantidadPreguntas = $(".pregunta").length;
        var ok = true;
        
        for(cant = 1; cant <= cantidadPreguntas; cant++)
        {
            if( typeof($('input[id='+cant+']:checked').val()) == 'undefined')
            {
                ok = false;
            }
        }
        if(!ok)
        {
            $('#mensaje').html('<p>Por favor responda todas las preguntas</p>');
            return false;
        }
    });
});
</script>

<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-body">
                {{Form::open(array('url' => 'question', 'method' => 'POST'))}}
                <div class="container">
                    <div class="sr-only">{{$cont = 1;}}</div>
                    <div class="row">
                        <div class="col-md-6 pull-right">
                            <h2 class="border-titulo"><strong>DATOS DE CONTACTO</strong></h2>
                        </div>
                    </div>
                    @foreach ($preguntas as $pregunta)
                    <div class="row">
                        <div class="col-md-6 pull-right">
                            <h4 class="pregunta">{{$cont++.'.- '.$pregunta->pregunta}}</h4>
                            <div class="sr-only">{{ $respuestas = Pregunta::find($pregunta->id)->respuestas()->select('respuesta')->get();}}</div>
                            @foreach ($respuestas as $respuesta)
                            <div class="input-group">
                                <span class="input-group-addon beautiful">
                                    <input type="radio" id ="{{$cont-1}}" name="{{$pregunta->id}}" value="{{$respuesta->id}}">
                                </span>
                                <label type="text" class="form-control">{{$respuesta->respuesta}}</label>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endforeach
                    <div class="row">
                        <div style="color:red; font-weight: bold;" class="col-md-6 pull-right" id="mensaje"></div>
                    </div>
                    <br>
                    <button class="btn btn-primary pull-right" id="botonRegistrar">CONTESTAR</button>
                </div>
                {{Form::close()}}
            </div>
        </div>
    </div>
</div>