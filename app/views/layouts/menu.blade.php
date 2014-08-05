@if (Session::get('ses_user_tipo') === 'cliente')
<a href="{{ URL::to('/charts/pie') }}" class="list-group-item"><span class="icon pe-7s-graph"></span> Donut/Pie Chart</a>
@endif
<a href="{{ URL::to('/charts/column') }}" class="list-group-item"><span class="icon pe-7s-graph3"></span> Columnbar Chart</a>
<a href="{{ URL::to('/charts/stackbar') }}" class="list-group-item"><span class="icon pe-7s-graph2	"></span> Stackbar Chart</a>
@if (Session::get('ses_user_tipo') === 'empresa')
<a href="{{ URL::to('/charts/breakchart') }}" class="list-group-item"><span class="icon pe-7s-help2"></span> Break Chart</a>
@endif