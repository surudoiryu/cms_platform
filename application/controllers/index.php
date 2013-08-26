<?php
class Index extends CI_Controller {

	public $data, $data_		=	NULL;
	
	function __construct()
	{
		parent::__construct();
		$this->data	=	$this->common_lib->commonData(1);
		$data		=	$this->common_lib->commonData(2);
		$this->data['segment_array']	=	$data['segment_array'];
		$this->data['settings']			=	$this->cms_settings->getLast();
		$this->data['url_segment']		=	$this->common_lib->segment_arrays($this->uri->uri_string());
	}

    function index()
    {
		//////////////Contact Form/////////////////////
		if($this->input->post('sendMail') != ""){
			//form checker nog inbouwen + captcha!//////////////////////////<--------------------------
			if($this->input->post('form_check') == '11'){
				$to 		= 	$this->data['settings']['setting_email'];
				$subject 	= 	'Een email via uw website ' . $_SERVER['HTTP_HOST'];
				$headers 	= 	"From: {$this->data['settings']['setting_email']} \r\n";
				$headers 	.= 	"MIME-Version: 1.0\r\n";
				$headers 	.= 	"Content-Type: text/html; charset=ISO-8859-1\r\n";
				$message	=	"Er is een E-mail verstuurd via uw website: ". $_SERVER['HTTP_HOST'] . "<br/><hr>";
				foreach($this->input->post() as $formField => $formValue){
					$message	.=	"<b>" . $formField . "</b> - " . $formValue . "<br/>";
				}
				mail($to, $subject, $message, $headers);
			}
		}
		///////////////////////////////////////////////////
		
		
        //What words will this page translate?
		$this->data['content']	=	$this->common_lib->getTranslation($this);
		//Send the data to the view.
		$this->data['pages']		=	$this->cms_pages->getAll();
		$this->data['currentPage']	=	$this->cms_pages->getByName($this->data['url_segment']['page']);
		$this->data['currentSubPage']	=	(is_array($this->cms_subpages->getIdByName($this->data['url_segment']['subpage']))) ? $this->cms_subpages->getIdByName($this->data['url_segment']['subpage']) : array('id' =>0);
		$this->data['subpages']		=	(is_array($this->cms_subpages->getByName($this->data['url_segment']['page']))) ? $this->cms_subpages->getByName($this->data['url_segment']['page']) : array('id' => 0);
		$this->data['content']		=	$this->cms_content->getAll($this->data['currentPage']['id'], $this->data['currentSubPage']['id'], 1);
		$this->data['viewer']		=	$this->cms_content->getAll(100, 0, 1);
		$this->data['currentBG']	=	(!empty($this->data['currentPage']['page_background'])) ? $this->data['currentPage']['page_background'] : "bg.jpg";
		$this->parser->parse('templates/'.$this->data['settings']['setting_template']."/template.tpl", 	$this->data);
    }
    
}  