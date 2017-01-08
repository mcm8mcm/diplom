<?php
class ControllerPrices extends Controller {
    public function index() {
        $this->load->model('prices');
        $prices = $this->model_prices->getPrices();
        $this->load->language('price');
        $data = array();
        $content = array();
        
        $data['no_prices'] = $this->language->get('no_prices');
        $data['prices_title'] = $this->language->get('prices_title');
        $data['col_nom'] = $this->language->get('col_nom');        
        $data['col_stc_name'] = $this->language->get('col_stc_name');
        $data['col_price'] = $this->language->get('col_price');
        
        if(count($prices)){
            foreach ($prices as $price){
                $data['content'] = $price;                
                $content[] = $this->load->view('price', $data);
            }
        }
        
        $data['prices'] = $content;
        return $this->load->view('prices', $data);
    }
}
