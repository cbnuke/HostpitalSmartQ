<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*
  | -------------------------------------------------------------------
  | CONFIGURATION THEME ENGINE
  | -------------------------------------------------------------------
  | This file is configuration of theme engine
  |
  | Must be setting file path CSS or JS for call by theme engine.
  | Path is relation with Asset Helper. Do not use full path.
  | Can be set multiple file in same config name. But theme engine will
  | load file by config order.
  |
  | -------------------------------------------------------------------
  | Example config
  | -------------------------------------------------------------------
  |
  | Example config for Bootstrap3 is exam for real choose one location.
  |
  | $config['bootstrap3'] = array(
  |     'css' => array(
  |        'bootstrap.css' => 'header',
  |        'bootstrap.min.css' => 'footer'),
  |    'js' => array(
  |        'bootstrap.js'=> 'header',
  |        'bootstrap.min.js' => 'footer'
  |   ));
  |
 */

/*
  |--------------------------------------------------------------------------
  | Configuration Framework
  |--------------------------------------------------------------------------
 */
$config['bootstrap3'] = array(
    'css' => array(
        'bootstrap.min.css' => 'header'),
    'js' => array(
        'bootstrap.min.js' => 'header',)
);

$config['AdminLTE'] = array(
    'css' => array(
        'AdminLTE.min.css' => 'header',
        'AdminLTE_all-skins.min.css' => 'header'),
    'js' => array(
        'app.js' => 'header',
        'demo.js' => 'header',)
);

$config['jquery2'] = array(
    'js' => array(
        'jquery-2.2.2.min.js' => 'header',)
);

$config['jquery-ui'] = array(
    'css' => array(
        'jquery-ui.css' => 'header',
        'jquery-ui.theme.css' => 'header'
    ),
    'js' => array(
        'jquery-ui.min.js' => 'header',)
);

$config['jquery-upload'] = array(
    'css' => array(
        'jquery.fileupload-noscript.css' => 'header',
        'jquery.fileupload-ui-noscript.css' => 'header',
        'jquery.fileupload-ui.css' => 'header',
        'jquery.fileupload.css' => 'header'),
    'js' => array(
        'plugins/jQueryFileUpload/jquery.iframe-transport.js' => 'header',
        'plugins/jQueryFileUpload/jquery.fileupload.js' => 'header',
        'plugins/jQueryFileUpload/jquery.fileupload-process.js' => 'header',
        'plugins/jQueryFileUpload/jquery.fileupload-image.js' => 'header',
        'plugins/jQueryFileUpload/jquery.fileupload-validate.js' => 'header',
        'plugins/jQueryFileUpload/jquery.fileupload-ui.js' => 'header',)
);

$config['EasyUI'] = array(
    'css' => array(
        'easyui.css' => 'header'),
    'js' => array(
        'jquery.easyui.min.js' => 'header')
);

/*
  |--------------------------------------------------------------------------
  | Configuration Plugin or Toolkit
  |--------------------------------------------------------------------------
 */

$config['font-awesome'] = array(
    'css' => array(
        'font-awesome.min.css' => 'header')
);

$config['iCheck'] = array(
    'css' => array(
        'plugins/iCheck/all.css' => 'header'),
    'js' => array(
        'plugins/iCheck/icheck.min.js' => 'header')
);

$config['select2'] = array(
    'css' => array(
        'plugins/select2/select2.min.css' => 'header'),
    'js' => array(
        'plugins/select2/select2.full.min.js' => 'header')
);

$config['fullcalendar'] = array(
    'css' => array(
        'plugins/fullcalendar/fullcalendar.min.css' => 'header'),
    'js' => array(
        'plugins/fullcalendar/moment.min.js' => 'header',
        'plugins/fullcalendar/fullcalendar.min.js' => 'header')
);

$config['DataTables'] = array(
    'css' => array(
        'plugins/dataTables.bootstrap.css' => 'header',
        'plugins/datatables/extensions/ColReorder/css/dataTables.colReorder.min.css' => 'header',
        'plugins/datatables/extensions/Responsive/css/dataTables.responsive.css' => 'header'),
    
    'js' => array(
        'plugins/datatables/jquery.dataTables.min.js' => 'header',
        'plugins/datatables/dataTables.bootstrap.min.js' => 'header',
        'plugins/datatables/extensions/ColReorder/js/dataTables.colReorder.min.js' => 'header',
        'plugins/datatables/extensions/Responsive/js/dataTables.responsive.min.js' => 'header')
);

$config['WYSIHTML5-Bootstrap3'] = array(
    'css' => array(
        'plugins/bootstrap3-wysihtml5.min.css' => 'header'),
    'js' => array(
        'plugins/bootstrap3-wysihtml5.all.min.js' => 'header')
);

$config['datepicker'] = array(
    'js' => array(
        'plugins/datepicker/jquery.ui.datepicker.ext.be.js' => 'header',
        'plugins/datepicker/locales/jquery.ui.datepicker-th.js' => 'header',)
);

$config['timepicker'] = array(
    'css' => array(
        'plugins/timepicker/bootstrap-timepicker.min.css' => 'header'),
    'js' => array(
        'plugins/timepicker/bootstrap-timepicker.min.js' => 'header',)
);

$config['jQuery-Form'] = array(
    'js' => array(
        'jquery.form.js' => 'header',)
);

$config['knob'] = array(
    'js' => array(
        'plugins/knob/jquery.knob.js' => 'header',)
);

$config['flot'] = array(
    'js' => array(
        'plugins/flot/jquery.flot.min.js' => 'header',
        'plugins/flot/jquery.flot.resize.min.js' => 'header',
        'plugins/flot/jquery.flot.pie.min.js' => 'header',
        'plugins/flot/jquery.flot.categories.min.js' => 'header',
    )
);


