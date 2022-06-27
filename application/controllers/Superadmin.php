<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Superadmin extends MY_Controller {

	public function __construct()
	{
		//call CodeIgniter's default Constructor
		parent::__construct();
		
		//load Model
		$this->load->model('Superadmin_model');

		//load Helper
		$this->load->helper('cf_helper');

		//Time Zone
		date_default_timezone_set("Asia/kolkata"); // IST time zone
		// date_default_timezone_set("US/Eastern"); // EST time zone
	}

	public function index()
	{
	    if(!empty($this->session->userdata('superadmin_id')) && ($this->session->userdata('superadmin_id')))
	    {
	      redirect(base_url('superadmin/dashboard'));
	    }
	    else{
	      $this->load->view('superadmin/login');  
	    }
	}

	public function dashboard()
	{
	    if(!empty($this->session->userdata('superadmin_id')) && ($this->session->userdata('superadmin_id')))
	    {
	      $this->load->view('superadmin/dashboard'); 
	    }
	    else{
	      redirect(base_url('superadmin'));
	    }
	}

	public function check_login()
	{
	    $this->load->library('form_validation');
	    $this->form_validation->set_rules('username','Username','required');
	    $this->form_validation->set_rules('password','Password','required');
	    $this->form_validation->set_rules('g-recaptcha-response','Recaptcha','required');
	    if ($this->form_validation->run() == FALSE)
	    {
	      $response['errors'] = validation_errors();
	      $response['status'] = FALSE;

	      // You can use the Output class here too
	      header('Content-type: application/json');
	      //echo json_encode($response);
	      exit(json_encode($response));
	    }
	    else
	    {
	      $username = $this->input->post('username');
	      $password = $this->input->post('password'); 
	          
	          $data = $this->Superadmin_model->checkLogin($username,$password);
	          if($data > 0)
	          {
	          	$secretKey = "6Ldw3zocAAAAAKHucjAsi9NqyX7Je4MJvIS0Z7lm";
		        $responseKey = $this->input->post('g-recaptcha-response');
		        $userIP = $this->input->server('REMOTE_ADDR');       
		        $url = "https://www.google.com/recaptcha/api/siteverify?secret=$secretKey&response=$responseKey&remoteip=$userIP";
		        $response1 = file_get_contents($url);
		        $response1 = json_decode($response1);
		        if($response1->success)
	            {
	            	if(!empty($this->input->post('basic_checkbox_1')))
		            {
		                setcookie("med_username",$username,time()+ (10 * 365 * 24 * 60 * 60),'/');
		                setcookie("med_spassword",$password,time()+ (10 * 365 * 24 * 60 * 60),'/');
		            }
		            else
		            {
		              	setcookie("med_username","",time() - 3600,'/');
		              	setcookie("med_spassword","",time() - 3600,'/');
		            }
	            	$this->session->set_userdata('msuperadmin_id',$username);
		            $user = $this->Superadmin_model->selectLogin();
		            $this->session->set_userdata('superadmin_id',$user->id);
		            $this->session->set_flashdata('message', 'Successfully Logged In');

		            $response['status'] = TRUE;
		            header('Content-type: application/json');
		            echo json_encode($response);
	            }
	            else
		        {
		        	$response['errors'] = 'Verification Failed';
			    	$response['status'] = FALSE;
			    	header('Content-type: application/json');
			    	exit(json_encode($response));
		        }
	          }
	          else
	          {
	            $response['errors'] = 'Wrong Username or Password';
	            $response['status'] = FALSE;

	            // You can use the Output class here too
	            header('Content-type: application/json');
	            //echo json_encode($response);
	            exit(json_encode($response));
	          }
	        
	    }
	}

	public function registered_users()
	{
	    if(!empty($this->session->userdata('superadmin_id')) && ($this->session->userdata('superadmin_id')))
	    {

	      $data['role'] = $this->Superadmin_model->getRole();
	      $data['users'] = $this->Superadmin_model->registeredUsers();
	      $this->load->view('superadmin/registered_users',$data); 
	    }
	    else{
	      redirect(base_url('superadmin'));
	    }
	}

  public function calendar()
  {
    $this->load->view('superadmin/calendar');
      // if(($this->session->userdata('student_id')) || ($this->session->userdata('student_id') != ""))
      // {
      //     $student_id = $this->session->userdata('student_id');
      //     $data['stud_del'] = $this->Front_model->getStudentById($student_id);
      //     $stud_mod = $this->Front_model->getStudentModuleCount($student_id);
      //     $data['events'] = $this->Front_model->getActiveEvents($student_id);
      //     $data['draggable_events'] = $this->Front_model->getDraggableEvents($student_id);
      //     $data['time_24hrs'] = $this->Front_model->gettime_24hrs();
      //     $data['time_12hrs'] = $this->Front_model->gettime_12hrs();
      //     $data['motivator'] = $this->Front_model->getRandMotivator();   
      //     if($stud_mod > 0){
      //         $data['allocator_mod'] = $this->Front_model->getModuleByStudId($student_id,1);
      //         $data['scheduler_mod'] = $this->Front_model->getModuleByStudId($student_id,2);
      //         $this->load->view('user/calendar',$data);
      //     }else{
      //         redirect(base_url('complete-process'));
      //     }           
      // }else{
      //     redirect(base_url('login-register'));
      // }       
  }

  public function get_calendar_subjects()
  {
      $student_id = $this->session->userdata('student_id');
      $month_year = $this->input->post('month_year');
      $month_year = date('Y-m');
      $data = $this->Superadmin_model->getCalendarSubjects($student_id,$month_year);
      // print_r($data);
      // die();
      $format = 'Y-m-d';
      $data_array = array();
      if($data){
          foreach ($data as $d) {
              if($d->event_repeat_option == 'Does not repeat')
              {              
                  $event_start_date = date($format, strtotime($d->event_start_date));
                  $event_end_date = date($format, strtotime($d->event_end_date));
                  $data1 = array( 'student_id' => $this->session->userdata('student_id'),
                                  'id' => $d->id,
                                  'event_name' => $d->event_name,
                                  'event_color' => $d->event_color,
                                  'event_note' => $d->event_note,
                                  'event_start_date' => $event_start_date,
                                  'event_end_date' => $event_end_date,
                                  'event_start_time' => $d->event_start_time,
                                  'event_end_time' => $d->event_end_time,
                                  'event_repeat_option' => $d->event_repeat_option,
                                  'event_allDay' => $d->event_allDay,
                                  'event_reminder' => $d->event_reminder,
                                  'draggable_event' => $d->draggable_event,
                                  'draggable_id' => $d->draggable_id,
                                  'type' => $d->type,
                               );
                  $data_array[] = $data1;
              }
              
          }
      }
      header('Content-type: application/json');
      echo json_encode($data_array);  
  }

  public function admin_planner()
	{
	    if(!empty($this->session->userdata('superadmin_id')) && ($this->session->userdata('superadmin_id')))
	    {
	      $data['program'] = $this->Superadmin_model->getPlanner();
	      $this->load->view('superadmin/planner',$data); 
	    }
	    else{
	      redirect(base_url('superadmin'));
	    }
	}


	public function user_detail()
	{
	    if(!empty($this->session->userdata('superadmin_id')) && ($this->session->userdata('superadmin_id')))
	    {
	    	$student_id = $this->uri->segment(3);
	    	$data['stud_del'] = $this->Superadmin_model->getStudentById($student_id);
	    	$data['stud_mod'] = $this->Superadmin_model->getStudentModuleById($student_id);
            $data['allocator_mod'] = $this->Superadmin_model->getModuleByStudId($student_id,1);
            $data['scheduler_mod'] = $this->Superadmin_model->getModuleByStudId($student_id,2);
	      	$this->load->view('superadmin/user_detail',$data); 
	    }
	    else{
	      	redirect(base_url('superadmin'));
	    }
	}

	public function assign_role()
	{
		$student_id = $this->input->post('student_id');
		$role_id = $this->input->post('role_id');
		$data = array( 'role_id' => $role_id );
      	$this->Superadmin_model->updateRegistration($data,$student_id);
	}

	public function delete_student()
	{
		$student_id = $this->input->post('student_id');
      	$this->Superadmin_model->deleteStudent($student_id);
	}

	public function motivator()
	{
	    if(!empty($this->session->userdata('superadmin_id')) && ($this->session->userdata('superadmin_id')))
	    {
	      $data['motivator'] = $this->Superadmin_model->getMotivator();
	      $this->load->view('superadmin/motivator',$data); 
	    }
	    else{
	      redirect(base_url('superadmin'));
	    }
	}

	public function insert_motivator() //Update Student Details
    {
        $this->form_validation->set_rules('quote','Quote','trim|required');
        $this->form_validation->set_rules('writer','Writer','trim|required');
        
        if ($this->form_validation->run() == FALSE)
        {
            //$errors = array();

            $errors = $this->form_validation->error_array();
            // Loop through $_POST and get the keys
            foreach ($errors as $key => $value)
            {
              // Add the error message for this field
              $errors[$key] = form_error($key);
            }
          
            $response['errors'] = array_filter($errors); // Some might be empty
            $response['status'] = FALSE;
            // You can use the Output class here too
            header('Content-type: application/json');
            //echo json_encode($response);
            exit(json_encode($response));
        }
        else
        {
            $data = array(  'quote' => $this->input->post('quote'),
                            'writer' => $this->input->post('writer'),
                            'status' => 'active',
                            'date' => date('Y-m-d H:i:s'),
                         );
            $data = $this->security->xss_clean($data); // xss filter
            $this->Superadmin_model->insertMotivator($data);
            $this->session->set_flashdata('message', 'Motivational Quote Successfully Added');
            $response['status'] = TRUE;
            header('Content-type: application/json');
            echo json_encode($response);  
        }
    }

    public function get_motivator_details()
	{
	    if(!empty($this->session->userdata('superadmin_id')) && ($this->session->userdata('superadmin_id')))
	    {
	    	$mid = $this->input->post('mid');
	    	$m_del = $this->Superadmin_model->getMotivatorById($mid);
	    	$response['quote'] = $m_del->quote;
	    	$response['writer'] = $m_del->writer;
	    	$response['mid'] = $m_del->id;
            header('Content-type: application/json');
            echo json_encode($response);  
	    }
	    else{
	      	redirect(base_url('superadmin'));
	    }
	}

	public function update_motivator() //Update Student Details
    {
        $this->form_validation->set_rules('quote','Quote','trim|required');
        $this->form_validation->set_rules('writer','Writer','trim|required');
        
        if ($this->form_validation->run() == FALSE)
        {
            //$errors = array();

            $errors = $this->form_validation->error_array();
            // Loop through $_POST and get the keys
            foreach ($errors as $key => $value)
            {
              // Add the error message for this field
              $errors[$key] = form_error($key);
            }
          
            $response['errors'] = array_filter($errors); // Some might be empty
            $response['status'] = FALSE;
            // You can use the Output class here too
            header('Content-type: application/json');
            //echo json_encode($response);
            exit(json_encode($response));
        }
        else
        {
        	$mid = $this->input->post('mid');
            $data = array(  'quote' => $this->input->post('quote'),
                            'writer' => $this->input->post('writer')
                         );
            $data = $this->security->xss_clean($data); // xss filter
            $this->Superadmin_model->updateMotivator($data,$mid);
            $this->session->set_flashdata('message', 'Motivational Quote Successfully Updated');
            $response['status'] = TRUE;
            header('Content-type: application/json');
            echo json_encode($response);  
        }
    }

	public function delete_motivator()
	{
		$mid = $this->input->post('mid');
      	$this->Superadmin_model->deleteMotivator($mid);
	}

	public function program()
	{
	    if(!empty($this->session->userdata('superadmin_id')) && ($this->session->userdata('superadmin_id')))
	    {
	      $data['program'] = $this->Superadmin_model->getProgram();
	      $this->load->view('superadmin/program',$data); 
	    }
	    else{
	      redirect(base_url('superadmin'));
	    }
	}

	public function insert_program() //Insert Program Details
    {
        $this->form_validation->set_rules('name','Name','trim|required');
        
        if ($this->form_validation->run() == FALSE)
        {
            //$errors = array();

            $errors = $this->form_validation->error_array();
            // Loop through $_POST and get the keys
            foreach ($errors as $key => $value)
            {
              // Add the error message for this field
              $errors[$key] = form_error($key);
            }
          
            $response['errors'] = array_filter($errors); // Some might be empty
            $response['status'] = FALSE;
            // You can use the Output class here too
            header('Content-type: application/json');
            //echo json_encode($response);
            exit(json_encode($response));
        }
        else
        {
            $data = array(  'name' => $this->input->post('name'),
                            'status' => 'active',
                            'date' => date('Y-m-d H:i:s'),
                         );
            $data = $this->security->xss_clean($data); // xss filter
            $this->Superadmin_model->insertProgram($data);
            $this->session->set_flashdata('message', 'Program Successfully Added');
            $response['status'] = TRUE;
            header('Content-type: application/json');
            echo json_encode($response);  
        }
    }


    public function insert_planner() //Insert Planner Details
    {
        $this->form_validation->set_rules('name','Name','trim|required');
        
        if ($this->form_validation->run() == FALSE)
        {
            //$errors = array();

            $errors = $this->form_validation->error_array();
            // Loop through $_POST and get the keys
            foreach ($errors as $key => $value)
            {
              // Add the error message for this field
              $errors[$key] = form_error($key);
            }
          
            $response['errors'] = array_filter($errors); // Some might be empty
            $response['status'] = FALSE;
            // You can use the Output class here too
            header('Content-type: application/json');
            //echo json_encode($response);
            exit(json_encode($response));
        }
        else
        {
            $data = array(  'name' => $this->input->post('name'),
                            'status' => 'active',
                            'date' => date('Y-m-d H:i:s'),
                         );
            $data = $this->security->xss_clean($data); // xss filter
            $this->Superadmin_model->insertPlanner($data);
            $this->session->set_flashdata('message', 'Planner Successfully Added');
            $response['status'] = TRUE;
            header('Content-type: application/json');
            echo json_encode($response);  
        }
    }

    public function get_program_details()
	{
	    if(!empty($this->session->userdata('superadmin_id')) && ($this->session->userdata('superadmin_id')))
	    {
	    	$pid = $this->input->post('pid');
	    	$pro_del = $this->Superadmin_model->getProgramById($pid);
	    	$response['name'] = $pro_del->name;
	    	$response['pid'] = $pro_del->id;
            header('Content-type: application/json');
            echo json_encode($response);  
	    }
	    else{
	      	redirect(base_url('superadmin'));
	    }
	}

  public function get_planner_details()
	{
	    if(!empty($this->session->userdata('superadmin_id')) && ($this->session->userdata('superadmin_id')))
	    {
	    	$pid = $this->input->post('pid');
	    	$pro_del = $this->Superadmin_model->getPlannerById($pid);
	    	$response['name'] = $pro_del->name;
	    	$response['pid'] = $pro_del->id;
            header('Content-type: application/json');
            echo json_encode($response);  
	    }
	    else{
	      	redirect(base_url('superadmin'));
	    }
	}

	public function update_program() //Update Program Details
    {
        $this->form_validation->set_rules('name','Name','trim|required');
        
        if ($this->form_validation->run() == FALSE)
        {
            //$errors = array();

            $errors = $this->form_validation->error_array();
            // Loop through $_POST and get the keys
            foreach ($errors as $key => $value)
            {
              // Add the error message for this field
              $errors[$key] = form_error($key);
            }
          
            $response['errors'] = array_filter($errors); // Some might be empty
            $response['status'] = FALSE;
            // You can use the Output class here too
            header('Content-type: application/json');
            //echo json_encode($response);
            exit(json_encode($response));
        }
        else
        {
        	$pid = $this->input->post('pid');
            $data = array(  'name' => $this->input->post('name') );
            $data = $this->security->xss_clean($data); // xss filter
            $this->Superadmin_model->updateProgram($data,$pid);
            $this->session->set_flashdata('message', 'Program Successfully Updated');
            $response['status'] = TRUE;
            header('Content-type: application/json');
            echo json_encode($response);  
        }
    }

    public function update_planner() //Update Planner Details
    {
        $this->form_validation->set_rules('name','Name','trim|required');
        
        if ($this->form_validation->run() == FALSE)
        {
            //$errors = array();

            $errors = $this->form_validation->error_array();
            // Loop through $_POST and get the keys
            foreach ($errors as $key => $value)
            {
              // Add the error message for this field
              $errors[$key] = form_error($key);
            }
          
            $response['errors'] = array_filter($errors); // Some might be empty
            $response['status'] = FALSE;
            // You can use the Output class here too
            header('Content-type: application/json');
            //echo json_encode($response);
            exit(json_encode($response));
        }
        else
        {
        	$pid = $this->input->post('pid');
            $data = array(  'name' => $this->input->post('name') );
            $data = $this->security->xss_clean($data); // xss filter
            $this->Superadmin_model->updatePlanner($data,$pid);
            $this->session->set_flashdata('message', 'Program Successfully Updated');
            $response['status'] = TRUE;
            header('Content-type: application/json');
            echo json_encode($response);  
        }
    }

	public function delete_program()
	{
		$pid = $this->input->post('pid');
      	$this->Superadmin_model->deleteProgram($pid);
	}

  public function delete_planner()
	{
		$pid = $this->input->post('pid');
      	$this->Superadmin_model->deletePlanner($pid);
	}


	public function view_program()
	{
	    if(!empty($this->session->userdata('superadmin_id')) && ($this->session->userdata('superadmin_id')))
	    {
	    	$pid = $this->uri->segment(3);
	    	$data['pro_del'] = $this->Superadmin_model->getProgramById($pid);
	    	$data['program_cycle'] = $this->Superadmin_model->getProgramCycleByPid($pid);
	      	$this->load->view('superadmin/view_program',$data); 
	    }
	    else{
	      redirect(base_url('superadmin'));
	    }
	}

  public function view_planner()
	{
	    if(!empty($this->session->userdata('superadmin_id')) && ($this->session->userdata('superadmin_id')))
	    {
	    	$pid = $this->uri->segment(3);
	    	$data['pro_del'] = $this->Superadmin_model->getPlannerById($pid);
	    	$data['program_cycle'] = $this->Superadmin_model->getProgramCycleByPid($pid);
	      	$this->load->view('superadmin/view_planner',$data); 
	    }
	    else{
	      redirect(base_url('superadmin'));
	    }
	}
	public function program_cycle()
	{
	    if(!empty($this->session->userdata('superadmin_id')) && ($this->session->userdata('superadmin_id')))
	    {
	      $data['program_cycle'] = $this->Superadmin_model->getProgramCycle();
	      $this->load->view('superadmin/program_cycle',$data); 
	    }
	    else{
	      redirect(base_url('superadmin'));
	    }
	}

	public function insert_program_cycle() //Insert Program Cycle Details
    {
        $this->form_validation->set_rules('day','Day','trim|required');
        $this->form_validation->set_rules('course_code','Course Code','trim|required');
        $this->form_validation->set_rules('subject','Subject','trim|required');
        $this->form_validation->set_rules('start_time','Start Time','trim|required');
        $this->form_validation->set_rules('end_time','End Time','trim|required');
        $this->form_validation->set_rules('hours','Hours','trim|required');
        $this->form_validation->set_rules('alc','ALC','trim');
        
        if ($this->form_validation->run() == FALSE)
        {
            //$errors = array();

            $errors = $this->form_validation->error_array();
            // Loop through $_POST and get the keys
            foreach ($errors as $key => $value)
            {
              // Add the error message for this field
              $errors[$key] = form_error($key);
            }
          
            $response['errors'] = array_filter($errors); // Some might be empty
            $response['status'] = FALSE;
            // You can use the Output class here too
            header('Content-type: application/json');
            //echo json_encode($response);
            exit(json_encode($response));
        }
        else
        {
            $data = array(  'day' => $this->input->post('day'),
                            'course_code' => $this->input->post('course_code'),
                            'subject' => $this->input->post('subject'),
                            'start_time' => $this->input->post('start_time'),
                            'end_time' => $this->input->post('end_time'),
                            'hours' => $this->input->post('hours'),
                            'alc' => $this->input->post('alc'),
                            'pid' => $this->input->post('pid'),
                            'status' => 'active',
                            'date' => date('Y-m-d H:i:s'),
                         );
            $data = $this->security->xss_clean($data); // xss filter
            $this->Superadmin_model->insertProgramCycle($data);
            $this->session->set_flashdata('message', 'Subject Successfully Added');
            $response['status'] = TRUE;
            header('Content-type: application/json');
            echo json_encode($response);  
        }
    }

    public function get_program_cycle_details()
	{
	    if(!empty($this->session->userdata('superadmin_id')) && ($this->session->userdata('superadmin_id')))
	    {
	    	$scid = $this->input->post('scid');
	    	$sc_del = $this->Superadmin_model->getProgramCycleById($scid);
	    	$response['day'] = $sc_del->day;
	    	$response['course_code'] = $sc_del->course_code;
	    	$response['subject'] = $sc_del->subject;
	    	$response['start_time'] = $sc_del->start_time;
	    	$response['end_time'] = $sc_del->end_time;
	    	$response['hours'] = $sc_del->hours;
	    	$response['alc'] = $sc_del->alc;
	    	$response['scid'] = $sc_del->id;
            header('Content-type: application/json');
            echo json_encode($response);  
	    }
	    else{
	      	redirect(base_url('superadmin'));
	    }
	}

	public function update_program_cycle() //Update Program Cycle Details
    {
        $this->form_validation->set_rules('day','Day','trim|required');
        $this->form_validation->set_rules('course_code','Course Code','trim|required');
        $this->form_validation->set_rules('subject','Subject','trim|required');
        $this->form_validation->set_rules('start_time','Start Time','trim|required');
        $this->form_validation->set_rules('end_time','End Time','trim|required');
        $this->form_validation->set_rules('hours','Hours','trim|required');
        $this->form_validation->set_rules('alc','ALC','trim');
        
        if ($this->form_validation->run() == FALSE)
        {
            //$errors = array();

            $errors = $this->form_validation->error_array();
            // Loop through $_POST and get the keys
            foreach ($errors as $key => $value)
            {
              // Add the error message for this field
              $errors[$key] = form_error($key);
            }
          
            $response['errors'] = array_filter($errors); // Some might be empty
            $response['status'] = FALSE;
            // You can use the Output class here too
            header('Content-type: application/json');
            //echo json_encode($response);
            exit(json_encode($response));
        }
        else
        {
        	$scid = $this->input->post('scid');
            $data = array(  'day' => $this->input->post('day'),
                            'course_code' => $this->input->post('course_code'),
                            'subject' => $this->input->post('subject'),
                            'start_time' => $this->input->post('start_time'),
                            'end_time' => $this->input->post('end_time'),
                            'hours' => $this->input->post('hours'),
                            'alc' => $this->input->post('alc'),
                            'pid' => $this->input->post('pid'),
                         );
            $data = $this->security->xss_clean($data); // xss filter
            $this->Superadmin_model->updateProgramCycle($data,$scid);
            $this->session->set_flashdata('message', 'Subject Successfully Updated');
            $response['status'] = TRUE;
            header('Content-type: application/json');
            echo json_encode($response);  
        }
    }

	public function delete_program_cycle()
	{
		$scid = $this->input->post('scid');
      	$this->Superadmin_model->deleteProgramCycle($scid);
	}

	public function holiday()
	{
	    if(!empty($this->session->userdata('superadmin_id')) && ($this->session->userdata('superadmin_id')))
	    {
	      $data['holiday'] = $this->Superadmin_model->getHoliday();
	      $this->load->view('superadmin/holiday',$data); 
	    }
	    else{
	      redirect(base_url('superadmin'));
	    }
	}

	public function insert_holiday() //Update Student Details
    {
        $this->form_validation->set_rules('on_date','On Date','trim|required');
        $this->form_validation->set_rules('category','Category','trim');
        $this->form_validation->set_rules('reason','Reason','trim');
        
        if ($this->form_validation->run() == FALSE)
        {
            //$errors = array();

            $errors = $this->form_validation->error_array();
            // Loop through $_POST and get the keys
            foreach ($errors as $key => $value)
            {
              // Add the error message for this field
              $errors[$key] = form_error($key);
            }
          
            $response['errors'] = array_filter($errors); // Some might be empty
            $response['status'] = FALSE;
            // You can use the Output class here too
            header('Content-type: application/json');
            //echo json_encode($response);
            exit(json_encode($response));
        }
        else
        {
        	$original_on_date = $this->input->post('on_date'); // m/d/Y            
            $on_date = date("Y-m-d", strtotime($original_on_date));
            $in_year = date("Y", strtotime($on_date));

            $data = array(  'on_date' => $on_date,
                            'category' => $this->input->post('category'),
                            'reason' => $this->input->post('reason'),
                            'in_year' => $in_year,
                            'status' => 'active',
                            'date' => date('Y-m-d H:i:s'),
                         );
            $data = $this->security->xss_clean($data); // xss filter
            $this->Superadmin_model->insertHoliday($data);
            $this->session->set_flashdata('message', 'Holiday Successfully Added');
            $response['status'] = TRUE;
            header('Content-type: application/json');
            echo json_encode($response);  
        }
    }

    public function get_holiday_details()
	{
	    if(!empty($this->session->userdata('superadmin_id')) && ($this->session->userdata('superadmin_id')))
	    {
	    	$wid = $this->input->post('wid');
	    	$sc_del = $this->Superadmin_model->getHolidayById($wid);
	    	$on_date = "";
	    	if($sc_del){
	    		$original_on_date = $sc_del->on_date;  //  Y-m-d
            	$on_date = date("m/d/Y", strtotime($original_on_date));
        	} 
        	$response['on_date'] = $on_date;
	    	$response['category'] = $sc_del->category;
	    	$response['reason'] = $sc_del->reason;
	    	$response['wid'] = $sc_del->id;
            header('Content-type: application/json');
            echo json_encode($response);  
	    }
	    else{
	      	redirect(base_url('superadmin'));
	    }
	}

	public function update_holiday() //Update Student Details
    {
        $this->form_validation->set_rules('on_date','On Date','trim|required');
        $this->form_validation->set_rules('category','Category','trim');
        $this->form_validation->set_rules('reason','Reason','trim');
        
        if ($this->form_validation->run() == FALSE)
        {
            //$errors = array();

            $errors = $this->form_validation->error_array();
            // Loop through $_POST and get the keys
            foreach ($errors as $key => $value)
            {
              // Add the error message for this field
              $errors[$key] = form_error($key);
            }
          
            $response['errors'] = array_filter($errors); // Some might be empty
            $response['status'] = FALSE;
            // You can use the Output class here too
            header('Content-type: application/json');
            //echo json_encode($response);
            exit(json_encode($response));
        }
        else
        {
        	$wid = $this->input->post('wid');
        	$original_on_date = $this->input->post('on_date'); // m/d/Y            
            $on_date = date("Y-m-d", strtotime($original_on_date));
            $in_year = date("Y", strtotime($on_date));

            $data = array(  'on_date' => $on_date,
                            'category' => $this->input->post('category'),
                            'reason' => $this->input->post('reason'),
                            'in_year' => $in_year,
                         );
            $data = $this->security->xss_clean($data); // xss filter
            $this->Superadmin_model->updateHoliday($data,$wid);
            $this->session->set_flashdata('message', 'Holiday Successfully Updated');
            $response['status'] = TRUE;
            header('Content-type: application/json');
            echo json_encode($response);  
        }
    }

	public function delete_holiday()
	{
		$wid = $this->input->post('wid');
      	$this->Superadmin_model->deleteHoliday($wid);
	}

	public function start_cycle()
	{
		$student_id = $this->input->post('student_id');
		$start_cycle = $this->input->post('start_cycle'); // m/d/Y
		$start_cycle = date("Y-m-d", strtotime($start_cycle)); // Y-m-d

		$data = array( 'start_cycle' => $start_cycle );
      	$this->Superadmin_model->updateRegistration($data,$student_id);
	}

	public function logout()
	{
	    $this->session->unset_userdata('superadmin_id');
	    $this->session->sess_destroy();
	    // redirect(base_url('login-register'));
	}
}
/* End of file Superadmin.php */
/* Location: ./application/controllers/Superadmin.php */
?>