<?php
/* 
 * Generated by CRUDigniter v3.2 
 * www.crudigniter.com
 */
 
class Client extends MX_Controller{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Client_model');
    } 

    /*
     * Listing of clients
     */
    function index()
    {
        $params['limit'] = RECORDS_PER_PAGE; 
        $params['offset'] = ($this->input->get('per_page')) ? $this->input->get('per_page') : 0;
        
        $config = $this->config->item('pagination');
        $config['base_url'] = site_url('client/index?');
        $config['total_rows'] = $this->Client_model->get_all_clients_count();
        $this->pagination->initialize($config);

        $data['clients'] = $this->Client_model->get_all_clients($params);
        
        $data['_view'] = 'index';
        $this->load->view('layouts/main',$data);
    }

    /*
     * Adding a new client
     */
    function add()
    {   
        $this->load->library('form_validation');

		$this->form_validation->set_rules('mac','Mac','required');
		$this->form_validation->set_rules('package_id','Package Id','required');
		$this->form_validation->set_rules('comment','Comment','required');
		
		if($this->form_validation->run())     
        {   
            $params = array(
				'package_id' => $this->input->post('package_id'),
				'mac' => $this->input->post('mac'),
				'token' => sha1(time().rand(1000,9999).$this->input->post('mac')),
				'comment' => $this->input->post('comment'),
                'active' => (bool) $this->input->post("active"),
            );
            
            $client_id = $this->Client_model->add_client($params);
            redirect('clients');
        }
        else
        {
			$this->load->model('Package_model');
			$data['all_packages'] = $this->Package_model->get_all_packages();
            
            $data['_view'] = 'add';
            $this->load->view('layouts/main',$data);
        }
    }  

    /*
     * Editing a client
     */
    function edit($id)
    {   
        // check if the client exists before trying to edit it
        $data['client'] = $this->Client_model->get_client($id);
        
        if(isset($data['client']['id']))
        {
            $this->load->library('form_validation');

			$this->form_validation->set_rules('mac','Mac','required');
			$this->form_validation->set_rules('package_id','Package Id','required');
			$this->form_validation->set_rules('comment','Comment','required');
		
			if($this->form_validation->run())     
            {   
                $params = array(
					'package_id' => $this->input->post('package_id'),
					'mac' => $this->input->post('mac'),
					'comment' => $this->input->post('comment'),
                    'active' => (bool) $this->input->post("active"),
                );

                $this->Client_model->update_client($id,$params);            
                redirect('clients');
            }
            else
            {
				$this->load->model('Package_model');
				$data['all_packages'] = $this->Package_model->get_all_packages();

                $data['_view'] = 'edit';
                $this->load->view('layouts/main',$data);
            }
        }
        else
            show_error('The client you are trying to edit does not exist.');
    } 

    /*
     * Deleting client
     */
    function remove($id)
    {
        $client = $this->Client_model->get_client($id);

        // check if the client exists before trying to delete it
        if(isset($client['id']))
        {
            $this->Client_model->delete_client($id);
            redirect('clients');
        }
        else
            show_error('The client you are trying to delete does not exist.');
    }
    
}
