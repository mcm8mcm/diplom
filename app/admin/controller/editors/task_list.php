<?php
class ControllerEditorsTaskList extends Controller {
    public function index() {
        $data = array();
        $this->load->model("editors");
        $data['user_tasks'] = $this->model_editors->getTasks($this->request->get['user_id']); 
        $add_to_data = array();
        $add_to_data['back_link'] = $this->response->url('panels/tasks', '?user_id='.$this->request->get['user_id']); 
        $add_to_data['user_id'] = $this->request->get['user_id'];
        foreach ($data['user_tasks'] as $key => $task) {
            $data['user_tasks'][$key]['view'] = $this->load->controller('taskrender/the_task', array($task, $add_to_data));
        }
        $list_data['data'] = array_column($data['user_tasks'], 'view');

        return $this->load->view("editors/tasks_list", $data['user_tasks']);
    }
}
