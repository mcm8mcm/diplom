<?php

class ControllerTaskrenderDeviceRenderer extends Controller {
    function index($device) {
        $this->load->language('taskrender/device_renderer');
        $data[] = array();
        $data['device_title'] = $this->language->get('device_title');
        $data['device_type_title'] = $this->language->get('device_type_title');
        $data['device_brand_title'] = $this->language->get('device_brand_title');
        $data['device_model_title'] = $this->language->get('device_model_title');
        $data['device_serial_title'] = $this->language->get('device_serial_title');
        $data['device'] = $device;
        return $this->load-view('taskrender', $data);
    }

}
