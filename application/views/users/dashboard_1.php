<div class="row">
    
    <!-- BEGIN SIDEBAR -->
    <div class="sidebar col-md-3 col-sm-3">
        <ul class="list-group margin-bottom-25 sidebar-menu">
            <li class="list-group-item clearfix"><a href="javascript:;"><i class="fa fa-angle-right"></i> Login/Register</a></li>
            <li class="list-group-item clearfix"><a href="javascript:;"><i class="fa fa-angle-right"></i> Restore Password</a></li>
            <li class="list-group-item clearfix"><a href="javascript:;"><i class="fa fa-angle-right"></i> My account</a></li>
            <li class="list-group-item clearfix"><a href="javascript:;"><i class="fa fa-angle-right"></i> Address book</a></li>
            <li class="list-group-item clearfix"><a href="javascript:;"><i class="fa fa-angle-right"></i> Wish list</a></li>
            <li class="list-group-item clearfix"><a href="javascript:;"><i class="fa fa-angle-right"></i> Returns</a></li>
            <li class="list-group-item clearfix"><a href="javascript:;"><i class="fa fa-angle-right"></i> Newsletter</a></li>
        </ul>
    </div>
    <!-- END SIDEBAR -->

    <!-- BEGIN CONTENT -->
    <div class="col-sm-9 no_rpad">
        <div class="col-md-12 no_pad">            
            <div class="content-page">
                <form action="#" class="content-search-view2">
                    <div class="input-group">
                        <input class="form-control" placeholder="Search..." type="text">
                        <span class="input-group-btn">
                            <button type="submit" class="btn btn-primary">Search</button>
                        </span>
                    </div>
                </form>
                <div class="row no_pad">
                    <div class="col-md-4 col-sm-4 items-info">Items 1 to 9 of 10 total</div>
                    <div class="col-md-8 col-sm-8">
                        <ul class="pagination pull-right">
                            <li><a href="javascript:;">«</a></li>
                            <li><a href="javascript:;">1</a></li>
                            <li><span>2</span></li>
                            <li><a href="javascript:;">3</a></li>
                            <li><a href="javascript:;">4</a></li>
                            <li><a href="javascript:;">5</a></li>
                            <li><a href="javascript:;">»</a></li>
                        </ul>
                    </div>
                </div>
                <?php
                for ($i = 1; $i < 4; $i++):
                    ?>
                    <div class="search-result-item gray_border">
                        <div class="row ans-row">
                            <div class="col-sm-11 no_rpad">
                                <h4>
                                    <span>#<?= $i ?>- </span>
                                    <a href="javascript:;">
                                        <span>Metronic - Responsive Admin Dashboard Template Metronic - Responsive Admin Dashboard Template                                        
                                        </span>
                                    </a>
                                </h4>
                            </div>
                            <div class="col-sm-1 no_lpad">
                                <a href="javascript:;"><i class="fa fa-thumbs-o-up"> 12345</a></i>
                                <a href="javascript:;"><i class="fa fa-thumbs-o-down"> 0</i></a>
                            </div>
                        </div>                        
                        <?php
                        for ($j = 1; $j < 3; $j++):?>
                            <div class="row ans-row">                            
                                <div class="col-sm-12">                                    
                                    <span><strong>Ans.#<?= $j?>-</strong> </span>
                                    <span>
                                        <pre><code>&lt;script type='text/javascript'&gt; alert('ok')&lt;/script&gt;
&lt;?php 
function string_syntax_xhtml( $string, $return = false ) {
	$highlight = highlight_string( $string, true );
	$replace   = str_replace(
		array( '&lt;font color="', '&lt;/font&gt;' ),
		array( '&lt;span style="color: ', '&lt;/span&gt;' ),
		$highlight 
	);
	if( $return ) {
		return $replace;
	}
	echo $replace;
	return true;
}

function file_syntax_xhtml( $path, $return = false ) {
	return string_syntax_xhtml( file_get_contents( $path ), $return );
}
?&gt;</code></pre>
                                    </span>
                                </div>
                            </div>
                        <?php endfor; ?> 
                        <p class="pull-right">
                            <button type="submit" class="btn btn-primary cbtn post-your-comment">Post your answer</button>
                        </p> 
                        <br>

                    </div>                   

                <?php endfor; ?>                
                <div class="row">
                    <div class="col-md-4 col-sm-4 items-info">Items 1 to 9 of 10 total</div>
                    <div class="col-md-8 col-sm-8">
                        <ul class="pagination pull-right">
                            <li><a href="javascript:;">«</a></li>
                            <li><a href="javascript:;">1</a></li>
                            <li><span>2</span></li>
                            <li><a href="javascript:;">3</a></li>
                            <li><a href="javascript:;">4</a></li>
                            <li><a href="javascript:;">5</a></li>
                            <li><a href="javascript:;">»</a></li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- END CONTENT -->
</div>