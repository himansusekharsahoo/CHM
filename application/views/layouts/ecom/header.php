<?php ?>
<style>
    .header-navigation .dropdown-menu{
        
    }
    .manage3_menu{
        right: 0px !important;
        left:auto !important;
    }
</style>
<!-- BEGIN TOP BAR -->
<div class="pre-header">
    <div class="container">
        <div class="row">
            <!-- BEGIN TOP BAR LEFT PART -->
            <div class="col-md-6 col-sm-6 additional-shop-info">
                <ul class="list-unstyled list-inline">
                    <li><i class="fa fa-phone"></i><span><?= $this->lang->line('COMPANY_CONTACT_NO') ?></span></li>
                    <li><i class="fa fa-envelope-o"></i><span><?= $this->lang->line('COMPANY_INFO_EMAIL') ?></span></li>
                </ul>
            </div>
            <!-- END TOP BAR LEFT PART -->
            <!-- BEGIN TOP BAR MENU -->
            <div class="col-md-6 col-sm-6 additional-nav">
                <ul class="list-unstyled list-inline pull-right">
                    <?php
                    if($this->rbac->is_login()){
                        echo '<li><a href="'.base_url('user-logout').'">'.$this->lang->line('HEADER_LOGOUT').'</a></li>';
                    }else{
                        echo '<li><a href="'.base_url('user-login').'">'.$this->lang->line('HEADER_LOGIN').'</a></li>';
                        //echo '<li><a href="'.base_url('/users/sign_up').'">'.$this->lang->line('HEADER_REGI').'</a></li>';
                    }?>                   
                    
                </ul>
            </div>
            <!-- END TOP BAR MENU -->
        </div>
    </div>        
</div>
<!-- END TOP BAR -->

<!-- BEGIN HEADER -->
<div class="header">
    <div class="container">
        <a class="site-logo" href="<?= base_url('/') ?>">
            <?= $this->lang->line('COMPANY_NAME') ?>
            <!--<img src="<?= APP_BASE ?>assets/layouts/ecom/theme/assets/corporate/img/logos/logo-corp-red.png" alt="Metronic FrontEnd">-->
        </a>

        <a href="javascript:void(0);" class="mobi-toggler"><i class="fa fa-bars"></i></a>

        <!-- BEGIN NAVIGATION -->
        <div class="header-navigation pull-right font-transform-inherit">
            <ul>    
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" data-target="#" href="javascript:;">
                        Programming
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="portfolio-4.html">PHP</a></li>
                        <li><a href="portfolio-3.html">JAVA</a></li>
                        <li><a href="portfolio-2.html">.Net</a></li>                        
                    </ul>
                </li>
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" data-target="#" href="javascript:;">
                        Database
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="portfolio-4.html">MySQL</a></li>
                        <li><a href="portfolio-3.html">Oralce</a></li>
                        <li><a href="portfolio-2.html">MongoDB</a></li>                        
                    </ul>
                </li>
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown">
                        Multilevel                
                    </a>                
                    <ul class="dropdown-menu">
                        <li class="dropdown">
                            <a href="index.html" class="dropdown-toggle" data-toggle="dropdown" data-target="#" href="javascript:;">
                                Multi level <i class="fa fa-angle-right"></i>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a href="index.html">Second Level Link</a></li>
                                <li><a href="index.html">Second Level Link</a></li>
                                <li><a href="index.html">Second Level Link</a></li>                                
                            </ul>
                        </li>
                    </ul>
                </li>
                <li class="dropdown dropdown-megamenu">
                    <a class="dropdown-toggle" data-toggle="dropdown" data-target="#" href="javascript:;">
                        MVC & CMS
                    </a>
                    <ul class="dropdown-menu manage3_menu">
                        <li>
                            <div class="header-navigation-content">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="col-md-4 header-navigation-col">
                                        <h4>PHP</h4>
                                        <ul>
                                            <li><a href="index.html">Astro Trainers</a></li>
                                            <li><a href="index.html">Basketball Shoes</a></li>
                                            <li><a href="index.html">Boots</a></li>
                                            <li><a href="index.html">Canvas Shoes</a></li>
                                            <li><a href="index.html">Football Boots</a></li>
                                            <li><a href="index.html">Golf Shoes</a></li>
                                            <li><a href="index.html">Hi Tops</a></li>
                                            <li><a href="index.html">Indoor Trainers</a></li>
                                        </ul>
                                    </div>
                                    <div class="col-md-4 header-navigation-col">
                                        <h4>Java</h4>
                                        <ul>
                                            <li><a href="index.html">Base Layer</a></li>
                                            <li><a href="index.html">Character</a></li>
                                            <li><a href="index.html">Chinos</a></li>
                                            <li><a href="index.html">Combats</a></li>
                                            <li><a href="index.html">Cricket Clothing</a></li>
                                            <li><a href="index.html">Fleeces</a></li>
                                            <li><a href="index.html">Gilets</a></li>
                                            <li><a href="index.html">Golf Tops</a></li>
                                        </ul>
                                    </div>
                                    <div class="col-md-4 header-navigation-col">
                                        <h4>.Net</h4>
                                        <ul>
                                            <li><a href="index.html">Belts</a></li>
                                            <li><a href="index.html">Caps</a></li>
                                            <li><a href="index.html">Gloves</a></li>
                                        </ul>

                                        <h4>Clearance</h4>
                                        <ul>
                                            <li><a href="index.html">Jackets</a></li>
                                            <li><a href="index.html">Bottoms</a></li>
                                        </ul>
                                    </div>
                                    </div>
                                         
                                </div>
                            </div>
                        </li>
                    </ul>
                </li>                
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" data-target="#" href="javascript:;">
                        Portfolio 
                    </a>

                    <ul class="dropdown-menu">
                        <li><a href="portfolio-4.html">Portfolio 4</a></li>
                        <li><a href="portfolio-3.html">Portfolio 3</a></li>
                        <li><a href="portfolio-2.html">Portfolio 2</a></li>
                        <li><a href="portfolio-item.html">Portfolio Item</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" data-target="#" href="javascript:;">
                        Blog 
                    </a>

                    <ul class="dropdown-menu">
                        <li><a href="blog.html">Blog Page</a></li>
                        <li><a href="blog-item.html">Blog Item</a></li>
                    </ul>
                </li>

                <!-- BEGIN TOP SEARCH -->
                <li class="menu-search">
                    <span class="sep"></span>
                    <i class="fa fa-search search-btn"></i>
                    <div class="search-box">
                        <form action="#">
                            <div class="input-group">
                                <input type="text" placeholder="Search" class="form-control">
                                <span class="input-group-btn">
                                    <button class="btn btn-primary" type="submit">Search</button>
                                </span>
                            </div>
                        </form>
                    </div> 
                </li>
                <!-- END TOP SEARCH -->
            </ul>
        </div>
        <!-- END NAVIGATION -->
    </div>
</div>
<!-- Header END -->