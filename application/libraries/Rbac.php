<?php

class Rbac {

    private $_session;
    private $_ci;

    public function __construct() {
        $this->_ci = & get_instance();
        $this->_session = $this->_ci->session->all_userdata();
        //pma($this->_ci->session->all_userdata());
    }

    /**
     * @param  : 
     * @desc   : used to check user is log-in status
     * @return :
     * @author : HimansuS
     * @created:
     */
    public function is_login() {
        if (isset($this->_session['user_data']['user_id'])) {
            return $this->_session['user_data']['user_id'];
        }else{
            redirect('admin-login');
        }        
    }

    /**
     * @param  : 
     * @desc   : use to check logged in user is admin or not
     * @return :
     * @author : HimansuS
     * @created:
     */
    public function is_admin() {
        if ($this->is_login()) {
            if (in_array('ADMIN', $this->_session['user_data']['role_codes'])) {
                return 1;
            }
        }
        return 0;
    }

    /**
     * @param  : 
     * @desc   : used to fetch all assigned role id
     * @return :
     * @author : HimansuS
     * @created:
     */
    public function get_role_ids() {
        if ($this->is_login()) {
            $role_ids = array_column($this->_session['user_data']['roles'], 'role_id');
            return $role_ids;
        }
        return 0;
    }

    /**
     * @param  : 
     * @desc   : used to fetch user_id
     * @return :
     * @author : HimansuS
     * @created:
     */
    public function get_user_id() {
        if (isset($this->_session['user_data']['user_id'])) {
            return $this->_session['user_data']['user_id'];
        }
        return 0;
    }

    /**
     * @param  : String $module_code, String $action_code
     * @desc   : used to check user has permition or not
     * @return :
     * @author : HimansuS
     * @created:
     */
    public function has_permission($module, $action = null) {
        if ($this->is_login()) {

            if ($this->is_admin()) {
                return 1;
            }
            $module = strtoupper($module);
            $action = $action;

            $permissions = $this->_session['user_data']['permissions'];
            $module_codes = $this->_session['user_data']['permission_modules'];
            
            
            if ($module && $action) {
                if (in_array($module, $module_codes)) { 
                    if ($action) {
                        $action_details = $permissions[$module]['actions'];                        
                        if (array_key_exists($action, $action_details) && isset($permissions[$module]['actions'][$action]['action_name'])) {
                            return TRUE;
                        }
                    }
                }
            } else if ($module) {
                if (in_array($module, $module_codes)) {
                    return TRUE;
                }
            }
        }
        return FALSE;
    }

    /**
     * @param  : 
     * @desc   :fetch user full name
     * @return :
     * @author : HimansuS
     * @created:
     */
    public function get_user_name() {
        if (isset($this->_session['user_data']['email'])) {
            return $this->_session['user_data']['email'];
        }
        return '';
    }

    /**
     * @method: get_user_permission() 
     * @param: int $status int $user_id
     * @return:  boolean as per result
     * @desc: Function to enable/disable the user
     */
    public function get_user_permission($user_id = null) {
        if ($this->_session['user_data']['permissions'] || $this->is_admin()) {
            return $this->_session['user_data']['permissions'];
        } else {
            $this->_ci->session->set_flashdata('error', 'No permission assigned you to access the Dashboard,Please contact site Admin.');
            redirect('users/sign_in');
        }
        return 0;
    }

    /**
     * @param  : NA
     * @desc   : generate top menu based on users permission
     * @return : string menu 
     * @author : himansu
     */
    public function show_user_menu_top() {
        $params = array('rbac_session' => $this->_session);
        $this->_ci->load->library('rbac_menu', $params);
        $menu=$this->_ci->rbac_menu->get_user_menus(" AND lower(menu_type)='l'");
        return $menu;
        //return $this->_ci->rbac_menu->show_menu();
    }

    /**
     * @param  : NA
     * @desc   : generate left menu based on users permission
     * @return : string menu 
     * @author : himansu
     */
    public function show_user_menu_left($tree_array_flag = FALSE) {
        if ($this->is_login()) {
            if (isset($this->_session['user_data']['menus'])) {
                $menu_arr = $this->_session['user_data']['menus'];
                $tree = $this->tree_view($menu_arr, 0, TRUE);
                if ($tree_array_flag) {
                    return $tree;
                }
                if ($tree && is_array($tree)) {
                    $menu_str = '<ul class="sidebar-menu" data-widget="tree">';
                    foreach ($tree as $pcode => $menus) {
                        if (isset($menus[$pcode])) {
                            $parent = $menus[$pcode];
                            //unset($menus[$pcode]);
                            if ($parent['menu_header']) {
                                $pmenu = $parent['menu_header'];
                            } else if ($parent['menu_name']) {
                                $pmenu = $parent['menu_name'];
                            } else {
                                $pmenu = $parent['action_name'];
                            }
                            $menu_str.='<li class="treeview">
                                   <a href="#">
                                       <i class="fa ' . $parent['header_class'] . '"></i> <span>' . $pmenu . '</span>
                                       <span class="pull-right-container">
                                           <i class="fa fa-angle-left pull-right"></i>
                                       </span>
                                   </a>';
                            $smenu_flag = 1;
                            $menu_str.='<ul class="treeview-menu">';
                            foreach ($menus as $scode => $menu) {
                                if (isset($menu[$scode])) {
                                    $sparent = $menu[$scode];
                                    if ($sparent['menu_header']) {
                                        $pmenu = $sparent['menu_header'];
                                    } else if ($sparent['menu_name']) {
                                        $pmenu = $sparent['menu_name'];
                                    } else {
                                        $pmenu = $sparent['action_name'];
                                    }
                                    unset($menu[$scode]);
                                    $menu_str.='<li class="treeview"><a href="#"><i class="fa ' . $sparent['header_class'] . '"></i> ' . $pmenu . '
                                                       <span class="pull-right-container">
                                                           <i class="fa fa-angle-left pull-right"></i>
                                                       </span>
                                                   </a>';
                                    //sub-sub menu
                                    $menu_str.='<ul class="treeview-menu">';
                                    foreach ($menu as $sscode => $ssmenu) {
                                        if ($ssmenu['menu_header']) {
                                            $smenu = $ssmenu['menu_header'];
                                        } else if ($parent['menu_name']) {
                                            $smenu = $ssmenu['menu_name'];
                                        } else {
                                            $smenu = $ssmenu['action_name'];
                                        }
                                        $menu_str.='<li><a href="' . base_url($ssmenu['url']) . '"><i class="fa ' . $ssmenu['menu_class'] . '"></i> ' . $smenu . '</a></li>';
                                    }
                                    $menu_str.='</ul>';
                                    $menu_str.='<li>';
                                } else {
                                    if ($menu['menu_header']) {
                                        $smenu = $menu['menu_header'];
                                    } else if ($parent['menu_name']) {
                                        $smenu = $menu['menu_name'];
                                    } else {
                                        $smenu = $menu['action_name'];
                                    }
                                    $menu_str.='<li><a href="' . base_url($menu['url']) . '"><i class="fa ' . $menu['menu_class'] . '"></i> ' . $smenu . '</a></li>';
                                }
                            }
                            $menu_str.='</ul>';
                            $menu_str.='</li>';
                        } else {
                            if ($menus['menu_header']) {
                                $pmenu = $menus['menu_header'];
                            } else if ($menus['menu_name']) {
                                $pmenu = $menu['menu_name'];
                            } else {
                                $pmenu = $menus['action_name'];
                            }
                            $menu_str.='<li>
                                   <a href="' . base_url($menus['url']) . '">
                                       <i class="fa ' . $menus['header_class'] . '"></i> <span>' . $pmenu . '</span>                    
                                   </a>
                               </li>';
                        }
                    }
                    $menu_str.='</ul>';
                    return $menu_str;
                }
            }
        }
        return 1;
    }

    /**
     * @param  : NA
     * @desc   : generate right menu based on users permission
     * @return : string menu 
     * @author : himansu
     */
    public function show_user_menu_right() {
        
    }

    public function tree_view($results, $parent_id, $sub_menu = false) {

        $tree = array();
        $counter = sizeof($results);
        $i = 0;
        foreach ($results as $ky => $rec) {
            if ($rec['parent'] == $parent_id) {
                if ($this->has_child($results, $rec['permission_id'])) {
                    $sub_menu = $this->tree_view($results, $rec['permission_id']);
                    $index = strtoupper($rec['code']) . '_' . $rec['action_id'];
                    $tree[$index] = $sub_menu;
                    $tree[$index][$index] = $rec;
                } else {
                    $index = strtoupper($rec['code']) . '_' . $rec['action_id'];
                    if (count($rec) > 1) {
                        $tree[] = $rec;
                    } else {
                        $tree[$index] = $rec;
                    }
                }
            }
        }
        return $tree;
    }

    public function tree_view2($results, $parent_id, $key_column, $parent_col, $sub_menu = false) {

        $tree = array();
        $counter = sizeof($results);
        $i = 0;
        foreach ($results as $ky => $rec) {
            if ($rec[$parent_col] == $parent_id) {
                if (isset($rec[$key_column]) && !isset($tree[$rec[$key_column]])) {
                    $tree[$rec[$key_column]] = $rec;
                }
                if (isset($rec[$key_column]) && $this->has_child($results, $rec[$key_column], $parent_col)) {
                    $sub_menu = $this->tree_view2($results, $rec[$key_column], $key_column, $parent_col);
                    if ($sub_menu) {
                        $cur_sub_menu = current($sub_menu);
                        if (isset($cur_sub_menu[$parent_col]) && !array_key_exists('children', $tree[$cur_sub_menu[$parent_col]])) {

                            $tree[$cur_sub_menu[$parent_col]]['children'] = array();
                            foreach ($sub_menu as $rec) {
                                $tree[$cur_sub_menu[$parent_col]]['children'][] = $rec;
                            }
                        }
                    }
                }
            }
        }

        return $tree;
    }

    public function has_child($results, $menu_id, $parent_col = 'parent') {
        $counter = sizeof($results);
        for ($i = 0; $i < $counter; $i++) {
            if ($results[$i][$parent_col] == $menu_id) {
                return true;
            }
        }
        return false;
    }

}
