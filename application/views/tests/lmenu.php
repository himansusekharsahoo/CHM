<?php

$tree = $this->rbac->show_user_menu_left(TRUE);
pma($tree);
$menu_str='';
if($tree && is_array($tree)){
        $menu_str='<ul class="sidebar-menu" data-widget="tree">';
        foreach ($tree as $pcode => $menus) {    
           if (isset($menus[$pcode])) {                
               $parent=$menus[$pcode];        
               unset($menus[$pcode]);
               if($parent['menu_header']){
                    $pmenu=$parent['menu_header'];
                }else if($parent['menu_name']){
                    $pmenu=$parent['menu_name'];
                }else{
                    $pmenu=$parent['action_name'];
                }   
               $menu_str.='<li class="treeview">
                       <a href="#">
                           <i class="fa '.$parent['header_class'].'"></i> <span>'.$pmenu.'</span>
                           <span class="pull-right-container">
                               <i class="fa fa-angle-left pull-right"></i>
                           </span>
                       </a>';
               $smenu_flag=1;
               $menu_str.='<ul class="treeview-menu">';
               foreach($menus as $scode=>$menu){
                   if (isset($menu[$scode])) { 
                       $sparent=$menu[$scode];
                       if($sparent['menu_header']){
                            $pmenu=$sparent['menu_header'];
                        }else if($sparent['menu_name']){
                            $pmenu=$sparent['menu_name'];
                        }else{
                            $pmenu=$sparent['action_name'];
                        }  
                       unset($menu[$scode]);                
                           $menu_str.='<li class="treeview"><a href="#"><i class="fa '.$sparent['header_class'].'"></i> '.$pmenu.'
                                           <span class="pull-right-container">
                                               <i class="fa fa-angle-left pull-right"></i>
                                           </span>
                                       </a>';
                               //sub-sub menu
                               $menu_str.='<ul class="treeview-menu">';
                               foreach($menu as $sscode=>$ssmenu){                                               
                                   if($ssmenu['menu_header']){
                                        $smenu=$ssmenu['menu_header'];
                                    }else if($parent['menu_name']){
                                        $smenu=$ssmenu['menu_name'];
                                    }else{
                                        $smenu=$ssmenu['action_name'];
                                    }
                                   $menu_str.='<li><a href="'.base_url($ssmenu['url']).'"><i class="fa '.$ssmenu['menu_class'].'"></i> '.$smenu.'</a></li>';
                               }  
                               $menu_str.='</ul>';
                           $menu_str.='<li>';               
                   }else{ 
                        if($menu['menu_header']){
                            $smenu=$menu['menu_header'];
                        }else if($parent['menu_name']){
                            $smenu=$menu['menu_name'];
                        }else{
                            $smenu=$menu['action_name'];
                        }
                       $menu_str.='<li><a href="'.base_url($menu['url']).'"><i class="fa '.$menu['menu_class'].'"></i> '.$smenu.'</a></li>';                
                   }
               }
               $menu_str.='</ul>';
            $menu_str.='</li>';   
           } else {
                if($menus['menu_header']){
                    $pmenu=$menus['menu_header'];
                }else if($menus['menu_name']){
                    $pmenu=$menu['menu_name'];
                }else{
                    $pmenu=$menus['action_name'];
                } 
                $menu_str.='<li>
                       <a href="'.base_url($menus['url']).'">
                           <i class="fa '.$menus['header_class'].'"></i> <span>'.$pmenu.'</span>                    
                       </a>
                   </li>';         
           }
       }
       $menu_str.='</ul>';                    
    }
echo $menu_str;
?>

