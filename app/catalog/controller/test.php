<?php
class ControllerTest extends Controller{
    public function index() {
        $this->document->setTitle('Preved');
        $this->response->setOutput($this->document->render());
        $this->response->flush();
    }
}