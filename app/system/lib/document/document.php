<?php

class Document {
    const ID_TITLE = '5347524F-4C95-487D-A122-D96214A622F9';
    const ID_META = '7FFD8314-1900-4167-9C40-B18DDB15DC9F';
    const ID_BODY = 'F0084FAC-61C8-4104-BE97-54BF07D66D5C'; 
    const ID_STYLES = 'CF85E179-F0C7-469B-B7D4-8045082A0740';
    const ID_SCRIPTS = '3A5F574D-3FDB-4E1C-8BD0-CF2314904D3D';
    
    const ID_RESERV = '66E9ADD3-AB4C-404F-9EA8-6830E4DD201B';
    
    private $title = 'NO TITLE';
    private $metas = array();
    private $styles = array();
    private $scripts = array();
    private $content = array();
    private $body = array();
    private $std_template;
    
    public function __construct() {
        ob_start();
        include_once __DIR__.DS.'/std_header.html';
        $this->std_template = ob_get_contents();
        ob_end_clean();
        
        //include by default
        $this->metas[] = '<base href="' . BASE_URL . '" />';
        $this->styles[] = '<link rel="stylesheet" href="'.ICLUDE_URL.'/bootstrap-3.3.5/css/bootstrap.min.css">';
        $this->styles[] = '<link rel="stylesheet" href="'.ICLUDE_URL.'/bootstrap-3.3.5/css/bootstrap-theme.min.css">';
        $this->styles[] = '<link rel="stylesheet" href="'.ICLUDE_URL.'/font-awesome-4.7.0/css/font-awesome.min.css">'; 
        $this->styles[] = '<link rel="stylesheet" href="'.ICLUDE_URL.'/dtpicker/bootstrap-datetimepicker.css">';     
         $this->styles[] = '<link rel="stylesheet" href="'.ICLUDE_URL.'/bootstrap-3.3.5/css/bootstrap-select.css">';               
        $this->styles[] = '<link rel="stylesheet" href="'.ICLUDE_URL.'/styles.css">';    
        
        $this->scripts[] = '<script src="'.ICLUDE_URL.'/jquery-3.1.1.min.js"></script>';
        $this->scripts[] = '<script src="'.ICLUDE_URL.'/bootstrap-3.3.5/js/bootstrap.min.js"></script>';
        $this->scripts[] = '<script src="'.ICLUDE_URL.'/dtpicker/moment-with-locales.js"></script>'; 
        $this->scripts[] = '<script src="'.ICLUDE_URL.'/dtpicker/bootstrap-datetimepicker.js"></script>';
        $this->scripts[] = '<script src="'.ICLUDE_URL.'/dtpicker/locales/bootstrap-datetimepicker.ru.js"></script>';        
        $this->scripts[] = '<script src="'.ICLUDE_URL.'/bootstrap-3.3.5/js/bootstrap-select.js"></script>';
        
        $this->scripts[] = '<script src="'.ICLUDE_URL.'/service_scripts.js"></script>';
    }
    
    public function setTitle($title) {
        $this->title = $title;
    }
    
    public function addBody($body) {
        $this->body[] = $body;
    }
    
    public function render() {
        
        
        $output = $this->std_template;        
        $output = str_replace(self::ID_TITLE, $this->title, $output);

        $tmp_buf = '<!-- meta -->'; 
        if($this->metas){ 
            $tmp_buf = '';
            foreach ($this->metas as $meta){
                $tmp_buf .= $meta .PHP_EOL; 
            }
            
            $tmp_buf = trim($tmp_buf);
        }
        $output = str_replace(self::ID_META, $tmp_buf, $output);
        
        $tmp_buf = '<!-- styles -->';
        
        if($this->styles){ 
            $tmp_buf = '';
            foreach ($this->styles as $style){
                $tmp_buf .= $style.PHP_EOL; 
            }
            $tmp_buf = trim($tmp_buf);
        }
        $output = str_replace(self::ID_STYLES, $tmp_buf, $output);
        
        $tmp_buf = '<!-- scripts -->';
        if($this->scripts){ 
            $tmp_buf = '';
            foreach ($this->scripts as $script){
                $tmp_buf .= $script.PHP_EOL; 
            }
            
            $tmp_buf = trim($tmp_buf);                    
        }
        $output = str_replace(self::ID_SCRIPTS, $tmp_buf, $output);
        
        $tmp_buf = '<!-- body -->';
        if($this->body){ 
            $tmp_buf = '';
            foreach ($this->body as $body_chunk){
                $tmp_buf .= $body_chunk.PHP_EOL; 
            }
            
            $tmp_buf = trim($tmp_buf);
        }
        $output = str_replace(self::ID_BODY, $tmp_buf, $output);
                
        return $output;
    }
}
