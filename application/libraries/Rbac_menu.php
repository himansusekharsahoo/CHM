<?php

class Rbac_menu {

    public function __construct($param) {
        $this->_ci = & get_instance();
        $this->_session = $param['rbac_session'];        
    }

    private $_session;
    private $_ci;
    private $_temp_selected_menu=array();
    private $_selected_menu=array();
    /**
     * @param  : 
     * @desc   :
     * @return :
     * @author : HimansuS
     * @created:
     */
    public function get_user_menus($condition = '') {
        $role_ids = $this->_get_user_role_ids();
        $query = "select * from rbac_menu
            where menu_id in(
                select parent from rbac_menu
                where permission_id in(
                    select permission_id 
                    from rbac_role_permissions rrp
                    WHERE rrp.role_id IN(7)
                    and lower(rrp.status)='active'
                )
            )
            union all
                select * from rbac_menu
                where permission_id in(
                    select permission_id 
                    from rbac_role_permissions rrp
                    WHERE rrp.role_id IN(7)
                    and lower(rrp.status)='active'
                )
             $condition";
        //pma($query,1);
        $result = $this->_ci->db->query($query)->result_array();
        $tree = $this->_populate_tree($result, 'parent', 'menu_id');
        //pma($tree,1);
        $menu = '<ul class="sidebar-menu" data-widget="tree">';
        $menu.=$this->populate_left_menu($tree);
        $menu.='</ul>';
        return $menu;
    }

    /**
     * @param  : array $flat- data array
     * @param  : string $pidKey- parent key column name
     * @param  : string $idKey- primary key column name
     * @desc   : populate tree view form menu array
     * @return : array $tree - tree view array
     * @author : HimansuS
     * @created:
     */
    private function _populate_tree($flat, $pidKey, $idKey = null) {
        $tree = array();
        $grouped = array();
        foreach ($flat as $sub) {
            $grouped[$sub[$pidKey]][] = $sub;
        }        
        $fnBuilder = function($siblings) use (&$fnBuilder, $grouped, $idKey) {
            foreach ($siblings as $k => $sibling) {
                $id = $sibling[$idKey];
                if (isset($grouped[$id])) {
                    $sibling['children'] = $fnBuilder($grouped[$id]);
                }
                $siblings[$k] = $sibling;
            }

            return $siblings;
        };
        $tree = $fnBuilder($grouped[0]);
        return $tree;
    }

    /**
     * @param  : 
     * @desc   : fetch users role ids from session
     * @return : array $role_ids - role ids array
     * @author : HimansuS
     * @created:
     */
    private function _get_user_role_ids() {
        $role_ids = array_column($this->_session['user_data']['roles'], 'role_id');
        return $role_ids;
    }

    /**
     * @param  : 
     * @desc   :
     * @return :
     * @author : HimansuS
     * @created:
     */
    public function populate_left_menu($tree) {
        
        $this->_selected_menu=  $this->_set_selected_menu();
        //pma($this->_selected_menu,1);
        $menu = '';
        foreach ($tree as $tr) {
            $url=($tr['url']!='')?base_url($tr['url']):'#';            
            $tree_view_open=$treeview_menu_open=$menu_select=$display='';            
            
            if ($this->_has_child($tr)) {               
                
                array_push($this->_temp_selected_menu, $tr['menu_id']);
                
                if(in_array($tr['menu_id'], $this->_selected_menu)){
                    $tree_view_open='menu-open';
                    $display='display:block;';
                }
                $menu.='<li class="treeview '.$tree_view_open.'">
                    <a href="#" '.$tr['attribute'].' class="'.$tr['menu_class'].'">
                    <i class="fa '.$tr['icon_class'].'"></i> <span>' . $tr['name'] . '</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>';
                $menu.= '<ul class="treeview-menu" style="'.$display.'">';
                $menu.=$this->populate_left_menu($tr['children']);
                $menu.='</ul>';
            } else {       
                if(in_array($tr['menu_id'], $this->_selected_menu)){
                    $menu_select='active';
                }
                
                //track parent ids
                if(count($this->_temp_selected_menu)>1){
                    array_pop($this->_temp_selected_menu);                    
                }
                $track_menu_ids= implode("_",$this->_temp_selected_menu);                
                
                $menu.='<li class="'.$menu_select.'">
                    <a href="'.$url.'" '.$tr['attribute'].' class="'.$tr['menu_class'].' set_rbac_select_menu" data-rbac_sel_menu="'.$track_menu_ids."_".$tr['parent']."_".$tr['menu_id'].'">
                    <i class="fa '.$tr['icon_class'].'"></i> <span>' . $tr['name'] . '</span>                    
                </a>';
            }
            $menu.='</li>';
            //$this->_selected_menu=array();
        }

        return $menu;
    }

    /**
     * @param  : 
     * @desc   : fetch selected menu ids and set array to make selected on menu panel
     * @return : array
     * @author : HimansuS
     * @created:
     */
    private function _set_selected_menu(){
        $menu_ids=array();    
        //pma($this->_session['user_data'],1);
        if(isset($this->_session['selected_left_menu'])){
            $ids = $this->_session['selected_left_menu'];
            $ids=array_unique($ids);            
            $menu_ids=$ids;
        }
        return $menu_ids;        
    }
    
    /**
     * @param  : 
     * @desc   : used to check chield menu
     * @return : boolean 
     * @author : HimansuS
     * @created:
     */
    private function _has_child($tr) {
        if (array_key_exists('children', $tr) && count($tr['children']) > 0) {
            return true;
        }
        return false;
    }

}