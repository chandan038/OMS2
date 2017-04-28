<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';

class Orders extends REST_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->database();
		$this->load->model('order_model');
    }

    public function orders_get($id = '')
    {
		$check = gettype($id);
		
		$orders = $this->order_model->get_all();
		
        if ($id == NULL)
        {
			if ($orders)
            {
               $this->response($orders, REST_Controller::HTTP_OK); 
            }
            else
            {
               $this->response([
                    'status' => FALSE,
                    'message' => 'No order were found'
                ], REST_Controller::HTTP_NOT_FOUND); 
            }
        }
		
	  $order = NULL;
      if (!empty($orders))
        {
            foreach ($orders as $value)
            {
                if (isset($value->id) && $value->id == $id )
                {
					$order = $value;
                }
			}
        }
		
		if ($check == 'string' && $id == 'today')
		{
			$c_date = date("Y-m-d", strtotime($value->created_at));
			$t_date =  date('Y-m-d');
			foreach ($orders as $value)
			{ 
				if ($c_date == $t_date)
				{
					$order[] = $value;
				}
			}
		}
        if (!empty($order))
        {
            $this->set_response($order, REST_Controller::HTTP_OK);
        }
        else
        {
            $this->set_response([
                'status' => FALSE,
                'message' => 'Order could not be found'
            ], REST_Controller::HTTP_NOT_FOUND);
        }
    }

    public function orders_post()
    {
		// Order
        $order_data = array(
            'email_id' => $this->post('email'),
            'status' => $this->post('status')
        );
		
		$last_id = $this->order_model->insert_data('orders',$order_data);
		// Order Items
		$order_item = array(
            'order_id' => $last_id,
            'name' => $this->post('name'),
            'price' => $this->post('price'),
            'quantity' => $this->post('quantity')
        );
			
		$this->order_model->insert_data('order_items',$order_item);
		
		$message = [
            'message' => 'Data Insert Successfully'
        ];
		
		$this->set_response($message, REST_Controller::HTTP_CREATED); // CREATED (201) being the HTTP response code
    }

    public function orders_put($id ='',$status='') 
	{
		$data = $this->put();
		$data['id'] = $id;
		$isId = $this->order_model->get_by($data['id']);
            if ($isId) {
			// Order
			if($status){
				$data['status'] = $status;
			}
			else{
				$data['status'] = $data['status'];
			}
				$order_data = array(
					'email_id' => $data['email'],
					'status' => $data['status']
				);
				$this->order_model->update_data('orders',$data['id'],'id',$order_data);
				// Order Items
				$order_item = array(
					'order_id' => $data['id'],
					'name' => $data['name'],
					'price' => $data['price'],
					'quantity' => $data['quantity']
				);
				$this->order_model->update_data('order_items',$data['id'],'order_id',$order_item);
				
				$this->response(array('status' => 'Success', 'message' => 'Data Updated successfully'), REST_Controller::HTTP_CONFLICT);
                
            } else {
                $this->response(array('status' => 'fail', 'message' => 'Id does not exist'), REST_Controller::HTTP_CONFLICT);
            }
    }
		
	
	

}
