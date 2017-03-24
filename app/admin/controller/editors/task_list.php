<?php
class ControllerEditorsTaskList extends Controller {
    public function index() {
        $data = array();
        $this->load->model("editors");
        $data['user_tasks'] = $this->model_editors->getTasks($this->request->get['user_id']); 

        foreach ($data['user_tasks'] as $key => $task) {
            $data['user_tasks'][$key]['view'] = $this->load->controller('taskrender/the_task', $task);
        }
        $list_data['data'] = array_column($data['user_tasks'], 'view');
        $list_data['back_link'] = $this->response->url('panels/tasks', '?user_id='.$this->request->get['user_id']); 
        $list_data['user_id'] = $this->request->get['user_id'];

        return $this->load->view("editors/tasks_list", $data['user_tasks']);
    }
}
