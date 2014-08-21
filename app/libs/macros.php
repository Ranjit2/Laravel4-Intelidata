<?php
/*********************************************************************************************
* Example usage (In view)
* <div class="welcome">
{{ Form::open(array('route'=>'process','class'=>'form-horizontal')) }}
{{ Form::textField('first_name') }}
{{ Form::textField('last_name') }}
{{ Form::emailField('email') }}
{{ Form::passwordField('password') }}
{{ Form::selectField('select_one', array('1'=>'abc', '2'=>'def')) }}
{{ Form::selectMultipleField('select_many', array('1'=>'abc', '2'=>'def')) }}
{{ Form::checkboxGroup('enter name', array(
array('name'=>'sal_gt_20k', 'display'=>'GT 20K', 'value'=>'1', 'checked'=>false),
array('name'=>'sal_lt_3k', 'display'=>'Blah', 'value'=>'1', 'checked'=>false)
));
}}
{{ Form::checkboxGroupTable('Languages known Please Check all that apply', 2,4,array(
array('name'=>'lang_c', 'display'=>'C', 'value'=>'1', 'checked'=>false),
array('name'=>'langc_plus', 'display'=>'C++', 'value'=>'1', 'checked'=>false),
array('name'=>'lang_java', 'display'=>'Java', 'value'=>'1', 'checked'=>false),
array('name'=>'lang_php', 'display'=>'PHP', 'value'=>'1', 'checked'=>false),
array('name'=>'lang_sql', 'display'=>'SQL', 'value'=>'1', 'checked'=>false),
));
}}
{{ Form::radioGroup('Sex',array(
array('name'=>'sex', 'display'=>'Male','value'=>'m', 'checked'=>false),
array('name'=>'sex', 'display'=>'Female','value'=>'f', 'checked'=>false)
));
}}
{{ Form::radioGroupTable('Pick an option',2,4,array(
array('name'=>'option', 'display'=>'a','value'=>'a', 'checked'=>false),
array('name'=>'option', 'display'=>'b','value'=>'b', 'checked'=>false),
array('name'=>'option', 'display'=>'c','value'=>'c', 'checked'=>false),
array('name'=>'option', 'display'=>'d','value'=>'d', 'checked'=>false),
array('name'=>'option', 'display'=>'e','value'=>'e', 'checked'=>false),
array('name'=>'option', 'display'=>'f','value'=>'f', 'checked'=>false),
array('name'=>'option', 'display'=>'g','value'=>'g', 'checked'=>false),
));
}}

{{ Form::textareaField('comments') }}
{{ Form::submit('Submit', array('class'=>'col-sm-offset-2 btn btn-primary')) }}
{{ Form::star('rating_field',3) }}

{{ Form::radioScale(array(
'leftAnchor'=>'Extreme',
'rightAnchor'=>'Minimal',
'count'=>6,
'name'=>'radioSlide1',
)) }}

{{ Form::radioScale(array(
'leftAnchor'=>'Minimal',
'rightAnchor'=>'Extreme',
'count'=>6,
'name'=>'radioSlide2',
), 'asc') }}

{{ Form::slider(array(
'leftAnchor'=>'Too little',
'rightAnchor'=>'Too much',
'min'=>0,
'max'=>100,
'name'=>'slider1',
)) }}

{{ Form::progress(5,10) }}

****HTML MACROS ******************
{{ HTML::progress(5,10) }}
{{ HTML::swfobject('filename') }}
</div>
* ********************************************************************************************/
Form::macro ( 'textField', function ($name, $label = null, $value = null, $attributes = array()) {
    $element = Form::text ( $name, $value, fieldAttributes ( $name, $attributes ) );

    return fieldWrapper ( $name, $element, $label );
} );
Form::macro ( 'emailField', function ($name, $label = null, $value = null, $attributes = array()) {
    $element = Form::email ( $name, $value, fieldAttributes ( $name, $attributes ) );

    return fieldWrapper ( $name, $element, $label );
} );
Form::macro ( 'passwordField', function ($name, $label = null, $value = null, $attributes = array()) {
    $element = Form::password ( $name, fieldAttributes ( $name, $attributes ) );

    return fieldWrapper ( $name, $element, $label );
} );

Form::macro ( 'textareaField', function ($name, $label = null, $value = null, $attributes = array()) {
    if (! isset ( $attributes ['rows'] )) {
        $attributes = array_merge ( $attributes, array (
            'rows' => 3
            ) );
    }
    $element = Form::textarea ( $name, $value, fieldAttributes ( $name, $attributes ) );

    return fieldWrapper ( $name, $element, $label );
} );

Form::macro ( 'selectField', function ($name, $options, $label = null, $value = null, $attributes = array()) {
    $options = array('' => 'Select')+$options;
    $element = Form::select ( $name, $options, $value, fieldAttributes ( $name, $attributes ) );
    return fieldWrapper ( $name, $element, $label );
} );

Form::macro ( 'selectMultipleField', function ($name, $options, $label = null, $value = null, $attributes = array()) {
    $attributes = array_merge ( $attributes, array (
        'multiple' => true
        ) );
    $element = Form::select ( $name . '[]', $options, $value, fieldAttributes ( $name, $attributes ) );

    return fieldWrapper ( $name, $element, $label );
} );

// fieldName, text, value, checked, attribs for each entry
// checkboxGroup('enter name', array(
// array(name=>'sal_gt_20k', display=>'GT 20K', value=>'1', checked=>true)
// ));
Form::macro ( 'checkboxGroup', function ($label, $options = array()) {
    $grp = '';
    $class = '';
    $field = '';
    foreach ( $options as $option ) {
        $grp .= checkbox ( $option ['name'], $option ['display'], $option ['value'], $option ['checked'], $option ['attribs'] = array () );
        $grp .= '&nbsp;&nbsp;';
        if (fieldError ( $option ['name'] )) {
            $class = 'has-error';
            $field = $option ['name'];
        }
    }
    return '<div class="' . $class . '">' . fieldWrapper ( $field, $grp, $label ) . '</div>';
} );
// fieldName, text, value, checked, attribs for each entry
// radioGroup('enter name', array(
// array(name=>'sal_gt_20k', display=>'GT 20K', value=>'1', checked=>true)
// ));
Form::macro ( 'radioGroup', function ($label, $options = array()) {
    $grp = '';
    foreach ( $options as $option ) {
        $fieldName = $option ['name'];
        $grp .= radio ( $option ['name'], $option ['display'], $option ['value'], $option ['checked'], $option ['attribs'] = array () );
        $grp .= '&nbsp;&nbsp;';
    }
    return '<div class="' . fieldError ( $fieldName ) . '">' . fieldWrapper ( $fieldName, $grp, $label ) . '</div>';
} );
Form::macro ( 'checkboxGroupTable', function ($label, $rows, $columns, $options = array()) {
    $getData = renderTabular ( $rows, $columns, $options );
    return '<div class="' . $getData->error . '">' . fieldWrapper ( $getData->field, $getData->html, $label ) . '</div>';
} );
Form::macro ( 'radioGroupTable', function ($label, $rows, $columns, $options = array()) {
    $getData = renderTabular ( $rows, $columns, $options, 'radio' );
    return '<div class="' . fieldError ( $getData->field ) . '">' . fieldWrapper ( $getData->field, $getData->html, $label ) . '</div>';
} );
Form::macro ( 'checkboxField', function ($name, $value = 1, $checked = null, $attributes = array()) {
    return checkBox ( $name, $displayName, $value, $checked, $attributes );
} );
Form::macro ( 'radioField', function ($name, $displayName, $value = 1, $checked = null, $attributes = array()) {
    return radio ( $name, $displayName, $value, $checked, $attributes );
} );
/**
* Helper function to handle tabulating radios and checkbox
*
* @param int $rows
*          - number of rows (horizontal) in array
* @param int $columns
*          - number of columns (vertical) in array
* @param array $options
*          - options array entered by the user for this set of radios/checkboxes
* @param string $type
*          - checkbox or radio.. default to checkbox
* @return \stdClass - return an stdclass object with fields error, field and html
*/
if (! function_exists ( 'renderTabular' )) {
    function renderTabular($rows, $cols, $options, $type = "checkbox") {
        $grp = '<table class="table table-condensed">';
        $offset = 0;
        $retObj = new \stdClass ();
        $retObj->error = '';
        $retObj->field = '';
        for($r = 0; $r < $rows; $r ++) {
            $grp .= "<tr>";
            for($c = 0; $c < $cols; $c ++) {
                $offset = $r * $cols + $c;
                if (isset ( $options [$offset] )) {
                    $grp .= "<td>";
                    if ($type == 'checkbox') {
                        $grp .= checkbox ( $options [$offset] ['name'], $options [$offset] ['display'], $options [$offset] ['value'], $options [$offset] ['checked'], $options [$offset] ['attribs'] = array () );
                        if (fieldError ( $options [$offset] ['name'] )) {

                            $retObj->error = 'has-error';
                            $retObj->field = $options [$offset] ['name'];
                        }
                    } else if ($type == 'radio') {
                        $retObj->field = $options [$offset] ['name'];
                        $grp .= radio ( $options [$offset] ['name'], $options [$offset] ['display'], $options [$offset] ['value'], $options [$offset] ['checked'], $options [$offset] ['attribs'] = array () );
                    }
                    $grp .= "</td>";
                } else {
// empty cell to maintain symmetry
                    $grp .= "<td>&nbsp;</td>";
                }
            }
            $grp .= '</tr>';
        }
        $grp .= '</table>';
        $retObj->html = $grp;

        return $retObj;
    }
}
/**
* display a star rating (jquery plugin)
* RATY (http://wbotelhos.com/raty)
* Make sure you include the jquery and raty js files.
* Note that the big png files are stored in js/img path
*/
Form::macro ( 'star', function ($name, $value = '') {
    $markup = '<div class="col-xs-3">';
    $markup .= '<div id="' . $name . '"></div>' . errorMessage ( $name );
// scoreName does not help with storing data between submits.. so use another hidden
    $markup .= Form::hidden ( $name, $value, array (
        'id' => "$name-field"
        ) );
    $markup .= "</div>";
    $markup .= "<script type='text/javascript'>
    $(function() {
        $('#$name').raty({
            score: $('#$name-field').val(),
            path: 'js/img',
            click: function(score, evt) {
                $('#$name-field').val(score);
            },
            cancelOff: 'cancel-off-big.png',
            cancelOn : 'cancel-on-big.png',
            half     : true,
            size     : 24,
            starHalf : 'star-half-big.png',
            starOff  : 'star-off-big.png',
            starOn   : 'star-on-big.png'
        });
});</script>";
return $markup;
} );
/**
* render a linear scale using radio buttons
* the data array must contain the following keys
* leftAnchor : text to be displayed on left
* rightAnchor: text to be displayed on right
* count : the number of radio buttons to be displayed
* name : the name of the control
* The default order is descending.. passing in 'asc' as the second parameter
* displays radios in ascending order
*/
Form::macro ( 'radioScale', function ($data, $value = 0, $order = 'desc') {
    $leftAnchor = $data ['leftAnchor'];
    $rightAnchor = $data ['rightAnchor'];
    $count = $data ['count'];
    $name = $data ['name'];
// generate the scale class='.fieldError($name).
    $str = '<div class="row">
    <div class="col-xs-1"><h4><span class="label label-success">' . $leftAnchor . '</span></h4></div>
    <div class="col-xs-3">';
        if ($order == 'desc') {
            for($index = $count; $index >= 1; $index --) {
                $str .= radio ( $name, $index, $index, $index == $value ? true : false );
            }
        } else if ($order = 'asc') {
            for($index = 1; $index <= $count; $index ++) {
                $str .= radio ( $name, $index, $index, $index == $value ? true : false );
            }
        }
        $str .= '</div>
        <div class="col-xs-1"><h4><span class="label label-success">' . $rightAnchor . '</span></h4></div>
    </div>' . errorMessage ( $name );
    return $str;
} );
/**
* Displays a slider using Jquery ui
* http://jqueryui.com/slider/
* the data array must contain the following keys
* leftAnchor : text to be displayed on left
* rightAnchor: text to be displayed on right
* min : minimum value of slider
* max: maximum value of slider
* name : the name of the control
*/
Form::macro ( 'slider', function ($data, $value = '') {
    $leftAnchor = $data ['leftAnchor'];
    $rightAnchor = $data ['rightAnchor'];
    $min = $data ['min'];
    $max = $data ['max'];
    $name = $data ['name'];
    $sliderid = $name . '-slider';

// generate the slider
    $str = '<div class="row">
    <div class="col-xs-1">' . $leftAnchor . '</div>
    <div class="col-xs-5" id="' . $sliderid . '"></div>
    <div class="col-xs-1">' . $rightAnchor . '</div>';
    $str .= Form::hidden ( $name, $value, array (
        'id' => $name
        ) );

    $str .= '</div>' . errorMessage ( $name );
    $str .= "<script type=\"text/javascript\">$('document').ready(function(){
        \$(\"#$sliderid\").slider({
            animate: true ,
            range: \"min\",
            value: $(\"#$name\").val(),
            min: $min,
            max: $max,
            slide: function(event, ui) {\$(\"#$name\").val(ui.value)}
        });
});
";
$str .= "\$(\"#$sliderid\").css('cursor', 'pointer');";
$str .= "</script>";
return $str;
} );
/**
* Return the html to render an individual radio control
*
* @param string $name
*          - name of the radio
* @param string $displayName
*          - display name of the radio
* @param string $value
*          - value of control if selected
* @param string $checked
*          - is the radio selected?
* @param array $attributes
*          - other attributes (class, id etc)
* @return string - The html rendering of the radio control
*/
if (! function_exists ( 'radio' )) {
    function radio($name, $displayName, $value, $checked = null, $attributes = array()) {
        $out = '';
        $attributes = array_merge ( array (
            'id' => 'id-field-' . $name.'-'.$displayName
            ), $attributes );
        $out .= '<label for="' . 'id-field-' . $name.'-'.$displayName . '" class="radio-inline">';
        $out .= Form::radio ( $name, $value, $checked, $attributes ) . ' ' . $displayName;
        $out .= '</label>';
        return $out;
    }
}
/**
* Return the html to render an individual checkbox control
*
* @param string $name
*          - Name of the checkbox
* @param string $displayName
*          - Display name of the checkbox
* @param string $value
*          - Value if control is checked
* @param string $checked
*          - Is the checkbox checked by default
* @param array $attributes
*          - other attributes (class, id etc)
* @return string - html rendering of the checkbox control. Note that
*         it includes a hidden field. This simplifies form processing when checkbox is unchecked
*/
if (! function_exists ( 'checkBox' )) {
    function checkBox($name, $displayName, $value = 1, $checked = null, $attributes = array()) {
        $out = '';
        $attributes = array_merge ( array (
            'id' => 'id-field-' . $name
            ), $attributes );
        $out .= '<label for="' . 'id-field-' . $name . '" class="checkbox-inline">';
$out .= '<input type="hidden" name="' . $name . '" value="0" />'; // spl handling for checkbox that is not checked // $out .= Form::hidden($name, 0); //note that this does NOT work well!
$out .= Form::checkbox ( $name, $value, $checked, $attributes ) . ' ' . $displayName;
$out .= '</label>';

return $out;
}
}
/**
* Wrap an element with twitter bootstrap 3.0 specific code for proper rendering
*
* @param string $field
*          - field name
* @param string $element
*          - html rendering of internal form element to be output
* @param string $label
*          - label that is displayed to the left
* @return string - formatted html with all divs etc for final display on screen
*/
if (! function_exists ( 'fieldWrapper' )) {
    function fieldWrapper($field, $element, $label = null) {
        $out = '<div class="form-group';
$out .= fieldError ( $field ) . '">'; // set error class
$out .= fieldLabel ( $field, $label ); // gen label
$out .= '<div class="col-sm-7">';
$out .= $element;
$out .= errorMessage ( $field ); // display error message
$out .= '</div>';
$out .= '</div>';

return $out;
}
}
/**
* return formatted error message associated with a field
*
* @param string $field
*          - name of the field to be checked for errors
* @return string - TBS 3.0 formatted span tag that is to be displayed alongside the field
*/
if (! function_exists ( 'errorMessage' )) {
    function errorMessage($field) {
        if ($errors = Session::get ( 'errors' )) {
            return '<span class="label label-danger">' . $errors->first ( $field ) . '</span>';
        }
    }
}
/**
* Return string 'has-error' that can be tagged to element div to signal erroneous entry
*
* @param string $field
*          - the field name
* @return string - 'has-error' in case the field has a validation error
*/
if (! function_exists ( 'fieldError' )) {
    function fieldError($field) {
        $error = '';
        if ($errors = Session::get ( 'errors' )) {
            $error = $errors->first ( $field ) ? ' has-error' : '';
        }
        return $error;
    }
}
/**
* html required for displaying the field label.
* In case an explicit label is not passed,
* generate one
*
* @param unknown $name
*          - field name
* @param unknown $label
*          - label to be used
* @return string - html for the label (TBS 3.0 formatted)
*/
if (! function_exists ( 'fieldLabel' )) {
    function fieldLabel($name, $label) {
        $out = '<label for="' . 'id-field-' . $name . '" class="control-label col-sm-3">';
        if ($label === null) {
// remove _id, [].. replace _ and - with space.
            $out .= ucfirst ( str_replace ( array (
                '_',
                '-'
                ), ' ', str_replace ( array (
                    '_id',
                    '[]'
                    ), '', $name ) ) );
        } else {
            $out .= $label;
        }
        $out .= '</label>';
        return $out;
    }
}
/**
* helper function to add required classes (TBS 3.0) for "text input" fields
*
* @param string $name
*          - field name
* @param array $attributes
*          - control attribs passed by user
* @return array - attributes array merged with TBS specific classes
*/
if (! function_exists ( 'fieldAttributes' )) {
    function fieldAttributes($name, $attributes = array()) {
        return array_merge ( array (
            'class' => 'form-control',
            'id' => 'id-field-' . $name
            ), $attributes );
    }
}

/**
* **************************************************************
* HTML MACROS
* **************************************************************
*/
/**
* Display a progressbar using jquery ui
* http://jqueryui.com/progressbar/
* $current is the current step of the slider
* $total is the total number of steps
*/
HTML::macro ( 'progress', function ($current, $total) {

    $pctValue = number_format ( $current / $total * 100, 0 );
    $str = '';
    $str .= '<div class="row">
    <div class="col-xs-3">
        <div id="progressbar"></div>
    </div>
    <div class="col-xs-2">' . $pctValue . '% Complete</div>
</div>';
$str .= '<script type="text/javascript">
$(function(){';
    $str .= '$("#progressbar").progressbar({
        value: ' . $pctValue;
        $str .= '});';
$str .= '});
</script>';
return $str;
} );
/**
* Generate content required to display swf videos on page
* http://code.google.com/p/swfobject/
* It is assumed that an swf encoded file named $name is in public subdir swf/
*/
HTML::macro ( 'swfobject', function ($name) {
    $swfPath = URL::to("/swf/$name");
    $expressInstallPath = URL::to( "js/expressInstall.swf");
    $version = "9.0.0";

    $headScript = <<<HEADSCRIPT
    <script type="text/javascript">
        var flashvars = {};
        var params = {};
        params.play = "true";
        params.loop = "true";
        params.allowfullscreen = "true";
        var attributes = {};
        swfobject.embedSWF("$swfPath", "myAlternativeContent", "640",
            "480", "$version", "$expressInstallPath",
            flashvars, params, attributes);
</script>
<div id="myAlternativeContent">
    <a href="http://www.adobe.com/go/getflashplayer">
        <img src="http://www.adobe.com/images/shared/download_buttons/get_flash_player.gif"
        alt="Get Adobe Flash player" />
    </a>
</div>
HEADSCRIPT;

return $headScript;
});

HTML::macro('activeState', function($url) {
    return Request::is($url) ? 'active' : '';
});

HTML::macro('tiny_timeline', function($url){
    $a = '<ul class="list-inline months">';
    $c = 0;
    $y = array();
    for ($i = 12; $i > -1; $i--) {
        if(Carbon::now()->subMonths($i)->month == 1){
            $a .= '<li class="divide-line"></li>';
        }
        $a .= '<li><a class="text-uppercase" href="' . $url . '" data-timeline="' . Carbon::now()->subMonths($i)->year . '-' . Carbon::now()->subMonths($i)->month . '-1">';
        $a .= Func::convNumberToMonth(Carbon::now()->subMonths($i)->month);
        $a .= '</a></li>';
        array_push($y, Carbon::now()->subMonths($i)->year);
    }
    $a .= '</ul>';
    $a .= '<ul class="list-inline years">';
    foreach (array_unique($y) as $value) {
        if($c == 0) {
            $a .= '<li class="pull-left"><b>' . $value . '</b></li>';
            $c++;
        } elseif($c == 1) {
            $a .= '<li class="pull-right"><b>' . $value . '</b></li>';
        }
    }
    $a .= '</ul>';

    return $a;
});

HTML::macro('timeline', function($data){
    $a = array('', 'timeline-inverted');
    $b = array('', 'success', 'warning', 'danger', 'info', '');
    $c = array('fa-info', 'fa-usd', 'fa-check');
    $d = '';
    foreach ($data as $value) {
        // INFORMACION AL...
        $d .= '<li class="' . $a[0] . '">';
        $d .= '<div class="timeline-badge ' . $b[2] . '">';
        $d .= '<i class="fa ' . $c[0] . '"></i></div>';
        $d .= '<div class="timeline-panel"><div class="timeline-heading">';
        $d .= '<h4 class="timeline-title">INFORMACI&Oacute;N AL</h4>';
        $d .= '<p><small class="text-muted"><i class="fa fa-clock-o"></i> ' . Carbon::createFromTimeStamp(strtotime($value->informacion_al)) . '</small></p>';
        $d .= '</div><div class="timeline-body"><a href="#" class="btn btn-sm btn-primary pull-right">Ver más</a></div></div></li>';
        // FIN FACTURACIÓN
        $d .= '<li class="' . $a[1] . '">';
        $d .= '<div class="timeline-badge ' . $b[1] . '">';
        $d .= '<i class="fa ' . $c[2] . '"></i></div>';
        $d .= '<div class="timeline-panel"><div class="timeline-heading">';
        $d .= '<h4 class="timeline-title">FIN FACTURACI&Oacute;N</h4>';
        $d .= '<p><small class="text-muted"><i class="fa fa-clock-o"></i> ' . Carbon::createFromTimeStamp(strtotime($value->fin_fac)) . '</small></p>';
        $d .= '</div><div class="timeline-body"><a href="#" class="btn btn-sm btn-primary pull-right">Ver más</a></div></div></li>';
        // INICIO FACTURACIÓN
        $d .= '<li class="' . $a[0] . '">';
        $d .= '<div class="timeline-badge ' . $b[3] . '">';
        $d .= '<i class="fa ' . $c[1] . '"></i></div>';
        $d .= '<div class="timeline-panel"><div class="timeline-heading">';
        $d .= '<h4 class="timeline-title">INICIO FACTURACI&Oacute;N</h4>';
        $d .= '<p><small class="text-muted"><i class="fa fa-clock-o"></i> ' . Carbon::createFromTimeStamp(strtotime($value->inicio_fac)) . '</small></p>';
        $d .= '</div><div class="timeline-body"><a href="#" class="btn btn-sm btn-primary pull-right">Ver más</a></div></div></li>';
        echo $d;
    }
    unset($d);
});

HTML::macro('respondida', function($id_p, $id_r) {
    if(Respuesta::esCorrecta($id_p, $id_r)) {
        echo "checked";
    }
});