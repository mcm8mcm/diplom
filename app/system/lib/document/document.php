<?php

class Document {
    const ID_TITLE = '5347524F-4C95-487D-A122-D96214A622F9';
    const ID_META = '7FFD8314-1900-4167-9C40-B18DDB15DC9F';
    const ID_BODY = 'F0084FAC-61C8-4104-BE97-54BF07D66D5C'; 
    const ID_STYLES = 'CF85E179-F0C7-469B-B7D4-8045082A0740';
    const ID_SCRIPTS = '3A5F574D-3FDB-4E1C-8BD0-CF2314904D3D';
    
    const ID_RESERV = '66E9ADD3-AB4C-404F-9EA8-6830E4DD201B';
    
    private $regestry;
    private $title = 'NO TITLE';
    private $metas = array();
    private $styles = array();
    private $scripts = array();
    private $content = array();
    private $body = array();
    private $std_template;
    
    public function __construct($registry) {
        $this->regestry = $registry;
        ob_start();
        include_once __DIR__.DS.'/std_header.html';
        $this->std_template = ob_get_contents();
        ob_end_clean();
    }
    
    public function setTitle($title) {
        $this->title = $title;
    }
    
    public function addBody($body) {
        $this->body[] = $body;
    }
    
    public function render() {
        $output = $this->std_template;
        $tmp_buf = '';        
        $output = str_replace(self::ID_TITLE, $this->title, $output);

        if($this->metas){ 
            foreach ($this->metas as $meta){
                $tmp_buf .= '<meta '.$meta.'>' .PHP_EOL; 
            }
            
            $tmp_buf = trim($tmp_buf);
                    
            $output = str_replace(self::ID_META, $tmp_buf, $output);
        }
        
        if($this->styles){ 
            $tmp_buf = '';
            foreach ($this->styles as $style){
                $tmp_buf .= $style.PHP_EOL; 
            }
            
            $tmp_buf = trim($tmp_buf);
                    
            $output = str_replace(self::ID_STYLES, $tmp_buf, $output);
        }
        
        if($this->scripts){ 
            $tmp_buf = '';
            foreach ($this->scripts as $script){
                $tmp_buf .= $script.PHP_EOL; 
            }
            
            $tmp_buf = trim($tmp_buf);
                    
            $output = str_replace(self::ID_SCRIPTS, $tmp_buf, $output);
        }
        
        if($this->body){ 
            $tmp_buf = '';
            foreach ($this->body as $body_chunk){
                $tmp_buf .= $body_chunk.PHP_EOL; 
            }
            
            $tmp_buf = trim($tmp_buf);
                    
            $output = str_replace(self::ID_BODY, $tmp_buf, $output);
        }
        
        return $output;
    }
}
