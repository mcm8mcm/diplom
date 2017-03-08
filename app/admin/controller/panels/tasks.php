<?php

class ControllerPanelsTasks extends Controller {

    public function index() {

        if (!$this->user->isLoggedIn()) {
            $this->response->redirect($this->response->url('login'));
        }

        $sacc_err = array();
        if (isset($this->session->data['sacc_err'])) {
            $sacc_err = $this->session->data['sacc_err'];
            unset($this->session->data['sacc_err']);
        }

        $this->load->language('controlpanel');

        $header = $this->load->controller('common/header');
        $sidebar = $this->load->controller('common/sidebar');
        $content = $this->load->controller('editors/edtasks', $sacc_err);
        $body = $this->load->view('common/controlpanel', array('header' => $header, 'sidebar' => $sidebar, 'admincontent' => $content));

        $this->document->setTitle($this->language->get('title'));
        $this->document->addBody($body);

        $this->response->setOutput($this->document->render());
        $this->response->flush();
    }

    public function save() {
        //ddd($this->request->post);
        if (!$this->user->isLoggedIn()) {
            $this->response->redirect($this->response->url('login'));
        }

        if (!isset($this->request->post) || !isset($this->request->post['zone'])) {
            $this->index();
        }

        $this->request->post['content'] = html_entity_decode($this->request->post['content']);
        $this->load->model('editors');
        $res = $this->model_editors->saveFooterData($this->request->post);
        $this->session->data['sacc_err'] = $res;
        $this->session->data['curr_footer_edit_tab'] = $this->request->post['zone'];
        $this->response->redirect($this->response->url('panels/footer'));
    }

}
