<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'assets/css/plugins/fullcalendar.css',
        'assets/css/plugins/datatables/datatables.css',
        'assets/css/plugins/datatables/bootstrap.datatables.css',
        'assets/css/plugins/chosen.css',
        'assets/css/plugins/jquery.timepicker.css',
        'assets/css/plugins/daterangepicker-bs3.css',
        'assets/css/plugins/colpick.css',
        'assets/css/plugins/dropzone.css',
        'assets/css/plugins/jquery.handsontable.full.css',
        'assets/css/plugins/jscrollpane.css',
        'assets/css/plugins/jquery.pnotify.default.css',
        'assets/css/plugins/jquery.pnotify.default.icons.css',
        'assets/css/app.css',
        'https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css',
        'css/site.css',
        /*'css/login.css',*/
    ];
    public $js = [
        'assets/js/ajax/jquery.min.js',
        'assets/js/ajax/jquery-ui.min.js',
        'assets/js/plugins/jquery.pnotify.js',
        'assets/js/plugins/jquery.sparkline.min.js',
        'assets/js/plugins/mwheelIntent.js',
        'assets/js/plugins/mousewheel.js',
        'assets/js/bootstrap/tab.js',
        'assets/js/bootstrap/dropdown.js',
        'assets/js/bootstrap/tooltip.js',
        'assets/js/bootstrap/collapse.js',
        'assets/js/bootstrap/scrollspy.js',
        'assets/js/plugins/bootstrap-datepicker.js',
        'assets/js/bootstrap/transition.js',
        'assets/js/plugins/jquery.knob.js',
        'assets/js/plugins/jquery.flot.min.js',
        'assets/js/plugins/fullcalendar.js',
        'assets/js/plugins/datatables/datatables.min.js',
        'assets/js/plugins/chosen.jquery.min.js',
        'assets/js/plugins/jquery.timepicker.min.js',
        'assets/js/plugins/daterangepicker.js',
        'assets/js/plugins/colpick.js',
        'assets/js/plugins/moment.min.js',
        'assets/js/plugins/datatables/bootstrap.datatables.js',
        'assets/js/bootstrap/modal.js',
        'assets/js/plugins/raphael-min.js',
        'assets/js/plugins/morris-0.4.3.min.js',
        'assets/js/plugins/justgage.1.0.1.min.js',
        'assets/js/plugins/jquery.maskedinput.min.js',
        'assets/js/plugins/jquery.maskmoney.js',
        'assets/js/plugins/summernote.js',
        'assets/js/plugins/dropzone-amd-module.js',
        'assets/js/plugins/jquery.validate.min.js',
        'assets/js/plugins/jquery.bootstrap.wizard.min.js',
        'assets/js/plugins/jscrollpane.min.js',
        'assets/js/application.js',
        /*'assets/js/template_js/dashboard.js',*/
        /*'js/login.js',*/
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
