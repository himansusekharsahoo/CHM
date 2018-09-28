<?php

include_once 'Crud_codes.php';

class Crud_controllers extends Crud_codes {

    public function __construct() {
        $this->CI = & get_instance();
        $this->_setting = $this->CI->crud_settings;
    }

    private $CI;
    private $_setting;

    public function generate_controller($table_name, $data_table_flag) {

        $model_name = $this->_setting->_model_detail['name'];
        $controller_name = $this->_setting->_controller_detail['name'];
        $table_name = $this->_setting->_table_name;
        $primary_key = $this->_setting->_table_detail[$table_name]['primary_key'];
        $actions = $this->_setting->_action_list;
        $module_name = ($this->_setting->_module_name) ? $this->_setting->_module_name . CRUD_DS : '';
        $code = '';
        //pma($this->_setting->_table_detail,1);
        foreach ($actions as $action) {
            switch ($action) {
                case 'index':
                    $data['index'] = $this->_index($action, $table_name, $model_name, $module_name, $controller_name, $data_table_flag);
                    break;
                case 'create':
                    $data['create'] = $this->_create($action, $model_name, $controller_name, $table_name, $module_name);
                    break;
                case 'edit':
                    $data['edit'] = $this->_edit($action, $model_name, $controller_name, $table_name, $primary_key, $module_name);
                    break;
                case 'view':
                    $data['view'] = $this->_view($action, $model_name, $primary_key, $module_name, $controller_name);
                    break;
                case 'delete':
                    $data['delete'] = $this->_delete($action, $model_name, $primary_key, $module_name, $controller_name);
                    break;
            }
            if (array_key_exists($action, $data)) {
                $code.=$data[$action]['code'];
                unset($data[$action]['code']);
            }
        }

        $libraries = array('model' => array($model_name), 'library' => array('pagination', 'form_validation'));
        $code = $this->_append_class($controller_name, 'CI_Controller', $code, $libraries, $module_name)->_get_code();

        if ($this->_setting->_module_name) {
            //check modules directory exist, if not create
            $modules_dir = $this->_setting->_module_path;
            if (!is_dir($modules_dir)) {
                $this->_create_dir($modules_dir);
            }

            //check module directory exist, if not create
            $module_dir = $modules_dir . CRUD_DS . $this->_setting->_module_name;
            if (is_dir($modules_dir) && !is_dir($module_dir)) {
                $this->_create_dir($module_dir);
            }

            //check model directory exist inside module, if not create
            $model_dir = $module_dir . CRUD_DS . $this->_setting->_controller_detail['dir'];
            if (is_dir($module_dir) && !is_dir($model_dir)) {
                $this->_create_dir($model_dir);
            }
        }

        $this->_write_code($code, 'c', $this->_setting->_controller_detail);

        return $data;
    }

    private function _index($action, $table_name, $model_name, $module_name, $controller_name, $data_table_flag) {
        $data = array();
        $data['status'] = 'success';
        $data['message'] = 'Controller index method created successfully';

        $code = "
        \$this->breadcrumbs->push('$action','" . CRUD_DS . $module_name . $controller_name . CRUD_DS . $action . "');
        \$this->scripts_include->includePlugins(array('datatable'), 'css');
        \$this->scripts_include->includePlugins(array('datatable'), 'js');
        \$this->layout->navTitle='" . str_replace('_', ' ', ucfirst($model_name)) . " list';
        ";

        if ($data_table_flag) {
            $code.=$this->_setting->get_datatable_controller_code($table_name);
            $code = $this->_reset_code()
                    ->_set_code($code)
                    ->_apend_method('index')
                    ->_get_code();
            //add export functionality
            $code .= PHP_EOL;
            
            $export_code=$this->_setting->get_datatable_controller_export_code($table_name);
            $code .= $this->_reset_code()
                    ->_if("\$this->input->is_ajax_request()")
                    ->_then($export_code)
                    ->_else(
                        "\$this->layout->data=array('status_code'=>'403','message'=>'Request Forbidden.');
                        \$this->layout->render(array('error' => 'general'));"
                    )
                    ->_endif()
                    ->_apend_method('export_grid_data')
                    ->_get_code();
            
            
        } else {
            $code.=$this->_setting->get_pagination_code('c', $model_name, $controller_name);
            $code.="\$data['data']=\$this->" . $model_name . "->get_" . $model_name . "(null,null,\$per_page,\$page);
            \$this->layout->data = \$data;
            \$this->layout->render();";
            $code = $this->_reset_code()
                    ->_set_code($code)
                    ->_apend_method('index', '$page=0')
                    ->_get_code();
        }

        $data['code'] = $code;
        return $data;
    }

    private function _create($action, $model_name, $controller_name, $table_name, $module_name) {

        $code_obj = $this->_reset_code()
                ->_set_code("\$this->breadcrumbs->push('$action','" . CRUD_DS . $module_name . $controller_name . CRUD_DS . $action . "');\n")
                ->_set_code("\$this->layout->navTitle='" . str_replace('_', ' ', ucfirst($model_name)) . " $action';\n\$data=array();")
                ->_if("\$this->input->post()")
                ->_then($this->_form_validation_rules($table_name))
                ->_if("\$this->form_validation->run()")
                ->_then("
                                \$data['data']=\$this->input->post();                        
                                \$result=\$this->" . $model_name . "->save(\$data['data']);
                                "
                )
                ->_if("\$result>=1")
                ->_then("\$this->session->set_flashdata('success', 'Record successfully saved!');")
                ->_then("redirect('" . CRUD_DS . $module_name . $controller_name . "');")
                ->_else("\$this->session->set_flashdata('error', 'Unable to store the data, please conatact site admin!');")
                ->_endif()
                ->_endif()
                ->_endif();

        if ($this->_setting->_table_detail[$table_name]['has_reference']) {

            foreach ($this->_setting->_table_detail['reference_table'] as $ref_table) {
                $table_name = $ref_table['table'];
                $ref_column = $ref_table['column'];
                $primary_key = $this->_setting->_table_detail[$table_name]['primary_key'];
                $code_obj->_set_code("\$data['" . $ref_column . "_list'] = "
                        . "\$this->" . $model_name . ""
                        . "->get_" . $table_name . "_options('$primary_key','$primary_key');");
            }
        }

        //assign data to layout var and render the default view
        $code = "\$this->layout->data = \$data;
               \$this->layout->render();";

        $code_obj->_set_code($code);
        $code = $code_obj->_apend_method($action)->_get_code();

        $data = array();
        $data['status'] = 'success';
        $data['message'] = 'Controller create method created successfully';
        $data['code'] = $code;

        return $data;
    }

    private function _edit($action, $model_name, $controller_name, $table_name, $primary_key, $module_name) {

        $code_obj = $this->_reset_code()
                ->_set_code("\$this->breadcrumbs->push('$action','" . CRUD_DS . $module_name . $controller_name . CRUD_DS . $action . "');\n")
                ->_set_code("\$this->layout->navTitle='" . str_replace('_', ' ', ucfirst($model_name)) . " $action';\$data=array();")
                ->_if("\$this->input->post()")
                ->_then("\$data['data']=\$this->input->post();")
                ->_then($this->_form_validation_rules($table_name))
                ->_if("\$this->form_validation->run()")
                ->_then("\$result=\$this->" . $model_name . "->update(\$data['data']);")
                ->_if("\$result>=1")
                ->_then("\$this->session->set_flashdata('success', 'Record successfully updated!');")
                ->_then("redirect('" . CRUD_DS . $module_name . $controller_name . "');")
                ->_else("\$this->session->set_flashdata('error', 'Unable to store the data, please conatact site admin!');")
                ->_endif()
                ->_endif()
                ->_else("\$$primary_key=c_decode($$primary_key);\n \$result = \$this->" . $model_name . "->get_" . $model_name . "(null, array('$primary_key' => \$$primary_key));")
                ->_if("\$result")
                ->_then("\$result = current(\$result);")
                ->_endif()
                ->_set_code("\$data['data'] = \$result;")
                ->_endif();

        if ($this->_setting->_table_detail[$table_name]['has_reference']) {

            foreach ($this->_setting->_table_detail['reference_table'] as $ref_table) {
                $table_name = $ref_table['table'];
                $ref_column = $ref_table['column'];
                $ref_primary_key = $this->_setting->_table_detail[$table_name]['primary_key'];
                $code_obj->_set_code("\$data['" . $ref_column . "_list'] = "
                        . "\$this->" . $model_name . ""
                        . "->get_" . $table_name . "_options('$ref_primary_key','$ref_primary_key');");
            }
        }

        //assign data to layout var and render the default view
        $code = "\$this->layout->data = \$data;
               \$this->layout->render();";

        $code_obj->_set_code($code);

        $code = $code_obj->_apend_method($action, "\$$primary_key=null")->_get_code();

        $data = array();
        $data['status'] = 'success';
        $data['message'] = 'Controller edit method created successfully';
        $data['code'] = $code;
        return $data;
    }

    private function _view($action, $model_name, $primary_key, $module_name, $controller_name) {

        $code = "\$this->layout->navTitle='" . str_replace('_', ' ', ucfirst($model_name)) . " $action';\$result = \$this->" . $model_name . "->get_" . $model_name . "(null, array('$primary_key' => \$$primary_key),1);";
        $code = $this->_reset_code()
                ->_set_code("\$this->breadcrumbs->push('$action','" . CRUD_DS . $module_name . $controller_name . CRUD_DS . $action . "');\n")
                ->_set_code("\$data=array();")
                ->_if("\$$primary_key")
                ->_then("\$$primary_key=c_decode($$primary_key);\n")
                ->_then($code)
                ->_if("\$result")
                ->_then("\$result = current(\$result);")
                ->_endif()
                ->_set_code("
                     \$data['data'] = \$result;
                     \$this->layout->data = \$data;
                     \$this->layout->render();
                     ")
                ->_endif()
                ->_return("0")
                ->_apend_method($action, "\$$primary_key")
                ->_get_code();

        $data = array();
        $data['status'] = 'success';
        $data['message'] = 'Controller view method created successfully';
        $data['code'] = $code;
        return $data;
    }

    private function _delete($action, $model_name, $primary_key, $module_name, $controller_name) {

        $code = "\$result = \$this->" . $model_name . "->" . $action . "(\$$primary_key);";
        $code = $this->_reset_code()
                ->_if("\$this->input->is_ajax_request()")
                ->_then("\$$primary_key=  \$this->input->post('$primary_key');")
                ->_if("\$$primary_key")
                ->_then("\$$primary_key=c_decode($$primary_key);\n")
                ->_then($code)
                ->_if("\$result")
                ->_then("echo 1;\n exit();")
                ->_else("echo 'Data deletion error !';\n exit();")
                ->_endif()
                ->_endif()
                ->_set_code("echo 'No data found to delete';\n exit();")
                ->_else(
                        "\$this->layout->data=array('status_code'=>'403','message'=>'Request Forbidden.');
                        \$this->layout->render(array('error' => 'general'));"
                )
                ->_endif()
                ->_return("'Invalid request type.'")
                ->_apend_method($action)
                ->_get_code();

        $data = array();
        $data['status'] = 'success';
        $data['message'] = 'Controller delete method created successfully';
        $data['code'] = $code;
        return $data;
    }

    private function _form_validation_rules($table_name) {
        $primary_key = $this->_setting->_table_detail[$table_name]['primary_key'];
        $config = "\$config = array(" . PHP_EOL;
        foreach ($this->_setting->_table_detail[$table_name]['column_names'] as $column) {
            if (!in_array($column, array($primary_key,'status','created','modified','created_by','modified_by'))) {
                $config.="array(
                        'field' => '$column',
                        'label' => '$column',
                        'rules' => 'required'
                    )," . PHP_EOL;
            }
        }
        $config.=");
        \$this->form_validation->set_rules(\$config);
        ";
        return $config;
    }
    
}
