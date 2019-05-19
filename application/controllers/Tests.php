<?php

class Tests extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $this->load->view('/tests/index');
    }

    public function admin_layout() {
        $this->layout->layout = 'admin_layout';
        $this->layout->layoutsFolder = 'layouts/admin';
        $this->breadcrumbs->push('admin_layout', '/');
        $this->layout->navTitle = 'Navigator title';
        $this->layout->render();
    }

    public function lmenu() {
        $this->layout->layout = 'admin_layout';
        $this->layout->layoutsFolder = 'layouts/admin';
        $this->breadcrumbs->push('admin_layout', '/');
        $this->layout->navTitle = 'Menu Test';
        $this->scripts_include->includePlugins(array('multiselect'), 'js');
        $this->layout->render();
    }

    public function resume_layout() {
        $this->layout->layout = 'resume_layout';
        $this->layout->layoutsFolder = 'layouts/resume';
        $this->breadcrumbs->push('resume_layout', '/');
        $this->layout->navTitle = 'Navigator title';
        $this->layout->render();
    }

    public function ecom_layout() {
        $this->layout->layout = 'ecom_layout';
        $this->layout->layoutsFolder = 'layouts/ecom';
        $this->breadcrumbs->push('ecom_layout', '/');
        $this->layout->navTitle = 'Navigator title';
        $this->layout->render();
    }

    public function admin_layout2() {
        $this->layout->layout = 'admin_layout';
        $this->layout->layoutsFolder = 'layouts/admin';
        $this->breadcrumbs->push('admin_layout', '/');
        $this->layout->navTitle = 'Navigator title';
        $this->layout->render();
    }

    public function datatable_test() {
        $this->scripts_include->includePlugins(array('datatable'), 'js');
        $this->scripts_include->includePlugins(array('datatable'), 'css');

        $this->layout->layout = 'admin_layout';
        $this->layout->layoutsFolder = 'layouts/admin';
        $this->breadcrumbs->push('admin_layout', '/');
        $this->layout->navTitle = 'Datatable test';
        $this->layout->render();
    }

    public function c_decode($str) {
        echo c_decode($str);
    }

    public function bus_chart(){
        $this->layout->layout = 'admin_layout';
        $this->layout->layoutsFolder = 'layouts/admin';
        $this->breadcrumbs->push('admin_layout', '/');
        $this->layout->navTitle = 'Navigator title';
        $this->layout->render();
    }

    public function bus_test() {
        $this->layout->layout = 'admin_layout';
        $this->layout->layoutsFolder = 'layouts/admin';
        $this->breadcrumbs->push('admin_layout', '/');
        $this->layout->navTitle = 'Navigator title';
        $this->layout->render();
    }
    
    public function pdf_generate() {
        ob_start();
        $this->load->library('Pdf');
        $pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
        $pdf->SetTitle('Pdf Example');
        $pdf->SetHeaderMargin(30);
        $pdf->SetTopMargin(20);
        $pdf->setFooterMargin(20);
        $pdf->SetAutoPageBreak(true);
        $pdf->SetAuthor('Author');
        $pdf->AddPage();
        $html = '<h1>HTML Example</h1>
Some special characters: &lt; € &euro; &#8364; &amp; è &egrave; &copy; &gt; \\slash \\\\double-slash \\\\\\triple-slash
<h2>List</h2>
List example:
<ol>
	<li><img src="images/logo_example.png" alt="test alt attribute" width="30" height="30" border="0" /> test image</li>
	<li><b>bold text</b></li>
	<li><i>italic text</i></li>
	<li><u>underlined text</u></li>
	<li><b>b<i>bi<u>biu</u>bi</i>b</b></li>
	<li><a href="http://www.tecnick.com" dir="ltr">link to http://www.tecnick.com</a></li>
	<li>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.<br />Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt.</li>
	<li>SUBLIST
		<ol>
			<li>row one
				<ul>
					<li>sublist</li>
				</ul>
			</li>
			<li>row two</li>
		</ol>
	</li>
	<li><b>T</b>E<i>S</i><u>T</u> <del>line through</del></li>
	<li><font size="+3">font + 3</font></li>
	<li><small>small text</small> normal <small>small text</small> normal <sub>subscript</sub> normal <sup>superscript</sup> normal</li>
</ol>
<dl>
	<dt>Coffee</dt>
	<dd>Black hot drink</dd>
	<dt>Milk</dt>
	<dd>White cold drink</dd>
</dl>
<div style="text-align:center">IMAGES<br />

</div>';

// output the HTML content
$pdf->writeHTML($html, true, false, true, false, '');
$pdf->Output('example_006.pdf', 'I');
    }
    
    public function qrcode_test(){
        $this->layout->layout = 'admin_layout';
        $this->layout->layoutsFolder = 'layouts/admin';        
        $this->layout->navTitle = 'Navigator title';
        
        $this->load->library('chm_qrcode');
        $qrcode_details=  $this->chm_qrcode->generate_qrcode('Himansu Sekhar Sahoo');
       //pma($qrcode_details,1);
        $data=array(
            'qrcode'=>$qrcode_details
        );
        include APPPATH . 'libraries/Chm_barcode.php';
        $config=array(
            'text'=>"LIB2019022200003"
        );
        $barcode=new Chm_barcode();
        $data['barcode']=$barcode->generate_barcode($config);
        $this->layout->data=$data;
        $this->layout->render();
    }
    
    public function drag_drop_list(){
         $this->layout->layout = 'admin_layout';
        $this->layout->layoutsFolder = 'layouts/admin';
        $this->breadcrumbs->push('admin_layout', '/');
        $this->layout->navTitle = 'Navigator title';
        $this->layout->render();
    }
    
    public function lcard(){
        $this->layout->layout = 'admin_layout';
        $this->layout->layoutsFolder = 'layouts/admin';
        $this->breadcrumbs->push('admin_layout', '/');
        $this->layout->navTitle = 'Navigator title';
        $this->layout->render();
    }
}
