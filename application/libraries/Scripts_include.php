<?php

/**
 * Description of Script_manage
 *
 * @author Himansu
 */
define('LAYOUT_PATH', '/assets/vendor/');
define('COMPONENT_PATH', '/assets/bower_components/');

class Scripts_include {

    public $jsFile = array('common');
    public $cssFile = array('common');
    private $__jsFiles = array(
        'admin_layout' => array(
            'top' => array(
                COMPONENT_PATH . 'jquery/dist/jquery.min.js',
                COMPONENT_PATH . 'jquery-ui/jquery-ui.min.js',
            ),
            'common' => array(
                COMPONENT_PATH . 'bootstrap/dist/js/bootstrap.min.js',
                COMPONENT_PATH . 'admin-lte/dist/js/adminlte.min.js',
                COMPONENT_PATH . 'bootstrap3-dialog/src/js/bootstrap-dialog.js',
                COMPONENT_PATH . 'downloadjs/download.min.js',
                '/js/messages.js',
                '/js/myapp.js'
            ),
        ),
        'blank_layout' => array(
            'top' => array(
                COMPONENT_PATH . 'jquery/dist/jquery.min.js',
                COMPONENT_PATH . 'jquery-ui/jquery-ui.min.js',
            ),
            'common' => array(
                COMPONENT_PATH . 'bootstrap/dist/js/bootstrap.min.js',
                //'/assets/bootstrap/js/bootstrap-dialog.js',                
                '/js/messages.js',
                '/js/myapp.js'
            ),
        ),
        'default' => array(
            'top' => array(),
            'common' => array()
        )
    );
    private $__appJsFiles = array(
        'rbac' => array('/js/rbac.js'),
        'multiselect' => array('/assets/multiselect/jquery.multiselect.js'),
        'jq_validation' => array(
            COMPONENT_PATH . 'jquery-validation/dist/jquery.validate.min.js',
            COMPONENT_PATH . 'jquery-validation/dist/additional-methods.min.js'
        ),
        'datatable' => array(
            COMPONENT_PATH . 'datatables/media/js/jquery.dataTables.min.js',
            COMPONENT_PATH . 'datatables/media/js/dataTables.bootstrap.min.js',
            COMPONENT_PATH . 'datatables-autofill/js/dataTables.autoFill.js',
            COMPONENT_PATH . 'datatables-colreorder/js/dataTables.colReorder.js',
            COMPONENT_PATH . 'datatables-fixedcolumns/js/dataTables.fixedColumns.js',
            COMPONENT_PATH . 'datatables-keytable/js/dataTables.keyTable.js',
            COMPONENT_PATH . 'datatables-scroller/js/dataTables.scroller.js',
            COMPONENT_PATH . 'dataTables.treeGrid.js/dataTables.treeGrid.js',
        ),
        'chosen' => array('/assets/bootstrap-chosen/chosen.jquery.js'),
        'tree' => array('/js/tree.js'),
        'jstree' => array(COMPONENT_PATH . 'jstree/dist/jstree.min.js'),
        'promise' => array(COMPONENT_PATH . 'bluebird/js/browser/bluebird.min.js'),
        'bs_multiselect' => array('/assets/layout/default/bootstrap/js/bootstrap-multiselect.js'),
        'js_validation' => array('/assets/bower_components/jquery-validation/jquery.validate.js'),
    );
    private $__cssFiles = array(
        'admin_layout' => array(
            'common' => array(
                COMPONENT_PATH . 'bootstrap/dist/css/bootstrap.min.css',
                COMPONENT_PATH . 'font-awesome/css/font-awesome.min.css',
                COMPONENT_PATH . 'Ionicons/css/ionicons.min.css',
                COMPONENT_PATH . 'admin-lte/dist/css/AdminLTE.min.css',
                COMPONENT_PATH . 'admin-lte/dist/css/skins/_all-skins.min.css',
                '/css/wrapper_datatable.css',
                '/css/myapp.css',
            ),
            'bs_datepicker' => array(COMPONENT_PATH . 'bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css'),
            'bs_date_range_picker' => array(COMPONENT_PATH . 'bootstrap-daterangepicker/daterangepicker.css'),
            'bs_wysihtml5' => array(COMPONENT_PATH . 'admin-lte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css'),
        ),
        'blank_layout' => array(
            'common' => array(
                COMPONENT_PATH . 'bootstrap/dist/css/bootstrap.min.css',
                COMPONENT_PATH . 'font-awesome/css/font-awesome.min.css',
                COMPONENT_PATH . 'Ionicons/css/ionicons.min.css',
                COMPONENT_PATH . 'admin-lte/dist/css/AdminLTE.min.css',
                COMPONENT_PATH . 'admin-lte/dist/css/skins/_all-skins.min.css',
                '/css/myapp.css',
            )
        ),
        'default' => array(
            'common' => array()
        )
    );
    private $__appCssFiles = array(
        'multiselect' => array('/assets/multiselect/jquery.multiselect.css'),
        'datatable' => array(
            COMPONENT_PATH . 'datatables/media/css/jquery.dataTables.min.css',
        ),
        'chosen' => array('/assets/bootstrap-chosen/bootstrap-chosen.css'),
        'jstree' => array(COMPONENT_PATH . 'jstree/dist/themes/default/style.min.css')
    );

    function __construct() {
        
    }

    public function includePlugins($plugins = null, $type = null) {
        if (is_array($plugins) && $type == 'css') {
            $this->cssFile = array_merge($this->cssFile, $plugins);
        } elseif (is_array($plugins) && $type == 'js') {
            $this->jsFile = array_merge($this->jsFile, $plugins);
        } else {
            $this->cssFile = array_merge($this->cssFile, $plugins);
            $this->jsFile = array_merge($this->jsFile, $plugins);
        }
    }

    public function includeCss($layout) {
        $str = '';
        if (isset($this->__cssFiles[$layout]) && is_array($this->cssFile)) {
            //merge application plugins with layout css list
            $this->__cssFiles[$layout] = array_merge($this->__cssFiles[$layout], $this->__appCssFiles);
            foreach ($this->cssFile as $pluginName) {
                if (array_key_exists($pluginName, $this->__cssFiles[$layout])) {
                    foreach ($this->__cssFiles[$layout][$pluginName] as $files) {
                        $str .= '<link rel="stylesheet" href="' . base_url($files) . '" />';
                    }
                }
            }
        }
        return $str;
    }

    public function includeJs($layout) {
        $str = '';
        if (isset($this->__jsFiles[$layout]) && is_array($this->jsFile)) {
            //merge application plugins with layout scripts list
            $this->__jsFiles[$layout] = array_merge($this->__jsFiles[$layout], $this->__appJsFiles);
            foreach ($this->jsFile as $key => $pluginName) {
                if (array_key_exists($pluginName, $this->__jsFiles[$layout])) {
                    foreach ($this->__jsFiles[$layout][$pluginName] as $key => $files) {
                        if (is_array($files)) {
                            foreach ($files as $scripts) {
                                $str .= $scripts;
                            }
                        } else {
                            $str .= '<script src="' . base_url($files) . '" ></script>';
                        }
                    }
                }
            }
        }

        return $str;
    }

    public function preJs($layout) {
        $str = '';
        if (isset($this->__jsFiles[$layout]['top'])) {
            foreach ($this->__jsFiles[$layout]['top'] as $files) {
                $str .= '<script src="' . base_url($files) . '" ></script>';
            }
        }
        return $str;
    }

}
