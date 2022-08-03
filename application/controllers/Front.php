<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Front extends MY_Controller {

    public function __construct()
    {
        //call CodeIgniter's default Constructor
        parent::__construct();
        
        //load Model
        $this->load->model('Front_model');

        //load Helper
        $this->load->helper('cf_helper');

        //load Facebook library
        $this->load->library('facebook'); 

        //load Google library
        require_once APPPATH.'third_party/src/Google_Client.php';
        require_once APPPATH.'third_party/src/contrib/Google_Oauth2Service.php';

        //Time Zone
        date_default_timezone_set("Asia/kolkata"); // IST time zone
        // date_default_timezone_set("US/Eastern"); // EST time zone
    }

    public function index()
    {
        if(($this->session->userdata('student_id')) || ($this->session->userdata('student_id') != ""))
        {
            $student_id = $this->session->userdata('student_id');
            $data['stud_del'] = $this->Front_model->getStudentById($student_id);
            $stud_mod = $this->Front_model->getStudentModuleCount($student_id);   
            $data['allocator_mod'] = $this->Front_model->getModuleByStudId($student_id,1);
            $data['scheduler_mod'] = $this->Front_model->getModuleByStudId($student_id,2);
            $data['motivator'] = $this->Front_model->getRandMotivator();   
            $data['events5'] = $this->Front_model->get5StudentEvents($student_id);
            $data['events'] = $this->Front_model->getActiveEvents($student_id);
            $data['tasks'] = $this->Front_model->get5StudentTotalTasks($student_id);      
            $data['time_12hrs'] = $this->Front_model->gettime_12hrs(); 
            echo $stud_mod;      
            if($stud_mod > 0){
                $this->load->view('user/calendar',$data);
            }else{
                redirect(base_url('complete-process'));
            }           
        }else{
            redirect(base_url('login-register'));
        }   
    }

    public function skip_profile() //Skip Profile
    {
        $student_id = $this->session->userdata('student_id');
        $id = $this->input->post('id');
        $data = array(  'profile_visit' => $id  );
        $data = $this->security->xss_clean($data); // xss filter
        $this->Front_model->updateRegistration($data,$student_id);
        $this->session->set_flashdata('message', 'Skipped Profile');
    }

    public function insert_course() //Insert Course
    {
        $this->form_validation->set_rules('course','Module','trim|required');
        $this->form_validation->set_rules('is_scheduled','Is Exam Date Scheduled','trim|required');
        $this->form_validation->set_rules('confidence_level','Confidence level','trim');
        
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
            $original_exam_date = $this->input->post('exam_date'); // m/d/Y            
            $exam_date = date("Y-m-d", strtotime($original_exam_date));

            $student_id = $this->session->userdata('student_id');
            $data = array(  'student_id' => $this->session->userdata('student_id'),
                            'course_id' => $this->input->post('course'),
                            'is_scheduled' => $this->input->post('is_scheduled'),
                            'exam_date' => $exam_date,
                            'confidence_level_id' => $this->input->post('confidence_level'),
                            'status' => 'active',
                            'date' => date('Y-m-d H:i:s'),
                         );
            $data = $this->security->xss_clean($data); // xss filter
            $this->Front_model->insertCourse($data);
            $inserted_id = $this->db->insert_id();
            $this->session->set_userdata('student_course_id', $inserted_id);

            $data1 = array(  'course_visit' => 1  );
            $data1 = $this->security->xss_clean($data1); // xss filter
            $this->Front_model->updateRegistration($data1,$student_id);

            $this->session->set_flashdata('message', 'Successfully Submitted');
            $response['status'] = TRUE;
            header('Content-type: application/json');
            echo json_encode($response);  
        }
    }

    public function complete_process()
    {
        if(($this->session->userdata('student_id')) || ($this->session->userdata('student_id') != ""))
        {
            $student_id = $this->session->userdata('student_id');
            $data['stud_del'] = $this->Front_model->getStudentById($student_id);
            $data['stud_mod_count'] = $this->Front_model->getStudentModuleCount($student_id);
            $data['stud_mod'] = $this->Front_model->getStudentModuleById($student_id);
            $data['allocator_mod'] = $this->Front_model->getModuleByStudId($student_id,1);
            $data['scheduler_mod'] = $this->Front_model->getModuleByStudId($student_id,2);
            $data['motivator'] = $this->Front_model->getRandMotivator();   
            $data['events5'] = $this->Front_model->get5StudentEvents($student_id);
            $data['events'] = $this->Front_model->getActiveEvents($student_id);
            $data['tasks'] = $this->Front_model->get5StudentTotalTasks($student_id);
            $data['time_12hrs'] = $this->Front_model->gettime_12hrs(); 
            $data['active_courses'] = $this->Front_model->getCourses();
            $data['active_conf_level'] = $this->Front_model->getConfidenceLevel();
            $data['schools'] = $this->Front_model->getSchoolNames();
            $data['hear_from'] = $this->Front_model->getHearFrom();
            $this->load->view('user/complete_process',$data);
        }else{
            redirect(base_url('login-register'));
        }   
    }

    public function login_register()
    {
        
        if(($this->session->userdata('student_id')) || ($this->session->userdata('student_id') != ""))
        {
            redirect(base_url());
        }else{
            // Facebook authentication url 
            $data['authURL'] =  $this->facebook->login_url(); 
            $this->load->view('user/login_register',$data);
        }   
    }

    public function check_login() //Check Login
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('login_email','Email Address','required|valid_email');
        $this->form_validation->set_rules('login_password','Password','required');
        //$this->form_validation->set_rules('g-recaptcha-response','Recaptcha','required');
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
            $email = $this->input->post('login_email');
            $password = $this->input->post('login_password');  

            $data = $this->Front_model->checkLogin($email,md5($password));
            if($data > 0)
            {               
                // $secretKey = "6Ldw3zocAAAAAKHucjAsi9NqyX7Je4MJvIS0Z7lm";
                // $responseKey = $this->input->post('g-recaptcha-response');
                // $userIP = $this->input->server('REMOTE_ADDR');       
                // $url = "https://www.google.com/recaptcha/api/siteverify?secret=$secretKey&response=$responseKey&remoteip=$userIP";
                // $response1 = file_get_contents($url);
                // $response1 = json_decode($response1);

                // if($response1->success)
                if(true)
                {    
                    $sdel = $this->Front_model->selectLogin($email);
                    if($sdel->verified == 'yes')
                    {
                        if(!empty($this->input->post('basic_checkbox_1')))
                        {
                            setcookie("med_email",$email,time()+ (10 * 365 * 24 * 60 * 60),'/');
                            setcookie("med_password",$password,time()+ (10 * 365 * 24 * 60 * 60),'/');
                        }
                        else
                        {
                            setcookie("med_email","",time() - 3600,'/');
                            setcookie("med_password","",time() - 3600,'/');
                        }   
                        $user = $this->Front_model->selectLogin($email);
                        $this->session->set_userdata('student_id',$user->reg_id);
                        $ceip = $this->Front_model->checkEmailinPlanner($email);
                        if($ceip){
                            $planner_id = $ceip->id;
                            $data1 = array(
                                'mentor_id' => $user->reg_id,
                                'mentor_request' => 'accept'
                            );
                            $this->Front_model->updatePlanner($data1,$planner_id);
                            $data2 = array(  'role_id' => '1' );
                            $this->Front_model->updateRegistration($data2,$user->reg_id);
                        }
                        $this->session->set_flashdata('message', 'Successfully Logged In');
                        $response['status'] = TRUE;
                        header('Content-type: application/json');
                        echo json_encode($response);
                    }else{
                            $response['errors'] = 'Verification link has been sent on your registered email Address. Verify you account to login';
                            $response['status'] = FALSE;
                            header('Content-type: application/json');
                            exit(json_encode($response));
                    }           
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
                $response['errors'] = 'Wrong Email Address or Password';
                $response['status'] = FALSE;
                header('Content-type: application/json');
                exit(json_encode($response));
            }
        }
    }
    public function calendar()
    {
        if(($this->session->userdata('student_id')) || ($this->session->userdata('student_id') != ""))
        {
            $student_id = $this->session->userdata('student_id');
            $data['stud_del'] = $this->Front_model->getStudentById($student_id);
            $stud_mod = $this->Front_model->getStudentModuleCount($student_id);
            $data['events'] = $this->Front_model->getActiveEvents($student_id);
            $data['draggable_events'] = $this->Front_model->getDraggableEvents($student_id);
            $data['time_24hrs'] = $this->Front_model->gettime_24hrs();
            $data['time_12hrs'] = $this->Front_model->gettime_12hrs();
            $data['motivator'] = $this->Front_model->getRandMotivator();   
            if($stud_mod > 0){
                $data['allocator_mod'] = $this->Front_model->getModuleByStudId($student_id,1);
                $data['scheduler_mod'] = $this->Front_model->getModuleByStudId($student_id,2);
                $this->load->view('user/calendar',$data);
            }else{
                redirect(base_url('complete-process'));
            }           
        }else{
            redirect(base_url('login-register'));
        }       
    }

    public function update_event() //Update Event Details
    {
        $this->form_validation->set_rules('event_name','Event Name','trim|required');
        $this->form_validation->set_rules('event_color','Event Color','trim|required');
        
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
            $start_date = explode(' ',$this->input->post('start_date'));
            $end_date = explode(' ',$this->input->post('end_date'));
            $event_id = $this->input->post('event_id');
            $data = array(  'student_id' => $this->session->userdata('student_id'),
                            'event_name' => $this->input->post('event_name'),
                            'event_color' => $this->input->post('event_color'),
                            'event_start_date' => $start_date[0],
                            'event_end_date' => $end_date[0],
                            'event_start_time' => $start_date[1],
                            'event_end_time' => $end_date[1],
                            'event_allDay' => $this->input->post('allDay'),
                         );
            $data = $this->security->xss_clean($data); // xss filter
            $this->Front_model->updateEvent($data,$event_id);
            $this->session->set_flashdata('message', 'Successfully Updated');
            $response['event_start_date'] = $start_date[0];             
            $response['event_end_date'] = $end_date[0]; 
            $response['event_start_time'] = $start_date[1];             
            $response['event_end_time'] = $end_date[1];     
            $response['event_allDay'] = $this->input->post('allDay');       
            $response['status'] = TRUE;

            header('Content-type: application/json');
            echo json_encode($response);  
        }
    }

    public function delete_event() //Delete Event
    { 
        $event_id = $this->input->post('event_id');
        $delete_check = $this->input->post('delete_check');
        $query_result = $this->Front_model->deleteEvent($event_id,$delete_check);
        $response['status'] = TRUE;
        $response['data'] = $query_result;
        header('Content-type: application/json');
        echo json_encode($response);
    }

    public function insert_module() //Update Module Details
    {
        $this->form_validation->set_rules('module','Module','trim|required');
        
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
            $student_id = $this->session->userdata('student_id');
            $data = array(  'student_id' => $this->session->userdata('student_id'),
                            'module_id' => $this->input->post('module'),
                            'status' => 'active',
                            'date' => date('Y-m-d H:i:s'),
                         );
            $data = $this->security->xss_clean($data); // xss filter
            $this->Front_model->insertModule($data);
            $inserted_id = $this->db->insert_id();

            $this->session->set_userdata('student_module_id', $this->input->post('module'));
            $this->session->set_flashdata('message', 'Module Successfully Added');
            $response['status'] = TRUE;

            header('Content-type: application/json');
            echo json_encode($response);  
        }
    }

    function displayDates($date1, $date2, $format = 'Y-m' ) 
        {
          $dates = array();
          $date1  = date("Y-m", strtotime($date1));
          $date2  = date("Y-m", strtotime($date2));
          $current = strtotime($date1);
          $date2 = strtotime($date2);
          $stepVal = '+1 months';
          while( $current <= $date2 ) {
             $dates[] = date($format, $current);
             $current = strtotime($stepVal, $current);
          }
          return $dates;
        }

    public function insert_draggable_event() //Insert Draggable Event Details
    {
        // print_r($this->input->post());
        // die;
        if($this->input->post('event_allDay') == 'on'){
            $event_reminder = $this->input->post('event_reminder_new');
        }else{
            $event_reminder = $this->input->post('event_reminder') ;
        }
        
        $unique_key = uniqid();
        $this->form_validation->set_rules('event_name','Event Name','trim|required');
        $this->form_validation->set_rules('event_color','Event Color','trim|required');
        // if($this->input->post('event_repeat_option') == 'Does not repeat'){
        //     $this->form_validation->set_rules('event_start_end_date_new','event_start_end_date_new','trim|required');       
        // }
        
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
            
            $type = $this->input->post('type');         
                $event_start_end_date = $this->input->post('event_start_end_date');
                $sdd = explode(' - ',$event_start_end_date);
                $event_start_date = $sdd[0];
                $event_end_date = $sdd[1];
                if($this->input->post('event_repeat_option') == 'Does not repeat') 
                    {
                    $end_date = $event_end_date;
                    }
                    else
                    {
                    if($event_start_date <= $this->input->post('end_date'))
                        {
                        $end_date = $this->input->post('end_date');
                        }
                        else
                        {
                        $end_date = $event_end_date;
                        }
                    }

                // $date = $this->displayDates($event_start_date, $end_date);
                $date = $this->displayDates($event_start_date, $event_end_date);
                $date_array = json_encode($date);
                // print_r($date_array);
                // die;

                $event_start_time  = date("H:i:s", strtotime($this->input->post('event_start_time')));
                $event_end_time  = date("H:i:s", strtotime($this->input->post('event_end_time')));

                $allDay = $this->input->post('event_allDay');
                if($allDay == 'on'){
                    $allDay = 'true';
                    $event_start_time  = '00:00:00';
                    $event_end_time  = '00:00:00';
                }else{
                    $allDay = 'false';
                    $event_start_date = $event_start_date.' '.$event_start_time;
                    $event_end_date = $event_end_date.' '.$event_end_time;
                }

                $de = $this->Front_model->getDraggableEventsCount($this->session->userdata('student_id'),$this->input->post('event_name'));
                if(($this->input->post('draggable_event') != "") && ($de <= 0)){
                    $data = array(  'student_id' => $this->session->userdata('student_id'),
                                    'event_name' => $this->input->post('event_name'),
                                    'event_color' => $this->input->post('event_color'),
                                    'event_note' => $this->input->post('event_note'),
                                    'event_start_date' => $sdd[0],
                                    'event_end_date' => $sdd[1],
                                    'event_start_time' => $event_start_time,
                                    'event_end_time' => $event_end_time,
                                    'event_repeat_option' => $this->input->post('event_repeat_option'),
                                    'event_allDay' => $allDay,
                                    'event_reminder' => $event_reminder,
                                    'show_draggable_event' => 1,
                                    'status' => 'active',
                                    'date' => date('Y-m-d H:i:s'),
                                    'event_repeat_option_type' => $this->input->post('event_repeat_option'),
                                 );
                    $data = $this->security->xss_clean($data); // xss filter
                    $this->Front_model->insertDraggableEvent($data);
                    $inserted_id = $this->db->insert_id();
                    $response['drag_id'] = $inserted_id;
                }else{
                    $response['drag_id'] = 'no_drag_id';
                }
                if($this->input->post('event_repeat_option') == 'Does not repeat'){
                    $data1[] = array( 'student_id' => $this->session->userdata('student_id'),
                                    'event_name' => $this->input->post('event_name'),
                                    'event_color' => $this->input->post('event_color'),
                                    'event_note' => $this->input->post('event_note'),
                                    'event_start_date' => $this->input->post('event_start_end_date_new'),
                                    'event_end_date' => $this->input->post('event_start_end_date_new'),
                                    'date_array' => $date_array,
                                    // 'end_date' => $end_date,
                                    'end_date' => $this->input->post('event_start_end_date_new'),
                                    'event_start_time' => $event_start_time,
                                    'event_end_time' => $event_end_time,
                                    // 'event_repeat_option' => $this->input->post('event_repeat_option'),
                                    'unique_key' => $unique_key,
                                    'event_repeat_option' => 'Does not repeat',
                                    'event_allDay' => $allDay,
                                    'event_reminder' => $event_reminder,
                                    'draggable_event' => $this->input->post('draggable_event'),
                                    'draggable_id' => $response['drag_id'],
                                    'type' => $this->input->post('type'),
                                    'status' => 'active',
                                    'event_repeat_option_type' => $this->input->post('event_repeat_option'),
                                    'date' => date('Y-m-d H:i:s')
                                );

                }else{
                    $data1[] = array( 'student_id' => $this->session->userdata('student_id'),
                                    'event_name' => $this->input->post('event_name'),
                                    'event_color' => $this->input->post('event_color'),
                                    'event_note' => $this->input->post('event_note'),
                                    'event_start_date' => $sdd[0],
                                    'event_end_date' => $sdd[1],
                                    'date_array' => $date_array,
                                    // 'end_date' => $end_date,
                                    'end_date' => $sdd[1],
                                    'event_start_time' => $event_start_time,
                                    'event_end_time' => $event_end_time,
                                    // 'event_repeat_option' => $this->input->post('event_repeat_option'),
                                    'unique_key' => $unique_key,
                                    'event_repeat_option' => 'Does not repeat',
                                    'event_allDay' => $allDay,
                                    'event_reminder' => $event_reminder,
                                    'draggable_event' => $this->input->post('draggable_event'),
                                    'draggable_id' => $response['drag_id'],
                                    'type' => $this->input->post('type'),
                                    'status' => 'active',
                                    'date' => date('Y-m-d H:i:s'),
                                    'event_repeat_option_type' => $this->input->post('event_repeat_option'),
                                );
                }
                
                if($this->input->post('event_repeat_option') == 'Every Weekday')
                    {
                    $start=$event_start_date;
                    $end=$event_end_date;
                    $format = 'Y-m-d';

                    // Declare an empty array
                    $array = array();
                      
                    // Variable that store the date interval
                    // of period 1 day
                    $interval = new DateInterval('P1D');
                  
                    $realEnd = new DateTime($end);
                    $realEnd->add($interval);

                    $period = new DatePeriod(new DateTime($start), $interval, $realEnd);
                  
                    // Use loop to store date into array
                    foreach($period as $date) {                 
                        $timestamp = strtotime($date->format($format));
                        $day = date('D', $timestamp);

                        $array[] = [$date->format($format),$day]; 
                    }
                  
                    // Return the array elements
                    $d_array=$array;
                    $weekday_date=[];
                    foreach($d_array as $d)
                        {
                        if($d[1]!='Sat' and $d[1]!='Sun')
                            {
                            $weekday_date[]=$d;  
                            }
                        }

                    $final=[];
                    $array_key=0;
                    foreach($weekday_date as $wd)
                        {
                        $final[$array_key][]=$wd[0];
                        if($wd[1]=='Fri'){$array_key++;}    
                        } 

                    $data1=[];    
                    foreach($final as $d)
                        {
                        $da = $this->displayDates($d[0], $d[array_key_last($d)]);
                        $date_array = json_encode($da);
                    
                        $data1[] = array( 'student_id' => $this->session->userdata('student_id'),
                                    'event_name' => $this->input->post('event_name'),
                                    'event_color' => $this->input->post('event_color'),
                                    'event_note' => $this->input->post('event_note'),
                                    'event_start_date' => $d[0],
                                    'event_end_date' => $d[array_key_last($d)],
                                    'date_array' => $date_array,
                                    'end_date' => $end_date,
                                    'event_start_time' => $event_start_time,
                                    'event_end_time' => $event_end_time,
                                    'event_repeat_option' => 'Does not repeat',
                                    'event_allDay' => $allDay,
                                    'event_reminder' => $event_reminder,
                                    'draggable_event' => $this->input->post('draggable_event'),
                                    'draggable_id' => $response['drag_id'],
                                    'unique_key' => $unique_key,
                                    'type' => $this->input->post('type'),
                                    'status' => 'active',
                                    'date' => date('Y-m-d H:i:s'),
                                    'event_repeat_option_type' => $this->input->post('event_repeat_option'),
                                 );
                        }

                    }
                    //////////custom store
                    if($this->input->post('event_repeat_option') == 'Custom')
                    {
                    $start=$event_start_date;
                    $end=$event_end_date;
                    $format = 'Y-m-d';

                    // Declare an empty array
                    $array = array();
                      
                    // Variable that store the date interval
                    // of period 1 day
                    $interval = new DateInterval('P1D');
                  
                    $realEnd = new DateTime($end);
                    $realEnd->add($interval);

                    $period = new DatePeriod(new DateTime($start), $interval, $realEnd);
                  
                    // Use loop to store date into array
                    foreach($period as $date) {                 
                        $timestamp = strtotime($date->format($format));
                        $day = date('D', $timestamp);

                        $array[] = [$date->format($format),$day]; 
                    }
                  
                    // Return the array elements
                    $d_array=$array;
                    $weekday_date=[];
                   
                    $custom_check_array = $this->input->post('custom_check');
                    $custom_all_day = implode(",",$custom_check_array);
                    foreach($d_array as $d)
                        {
                            foreach($custom_check_array as $custom_check_array_new){
                            if($d[1]==$custom_check_array_new)
                                {
                                $weekday_date[]=$d;  
                                }
                            }
                        }
                  // print_r ($weekday_date);
                    //die;   

                    $final=[];
                    $array_key=0;
                    foreach($weekday_date as $wd)
                        {
                        $final[$array_key][]=$wd[0];
                        if($wd[1]=='Fri'){$array_key++;}    
                        } 

                    $data1=[];    
                    foreach($weekday_date as $d)
                        {
                            
                            // $da = $this->displayDates($d[0], $d[array_key_last($d)]);
                            $da = $this->displayDates($d[0], $d[0]);
                            $date_array = json_encode($da);
                            // print_r($date_array);
                            // die;
                    
                            $data1[] = array( 'student_id' => $this->session->userdata('student_id'),
                                    'event_name' => $this->input->post('event_name'),
                                    'event_color' => $this->input->post('event_color'),
                                    'event_note' => $this->input->post('event_note'),
                                    'event_start_date' => $d[0],
                                    'event_end_date' => $d[0],
                                    'date_array' => $date_array,
                                    'end_date' => $d[0],
                                    'event_start_time' => $event_start_time,
                                    'event_end_time' => $event_end_time,
                                    'event_repeat_option' => 'Does not repeat',
                                    'event_allDay' => $allDay,
                                    'event_reminder' => $event_reminder,
                                    'draggable_event' => $this->input->post('draggable_event'),
                                    'draggable_id' => $response['drag_id'],
                                    'unique_key' => $unique_key,
                                    'type' => $this->input->post('type'),
                                    'status' => 'active',
                                    'date' => date('Y-m-d H:i:s'),
                                    'custom_all_day' => $custom_all_day,
                                    'event_repeat_option_type' => $this->input->post('event_repeat_option'),
                                 );
                        }

                    }
                    //////////Weekly  store
                    if($this->input->post('event_repeat_option') == 'Weekly')
                    {
                    $start=$event_start_date;
                    $end=$event_end_date;
                    $format = 'Y-m-d';

                    // Declare an empty array
                    $array = array();
                      
                    // Variable that store the date interval
                    // of period 1 day
                    $interval = new DateInterval('P1D');
                  
                    $realEnd = new DateTime($end);
                    $realEnd->add($interval);

                    $period = new DatePeriod(new DateTime($start), $interval, $realEnd);
                  
                    // Use loop to store date into array
                    foreach($period as $date) {                 
                        $timestamp = strtotime($date->format($format));
                        $day = date('D', $timestamp);

                        $array[] = [$date->format($format),$day]; 
                    }
                    $custom_date_weekly = $array[0][1];
                    
                    // Return the array elements
                    $d_array=$array;
                    $weekday_date=[];
                   
                    // foreach($d_array as $d)
                    //     {
                    //     if($d[1]='Sat')
                    //         {
                    //         $weekday_date[]=$d;  
                    //         }
                    //     }

                    //$custom_check_array = $this->input->post('custom_check');
                    $custom_check_array = array($custom_date_weekly);
                    // print_r($custom_check_array);
                    // die;
                  
                   foreach($d_array as $d)
                        {
                            foreach($custom_check_array as $custom_check_array_new){
                            if($d[1]==$custom_check_array_new)
                                {
                                $weekday_date[]=$d;  
                                }
                            }
                        }
                  // print_r ($weekday_date);
                    //die;   

                    $final=[];
                    $array_key=0;
                    foreach($weekday_date as $wd)
                        {
                        $final[$array_key][]=$wd[0];
                        if($wd[1]=='Fri'){$array_key++;}    
                        } 

                    $data1=[];    
                    foreach($weekday_date as $d)
                        {
                            
                            // $da = $this->displayDates($d[0], $d[array_key_last($d)]);
                            $da = $this->displayDates($d[0], $d[0]);
                            $date_array = json_encode($da);
                            // print_r($date_array);
                            // die;
                    
                            $data1[] = array( 'student_id' => $this->session->userdata('student_id'),
                                    'event_name' => $this->input->post('event_name'),
                                    'event_color' => $this->input->post('event_color'),
                                    'event_note' => $this->input->post('event_note'),
                                    'event_start_date' => $d[0],
                                    'event_end_date' => $d[0],
                                    'date_array' => $date_array,
                                    'end_date' => $d[0],
                                    'event_start_time' => $event_start_time,
                                    'event_end_time' => $event_end_time,
                                    'event_repeat_option' => 'Does not repeat',
                                    'event_allDay' => $allDay,
                                    'event_reminder' => $event_reminder,
                                    'draggable_event' => $this->input->post('draggable_event'),
                                    'draggable_id' => $response['drag_id'],
                                    'unique_key' => $unique_key,
                                    'type' => $this->input->post('type'),
                                    'status' => 'active',
                                    'date' => date('Y-m-d H:i:s'),
                                    'event_repeat_option_type' => $this->input->post('event_repeat_option'),
                                 );
                        }

                    }
                    //////////Monthly  store
                    if($this->input->post('event_repeat_option') == 'Monthly')
                    {
                    $start=$event_start_date;
                    $end=$event_end_date;
                    $format = 'Y-m-d';

                    // Declare an empty array
                    $array = array();
                      
                    // Variable that store the date interval
                    // of period 1 day
                    $interval = new DateInterval('P1D');
                  
                    $realEnd = new DateTime($end);
                    $realEnd->add($interval);

                    $period = new DatePeriod(new DateTime($start), $interval, $realEnd);
                  
                    // Use loop to store date into array
                    foreach($period as $date) {                 
                        $timestamp = strtotime($date->format($format));
                        $day = date('D', $timestamp);

                        $array[] = [$date->format($format),$day]; 
                    }
                    $custom_date_monthly = $array;
                    $first_date_get = $custom_date_monthly[0][0];
                    foreach($custom_date_monthly as $custom_date_monthly_new){
                        $new_date_get[] = $custom_date_monthly_new[0];
                    }
                    $i =0;
                    foreach($new_date_get as $new_date_get_new){
                        $newDate = date('Y-m-d', strtotime($first_date_get. ' + '.$i.' months'));
                        // print_r($new_date_get_new);
                        //     die;
                        if($newDate === $new_date_get_new){
                            $new_array_monthly_date[] = $newDate;
                            $i++;
                        }else{
                        }
                    }
                    $d_array=$array;
                    $weekday_date=[];
                   $custom_check_array = $new_array_monthly_date;
                   foreach($d_array as $d)
                        {
                            foreach($custom_check_array as $custom_check_array_new){
                            if($d[0]==$custom_check_array_new)
                                {
                                $weekday_date[]=$d;  
                                }
                            }
                        }
                    $final=[];
                    $array_key=0;
                    foreach($weekday_date as $wd)
                        {
                        $final[$array_key][]=$wd[0];
                        if($wd[1]=='Fri'){$array_key++;}    
                        } 

                    $data1=[];    
                    foreach($weekday_date as $d)
                        {
                            $da = $this->displayDates($d[0], $d[0]);
                            $date_array = json_encode($da);
                            $data1[] = array( 'student_id' => $this->session->userdata('student_id'),
                                    'event_name' => $this->input->post('event_name'),
                                    'event_color' => $this->input->post('event_color'),
                                    'event_note' => $this->input->post('event_note'),
                                    'event_start_date' => $d[0],
                                    'event_end_date' => $d[0],
                                    'date_array' => $date_array,
                                    'end_date' => $d[0],
                                    'event_start_time' => $event_start_time,
                                    'event_end_time' => $event_end_time,
                                    'event_repeat_option' => 'Does not repeat',
                                    'event_allDay' => $allDay,
                                    'event_reminder' => $event_reminder,
                                    'draggable_event' => $this->input->post('draggable_event'),
                                    'draggable_id' => $response['drag_id'],
                                    'unique_key' => $unique_key,
                                    'type' => $this->input->post('type'),
                                    'status' => 'active',
                                    'date' => date('Y-m-d H:i:s'),
                                    'event_repeat_option_type' => $this->input->post('event_repeat_option'),
                                 );
                        }

                    }
                    //////////Yearly  store
                    if($this->input->post('event_repeat_option') == 'Yearly')
                    {
                    $start=$event_start_date;
                    $end=$event_end_date;
                    $format = 'Y-m-d';

                    // Declare an empty array
                    $array = array();
                      
                    // Variable that store the date interval
                    // of period 1 day
                    $interval = new DateInterval('P1D');
                  
                    $realEnd = new DateTime($end);
                    $realEnd->add($interval);

                    $period = new DatePeriod(new DateTime($start), $interval, $realEnd);
                  
                    // Use loop to store date into array
                    foreach($period as $date) {                 
                        $timestamp = strtotime($date->format($format));
                        $day = date('D', $timestamp);

                        $array[] = [$date->format($format),$day]; 
                    }
                    $custom_date_monthly = $array;
                    $first_date_get = $custom_date_monthly[0][0];
                    foreach($custom_date_monthly as $custom_date_monthly_new){
                        $new_date_get[] = $custom_date_monthly_new[0];
                    }
                    $i =0;
                    foreach($new_date_get as $new_date_get_new){
                        $newDate = date('Y-m-d', strtotime($first_date_get. ' + '.$i.' year'));
                        // print_r($new_date_get_new);
                        //     die;
                        if($newDate === $new_date_get_new){
                            $new_array_monthly_date[] = $newDate;
                            $i++;
                        }else{
                        }
                    }
                    $d_array=$array;
                    $weekday_date=[];
                    //print_r($new_array_monthly_date);
                   $custom_check_array = $new_array_monthly_date;
                   foreach($d_array as $d)
                        {
                            foreach($custom_check_array as $custom_check_array_new){
                            if($d[0]==$custom_check_array_new)
                                {
                                $weekday_date[]=$d;  
                                }
                            }
                        }
                    $final=[];
                    $array_key=0;
                    foreach($weekday_date as $wd)
                        {
                        $final[$array_key][]=$wd[0];
                        if($wd[1]=='Fri'){$array_key++;}    
                        } 

                    $data1=[];    
                    foreach($weekday_date as $d)
                        {
                            $da = $this->displayDates($d[0], $d[0]);
                            $date_array = json_encode($da);
                            $data1[] = array( 'student_id' => $this->session->userdata('student_id'),
                                    'event_name' => $this->input->post('event_name'),
                                    'event_color' => $this->input->post('event_color'),
                                    'event_note' => $this->input->post('event_note'),
                                    'event_start_date' => $d[0],
                                    'event_end_date' => $d[0],
                                    'date_array' => $date_array,
                                    'end_date' => $d[0],
                                    'event_start_time' => $event_start_time,
                                    'event_end_time' => $event_end_time,
                                    'event_repeat_option' => 'Does not repeat',
                                    'event_allDay' => $allDay,
                                    'event_reminder' => $event_reminder,
                                    'draggable_event' => $this->input->post('draggable_event'),
                                    'draggable_id' => $response['drag_id'],
                                    'unique_key' => $unique_key,
                                    'type' => $this->input->post('type'),
                                    'status' => 'active',
                                    'date' => date('Y-m-d H:i:s'),
                                    'event_repeat_option_type' => $this->input->post('event_repeat_option'),
                                 );
                        }

                    }
                
                $data1 = $this->security->xss_clean($data1); // xss filter
                $this->db->insert_batch('events', $data1); 
                $inserted_id = 1;
                $response['event_id'] = $inserted_id;
            if($this->input->post('task_name') != ""){
              $task_start_date  = $this->input->post('task_start_date');
              $task_start_time  = date("H:i:s", strtotime($this->input->post('task_start_time')));

              $task_allDay = $this->input->post('task_allDay');
              if($task_allDay == 'on'){
                $task_allDay = 'true';
                $task_start_time  = '00:00:00';
              }else{
                $task_allDay = 'false';
              }

            $data = array( 'student_id' => $this->session->userdata('student_id'),
                         'event_id' => $inserted_id,
                         'task_name' => $this->input->post('task_name'),
                         'task_note' => $this->input->post('task_note'),
                         'task_start_date' => $this->input->post('task_start_date'),
                         'task_start_time' => $task_start_time,
                         'task_allDay' => $task_allDay,
                         'task_reminder' => $this->input->post('task_reminder'),
                         'task_category' => $this->input->post('task_category'),
                         'priority' => $this->input->post('priority'),
                         'status' => 'active',
                         'date' => date('Y-m-d H:i:s')
                      );
            $data = $this->security->xss_clean($data); // xss filter
            $this->Front_model->insertTask($data);
            $inserted_id = $this->db->insert_id();
            $response['task_id'] = $inserted_id;
            $response['task_allDay'] = $task_allDay;
        }
            $response['type'] = $type;
            $response['allDay'] = $allDay;              
            $response['start_date'] = $event_start_date;                
            $response['end_date'] = $event_end_date;                
            $response['event_start_date'] = $sdd[0];                
            $response['event_end_date'] = $sdd[1];              
            $response['event_note'] = $this->input->post('event_note');             
            $response['event_start_time'] = $event_start_time;              
            $response['event_end_time'] = $event_end_time;              
            $response['event_repeat_option'] = $this->input->post('event_repeat_option');
            $response['event_allDay'] = $allDay; 
            $response['event_reminder'] = $event_reminder;         
            $response['draggable_event'] = $this->input->post('draggable_event');       
            $response['draggable_id'] = $response['drag_id'];                   
            $response['status'] = TRUE;
            $response['event_repeat_option_type'] = $this->input->post('event_repeat_option');
            $this->session->set_flashdata('message', 'Successfully Created'); 
            header('Content-type: application/json');
            echo json_encode($response); 
        }
    }

    public function update_drag_event() //Update Draggable Event Details
    {
        $this->form_validation->set_rules('event_name','Event Name','trim|required');
        $this->form_validation->set_rules('event_color','Event Color','trim|required');
        
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
            $drag_id = $this->input->post('drag_id');
            $esdate = date('Y-m-d');
            $event_start_time  = date("H:i:s", strtotime($this->input->post('event_start_time')));
            $event_end_time  = date("H:i:s", strtotime($this->input->post('event_end_time')));

            $allDay = $this->input->post('event_allDay');
            if($allDay == 'on'){
                $allDay = 'true';
                $event_start_time  = '00:00:00';
                $event_end_time  = '00:00:00';
            }else{
                $allDay = 'false';
            }
            $data = array(  'event_name' => $this->input->post('event_name'),
                            'event_color' => $this->input->post('event_color'),
                            'event_note' => $this->input->post('event_note'),
                            'event_start_date' => $esdate,
                            'event_end_date' => $esdate,
                            'event_start_time' => $event_start_time,
                            'event_end_time' => $event_end_time,
                            'event_repeat_option' => $this->input->post('event_repeat_option'),
                            'event_allDay' => $allDay,
                            'event_reminder' => $this->input->post('event_reminder'),
                            'show_draggable_event' => 1,
                         );
            $data = $this->security->xss_clean($data); // xss filter
            $this->Front_model->updateDraggableEvent($data,$drag_id);                   
            $response['drag_id'] = $drag_id;            
            $this->session->set_flashdata('message', 'Successfully Updated');           
            $response['status'] = TRUE;
            header('Content-type: application/json');
            echo json_encode($response); 
        }
    }
    public function update_event_form() //Update Event Details
    {
        try {
            $delete_check = 1;
            $this->Front_model->deleteEvent($this->input->post('event_id'),$delete_check);
            $this->insert_draggable_event();
          }
          
          //catch exception
          catch(Exception $e) {
            $this->session->set_flashdata('message', 'Something went wrong'); 
          }
        // $delete_check = 1;
        // $this->Front_model->deleteEvent($this->input->post('event_id'),$delete_check);
        // $this->insert_draggable_event();
    }

    // public function update_event_form() //Update Event Details
    // {
    //     if($this->input->post('event_repeat_option') == 'Every Weekday'){
    //         $this->Front_model->deleteEvent($this->input->post('event_id'));
    //         if($this->input->post('event_allDay') == 'on'){
    //             $event_reminder = $this->input->post('event_reminder_new');
    //         }else{
    //             $event_reminder = $this->input->post('event_reminder') ;
    //         }
            
    //         $unique_key = uniqid();
    //         $this->form_validation->set_rules('event_name','Event Name','trim|required');
    //         $this->form_validation->set_rules('event_color','Event Color','trim|required');
            
    //         if ($this->form_validation->run() == FALSE)
    //         {
    //             //$errors = array();
    
    //             $errors = $this->form_validation->error_array();
    //             // Loop through $_POST and get the keys
    //             foreach ($errors as $key => $value)
    //             {
    //               // Add the error message for this field
    //               $errors[$key] = form_error($key);
    //             }
              
    //             $response['errors'] = array_filter($errors); // Some might be empty
    //             $response['status'] = FALSE;
    //             // You can use the Output class here too
    //             header('Content-type: application/json');
    //             //echo json_encode($response);
    //             exit(json_encode($response));
    //         }
    //         else
    //         {
    //             $type = $this->input->post('type');         
    //                 $event_start_end_date = $this->input->post('event_start_end_date');
    //                 $sdd = explode(' - ',$event_start_end_date);
    //                 $event_start_date = $sdd[0];
    //                 $event_end_date = $sdd[1];
    //                 if($this->input->post('event_repeat_option') == 'Does not repeat') 
    //                     {
    //                     $end_date = $event_end_date;
    //                     }
    //                     else
    //                     {

    //                     if($event_start_date <= $this->input->post('end_date'))
    //                         {
    //                         $end_date = $this->input->post('end_date');
    //                         }
    //                         else
    //                         {
    //                         $end_date = $event_end_date;
    //                         }
    //                     }
    
                    
    //                 $date = $this->displayDates($event_start_date, $end_date);
    //                 $date_array = json_encode($date);
    
    //                 $event_start_time  = date("H:i:s", strtotime($this->input->post('event_start_time')));
    //                 $event_end_time  = date("H:i:s", strtotime($this->input->post('event_end_time')));
    
    //                 $allDay = $this->input->post('event_allDay');
    //                 if($allDay == 'on'){
    //                     $allDay = 'true';
    //                     $event_start_time  = '00:00:00';
    //                     $event_end_time  = '00:00:00';
    //                 }else{
    //                     $allDay = 'false';
    //                     $event_start_date = $event_start_date.' '.$event_start_time;
    //                     $event_end_date = $event_end_date.' '.$event_end_time;
    //                 }
    
    //                 $de = $this->Front_model->getDraggableEventsCount($this->session->userdata('student_id'),$this->input->post('event_name'));
    //                 if(($this->input->post('draggable_event') != "") && ($de <= 0)){
    //                     $data = array(  'student_id' => $this->session->userdata('student_id'),
    //                                     'event_name' => $this->input->post('event_name'),
    //                                     'event_color' => $this->input->post('event_color'),
    //                                     'event_note' => $this->input->post('event_note'),
    //                                     'event_start_date' => $sdd[0],
    //                                     'event_end_date' => $sdd[1],
    //                                     'event_start_time' => $event_start_time,
    //                                     'event_end_time' => $event_end_time,
    //                                     'event_repeat_option' => $this->input->post('event_repeat_option'),
    //                                     'event_allDay' => $allDay,
    //                                     'event_reminder' => $event_reminder,
    //                                     'show_draggable_event' => 1,
    //                                     'status' => 'active',
    //                                     'date' => date('Y-m-d H:i:s'),
    //                                     'event_repeat_option_type' =>'0',
    //                                  );
    //                     $data = $this->security->xss_clean($data); // xss filter
    //                     $this->Front_model->insertDraggableEvent($data);
    //                     $inserted_id = $this->db->insert_id();
    //                     $response['drag_id'] = $inserted_id;
    //                 }else{
    //                     $response['drag_id'] = 'no_drag_id';
    //                 }
    
    //                 $data1[] = array( 'student_id' => $this->session->userdata('student_id'),
    //                                     'event_name' => $this->input->post('event_name'),
    //                                     'event_color' => $this->input->post('event_color'),
    //                                     'event_note' => $this->input->post('event_note'),
    //                                     'event_start_date' => $sdd[0],
    //                                     'event_end_date' => $sdd[1],
    //                                     'date_array' => $date_array,
    //                                     // 'end_date' => $end_date,
    //                                     'end_date' => $sdd[1],
    //                                     'event_start_time' => $event_start_time,
    //                                     'event_end_time' => $event_end_time,
    //                                     // 'event_repeat_option' => $this->input->post('event_repeat_option'),
    //                                     'unique_key' => $unique_key,
    //                                     'event_repeat_option' => 'Does not repeat',
    //                                     'event_allDay' => $allDay,
    //                                     'event_reminder' => $event_reminder,
    //                                     'draggable_event' => $this->input->post('draggable_event'),
    //                                     'draggable_id' => $response['drag_id'],
    //                                     'type' => $this->input->post('type'),
    //                                     'status' => 'active',
    //                                     'date' => date('Y-m-d H:i:s'),
    //                                     'event_repeat_option_type' =>'0',
    //                                  );
    
    
    //                 if($this->input->post('event_repeat_option') == 'Every Weekday')
    //                     {
    //                     $start=$event_start_date;
    //                     $end=$event_end_date;
    //                     $format = 'Y-m-d';
    
    //                     // Declare an empty array
    //                     $array = array();
                          
    //                     // Variable that store the date interval
    //                     // of period 1 day
    //                     $interval = new DateInterval('P1D');
                      
    //                     $realEnd = new DateTime($end);
    //                     $realEnd->add($interval);
    
    //                     $period = new DatePeriod(new DateTime($start), $interval, $realEnd);
                      
    //                     // Use loop to store date into array
    //                     foreach($period as $date) {                 
    //                         $timestamp = strtotime($date->format($format));
    //                         $day = date('D', $timestamp);
    
    //                         $array[] = [$date->format($format),$day]; 
    //                     }
                      
    //                     // Return the array elements
    //                     $d_array=$array;
    //                     $weekday_date=[];
    //                     foreach($d_array as $d)
    //                         {
    //                         if($d[1]!='Sat' and $d[1]!='Sun')
    //                             {
    //                             $weekday_date[]=$d;  
    //                             }
    //                         }
    
    //                     $final=[];
    //                     $array_key=0;
    //                     foreach($weekday_date as $wd)
    //                         {
    //                         $final[$array_key][]=$wd[0];
    //                         if($wd[1]=='Fri'){$array_key++;}    
    //                         } 
    
    //                     $data1=[];    
    //                     foreach($final as $d)
    //                         {
    //                         $da = $this->displayDates($d[0], $d[array_key_last($d)]);
    //                         $date_array = json_encode($da);
                        
    //                         $data1[] = array( 'student_id' => $this->session->userdata('student_id'),
    //                                     'event_name' => $this->input->post('event_name'),
    //                                     'event_color' => $this->input->post('event_color'),
    //                                     'event_note' => $this->input->post('event_note'),
    //                                     'event_start_date' => $d[0],
    //                                     'event_end_date' => $d[array_key_last($d)],
    //                                     'date_array' => $date_array,
    //                                     'end_date' => $end_date,
    //                                     'event_start_time' => $event_start_time,
    //                                     'event_end_time' => $event_end_time,
    //                                     'event_repeat_option' => 'Does not repeat',
    //                                     'event_allDay' => $allDay,
    //                                     'event_reminder' => $event_reminder,
    //                                     'draggable_event' => $this->input->post('draggable_event'),
    //                                     'draggable_id' => $response['drag_id'],
    //                                     'unique_key' => $unique_key,
    //                                     'type' => $this->input->post('type'),
    //                                     'status' => 'active',
    //                                     'date' => date('Y-m-d H:i:s'),
    //                                     'event_repeat_option_type' =>'0',
    //                                  );
    //                         }
    
    //                     }
                    
    //                 $data1 = $this->security->xss_clean($data1); // xss filter
    //                 $this->db->insert_batch('events', $data1); 
    //                 $inserted_id = 1;
    //                 $response['event_id'] = $inserted_id;
    //             if($this->input->post('task_name') != ""){
    //               $task_start_date  = $this->input->post('task_start_date');
    //               $task_start_time  = date("H:i:s", strtotime($this->input->post('task_start_time')));
    
    //               $task_allDay = $this->input->post('task_allDay');
    //               if($task_allDay == 'on'){
    //                 $task_allDay = 'true';
    //                 $task_start_time  = '00:00:00';
    //               }else{
    //                 $task_allDay = 'false';
    //               }
    
    //             $data = array( 'student_id' => $this->session->userdata('student_id'),
    //                          'event_id' => $inserted_id,
    //                          'task_name' => $this->input->post('task_name'),
    //                          'task_note' => $this->input->post('task_note'),
    //                          'task_start_date' => $this->input->post('task_start_date'),
    //                          'task_start_time' => $task_start_time,
    //                          'task_allDay' => $task_allDay,
    //                          'task_reminder' => $this->input->post('task_reminder'),
    //                          'task_category' => $this->input->post('task_category'),
    //                          'priority' => $this->input->post('priority'),
    //                          'status' => 'active',
    //                          'date' => date('Y-m-d H:i:s'),
    //                          'event_repeat_option_type' =>'0',
    //                       );
    //             $data = $this->security->xss_clean($data); // xss filter
    //             $this->Front_model->insertTask($data);
    //             $inserted_id = $this->db->insert_id();
    //             $response['task_id'] = $inserted_id;
    //             $response['task_allDay'] = $task_allDay;
    //         }
    //             $response['type'] = $type;
    //             $response['allDay'] = $allDay;              
    //             $response['start_date'] = $event_start_date;                
    //             $response['end_date'] = $event_end_date;                
    //             $response['event_start_date'] = $sdd[0];                
    //             $response['event_end_date'] = $sdd[1];              
    //             $response['event_note'] = $this->input->post('event_note');             
    //             $response['event_start_time'] = $event_start_time;              
    //             $response['event_end_time'] = $event_end_time;              
    //             $response['event_repeat_option'] = $this->input->post('event_repeat_option');
    //             $response['event_allDay'] = $allDay; 
    //             $response['event_reminder'] = $event_reminder;         
    //             $response['draggable_event'] = $this->input->post('draggable_event');       
    //             $response['draggable_id'] = $response['drag_id'];                   
    //             $response['status'] = TRUE;
    //             $this->session->set_flashdata('message', 'Successfully Created'); 
    //             header('Content-type: application/json');
    //             echo json_encode($response); 
    //         }
    //     }elseif($this->input->post('event_repeat_option') == 'Custom'){
    //         $this->Front_model->deleteEvent($this->input->post('event_id'));
    //         if($this->input->post('event_allDay') == 'on'){
    //             $event_reminder = $this->input->post('event_reminder_new');
    //         }else{
    //             $event_reminder = $this->input->post('event_reminder') ;
    //         }
            
    //         $unique_key = uniqid();
    //         $this->form_validation->set_rules('event_name','Event Name','trim|required');
    //         $this->form_validation->set_rules('event_color','Event Color','trim|required');
            
    //         if ($this->form_validation->run() == FALSE)
    //         {
    //             //$errors = array();
            
    //             $errors = $this->form_validation->error_array();
    //             // Loop through $_POST and get the keys
    //             foreach ($errors as $key => $value)
    //             {
    //               // Add the error message for this field
    //               $errors[$key] = form_error($key);
    //             }
              
    //             $response['errors'] = array_filter($errors); // Some might be empty
    //             $response['status'] = FALSE;
    //             // You can use the Output class here too
    //             header('Content-type: application/json');
    //             //echo json_encode($response);
    //             exit(json_encode($response));
    //         }
    //         else
    //         {
    //             $type = $this->input->post('type');         
    //                 $event_start_end_date = $this->input->post('event_start_end_date');
    //                 $sdd = explode(' - ',$event_start_end_date);
    //                 $event_start_date = $sdd[0];
    //                 $event_end_date = $sdd[1];
    //                 if($this->input->post('event_repeat_option') == 'Does not repeat') 
    //                     {
    //                     $end_date = $event_end_date;
    //                     }
    //                     else
    //                     {
    //                     if($event_start_date <= $this->input->post('end_date'))
    //                         {
    //                         $end_date = $this->input->post('end_date');
    //                         }
    //                         else
    //                         {
    //                         $end_date = $event_end_date;
    //                         }
    //                     }
            
                    
    //                 $date = $this->displayDates($event_start_date, $end_date);
    //                 $date_array = json_encode($date);
            
    //                 $event_start_time  = date("H:i:s", strtotime($this->input->post('event_start_time')));
    //                 $event_end_time  = date("H:i:s", strtotime($this->input->post('event_end_time')));
            
    //                 $allDay = $this->input->post('event_allDay');
    //                 if($allDay == 'on'){
    //                     $allDay = 'true';
    //                     $event_start_time  = '00:00:00';
    //                     $event_end_time  = '00:00:00';
    //                 }else{
    //                     $allDay = 'false';
    //                     $event_start_date = $event_start_date.' '.$event_start_time;
    //                     $event_end_date = $event_end_date.' '.$event_end_time;
    //                 }
            
    //                 $de = $this->Front_model->getDraggableEventsCount($this->session->userdata('student_id'),$this->input->post('event_name'));
    //                 if(($this->input->post('draggable_event') != "") && ($de <= 0)){
    //                     $data = array(  'student_id' => $this->session->userdata('student_id'),
    //                                     'event_name' => $this->input->post('event_name'),
    //                                     'event_color' => $this->input->post('event_color'),
    //                                     'event_note' => $this->input->post('event_note'),
    //                                     'event_start_date' => $sdd[0],
    //                                     'event_end_date' => $sdd[1],
    //                                     'event_start_time' => $event_start_time,
    //                                     'event_end_time' => $event_end_time,
    //                                     'event_repeat_option' => $this->input->post('event_repeat_option'),
    //                                     'event_allDay' => $allDay,
    //                                     'event_reminder' => $event_reminder,
    //                                     'show_draggable_event' => 1,
    //                                     'status' => 'active',
    //                                     'date' => date('Y-m-d H:i:s'),
    //                                     'event_repeat_option_type' =>'0',
    //                                  );
    //                     $data = $this->security->xss_clean($data); // xss filter
    //                     $this->Front_model->insertDraggableEvent($data);
    //                     $inserted_id = $this->db->insert_id();
    //                     $response['drag_id'] = $inserted_id;
    //                 }else{
    //                     $response['drag_id'] = 'no_drag_id';
    //                 }
            
    //                 $data1[] = array( 'student_id' => $this->session->userdata('student_id'),
    //                                     'event_name' => $this->input->post('event_name'),
    //                                     'event_color' => $this->input->post('event_color'),
    //                                     'event_note' => $this->input->post('event_note'),
    //                                     'event_start_date' => $sdd[0],
    //                                     'event_end_date' => $sdd[1],
    //                                     'date_array' => $date_array,
    //                                     // 'end_date' => $end_date,
    //                                     'end_date' => $sdd[1],
    //                                     'event_start_time' => $event_start_time,
    //                                     'event_end_time' => $event_end_time,
    //                                     // 'event_repeat_option' => $this->input->post('event_repeat_option'),
    //                                     'unique_key' => $unique_key,
    //                                     'event_repeat_option' => 'Does not repeat',
    //                                     'event_allDay' => $allDay,
    //                                     'event_reminder' => $event_reminder,
    //                                     'draggable_event' => $this->input->post('draggable_event'),
    //                                     'draggable_id' => $response['drag_id'],
    //                                     'type' => $this->input->post('type'),
    //                                     'status' => 'active',
    //                                     'date' => date('Y-m-d H:i:s'),
    //                                     'event_repeat_option_type' =>'0',
    //                                  );
            
            
    //                 if($this->input->post('event_repeat_option') == 'Every Weekday')
    //                     {
    //                     $start=$event_start_date;
    //                     $end=$event_end_date;
    //                     $format = 'Y-m-d';
            
    //                     // Declare an empty array
    //                     $array = array();
                          
    //                     // Variable that store the date interval
    //                     // of period 1 day
    //                     $interval = new DateInterval('P1D');
                      
    //                     $realEnd = new DateTime($end);
    //                     $realEnd->add($interval);
            
    //                     $period = new DatePeriod(new DateTime($start), $interval, $realEnd);
                      
    //                     // Use loop to store date into array
    //                     foreach($period as $date) {                 
    //                         $timestamp = strtotime($date->format($format));
    //                         $day = date('D', $timestamp);
            
    //                         $array[] = [$date->format($format),$day]; 
    //                     }
                      
    //                     // Return the array elements
    //                     $d_array=$array;
    //                     $weekday_date=[];
    //                     foreach($d_array as $d)
    //                         {
    //                         if($d[1]!='Sat' and $d[1]!='Sun')
    //                             {
    //                             $weekday_date[]=$d;  
    //                             }
    //                         }
            
    //                     $final=[];
    //                     $array_key=0;
    //                     foreach($weekday_date as $wd)
    //                         {
    //                         $final[$array_key][]=$wd[0];
    //                         if($wd[1]=='Fri'){$array_key++;}    
    //                         } 
            
    //                     $data1=[];    
    //                     foreach($final as $d)
    //                         {
    //                         $da = $this->displayDates($d[0], $d[array_key_last($d)]);
    //                         $date_array = json_encode($da);
                        
    //                         $data1[] = array( 'student_id' => $this->session->userdata('student_id'),
    //                                     'event_name' => $this->input->post('event_name'),
    //                                     'event_color' => $this->input->post('event_color'),
    //                                     'event_note' => $this->input->post('event_note'),
    //                                     'event_start_date' => $d[0],
    //                                     'event_end_date' => $d[array_key_last($d)],
    //                                     'date_array' => $date_array,
    //                                     'end_date' => $end_date,
    //                                     'event_start_time' => $event_start_time,
    //                                     'event_end_time' => $event_end_time,
    //                                     'event_repeat_option' => 'Does not repeat',
    //                                     'event_allDay' => $allDay,
    //                                     'event_reminder' => $event_reminder,
    //                                     'draggable_event' => $this->input->post('draggable_event'),
    //                                     'draggable_id' => $response['drag_id'],
    //                                     'unique_key' => $unique_key,
    //                                     'type' => $this->input->post('type'),
    //                                     'status' => 'active',
    //                                     'date' => date('Y-m-d H:i:s'),
    //                                     'event_repeat_option_type' =>'0',
    //                                  );
    //                         }
            
    //                     }
    //                     //////////custom store
    //                     if($this->input->post('event_repeat_option') == 'Custom')
    //                     {
                        
    //                     $start=$event_start_date;
    //                     $end=$event_end_date;
    //                     $format = 'Y-m-d';
            
    //                     // Declare an empty array
    //                     $array = array();
                          
    //                     // Variable that store the date interval
    //                     // of period 1 day
    //                     $interval = new DateInterval('P1D');
                      
    //                     $realEnd = new DateTime($end);
    //                     $realEnd->add($interval);
            
    //                     $period = new DatePeriod(new DateTime($start), $interval, $realEnd);
                      
    //                     // Use loop to store date into array
    //                     foreach($period as $date) {                 
    //                         $timestamp = strtotime($date->format($format));
    //                         $day = date('D', $timestamp);
            
    //                         $array[] = [$date->format($format),$day]; 
    //                     }
                      
    //                     // Return the array elements
    //                     $d_array=$array;
    //                     $weekday_date=[];
                       
    //                     // foreach($d_array as $d)
    //                     //     {
    //                     //     if($d[1]='Sat')
    //                     //         {
    //                     //         $weekday_date[]=$d;  
    //                     //         }
    //                     //     }
    //                     $custom_check_array = $this->input->post('custom_check_update');
    //                   // print_r ($custom_check_array[0]);
    //                 //    foreach($custom_check_array as $custom_check_array_new){
    //                 //     echo $custom_check_array_new;
    //                 //    }
    //                    foreach($d_array as $d)
    //                         {
    //                             foreach($custom_check_array as $custom_check_array_new){
    //                             if($d[1]==$custom_check_array_new)
    //                                 {
    //                                 $weekday_date[]=$d;  
    //                                 }
    //                             }
    //                         }
    //                   // print_r ($weekday_date);
    //                     //die;   
            
    //                     $final=[];
    //                     $array_key=0;
    //                     foreach($weekday_date as $wd)
    //                         {
    //                         $final[$array_key][]=$wd[0];
    //                         if($wd[1]=='Fri'){$array_key++;}    
    //                         } 
            
    //                     $data1=[];    
    //                     foreach($weekday_date as $d)
    //                         {
    //                             // $da = $this->displayDates($d[0], $d[array_key_last($d)]);
    //                             $da = $this->displayDates($d[0], $d[0]);
    //                             $date_array = json_encode($da);
                        
    //                             $data1[] = array( 'student_id' => $this->session->userdata('student_id'),
    //                                     'event_name' => $this->input->post('event_name'),
    //                                     'event_color' => $this->input->post('event_color'),
    //                                     'event_note' => $this->input->post('event_note'),
    //                                     'event_start_date' => $d[0],
    //                                     'event_end_date' => $d[0],
    //                                     'date_array' => $date_array,
    //                                     'end_date' => $d[0],
    //                                     'event_start_time' => $event_start_time,
    //                                     'event_end_time' => $event_end_time,
    //                                     'event_repeat_option' => 'Does not repeat',
    //                                     'event_allDay' => $allDay,
    //                                     'event_reminder' => $event_reminder,
    //                                     'draggable_event' => $this->input->post('draggable_event'),
    //                                     'draggable_id' => $response['drag_id'],
    //                                     'unique_key' => $unique_key,
    //                                     'type' => $this->input->post('type'),
    //                                     'status' => 'active',
    //                                     'date' => date('Y-m-d H:i:s'),
    //                                     'event_repeat_option_type' =>'0',
    //                                  );
    //                         }
            
    //                     }
                    
    //                 $data1 = $this->security->xss_clean($data1); // xss filter
    //                 $this->db->insert_batch('events', $data1); 
    //                 $inserted_id = 1;
    //                 $response['event_id'] = $inserted_id;
    //             if($this->input->post('task_name') != ""){
    //               $task_start_date  = $this->input->post('task_start_date');
    //               $task_start_time  = date("H:i:s", strtotime($this->input->post('task_start_time')));
            
    //               $task_allDay = $this->input->post('task_allDay');
    //               if($task_allDay == 'on'){
    //                 $task_allDay = 'true';
    //                 $task_start_time  = '00:00:00';
    //               }else{
    //                 $task_allDay = 'false';
    //               }
            
    //             $data = array( 'student_id' => $this->session->userdata('student_id'),
    //                          'event_id' => $inserted_id,
    //                          'task_name' => $this->input->post('task_name'),
    //                          'task_note' => $this->input->post('task_note'),
    //                          'task_start_date' => $this->input->post('task_start_date'),
    //                          'task_start_time' => $task_start_time,
    //                          'task_allDay' => $task_allDay,
    //                          'task_reminder' => $this->input->post('task_reminder'),
    //                          'task_category' => $this->input->post('task_category'),
    //                          'priority' => $this->input->post('priority'),
    //                          'status' => 'active',
    //                          'date' => date('Y-m-d H:i:s')
    //                       );
    //             $data = $this->security->xss_clean($data); // xss filter
    //             $this->Front_model->insertTask($data);
    //             $inserted_id = $this->db->insert_id();
    //             $response['task_id'] = $inserted_id;
    //             $response['task_allDay'] = $task_allDay;
    //         }
    //             $response['type'] = $type;
    //             $response['allDay'] = $allDay;              
    //             $response['start_date'] = $event_start_date;                
    //             $response['end_date'] = $event_end_date;                
    //             $response['event_start_date'] = $sdd[0];                
    //             $response['event_end_date'] = $sdd[1];              
    //             $response['event_note'] = $this->input->post('event_note');             
    //             $response['event_start_time'] = $event_start_time;              
    //             $response['event_end_time'] = $event_end_time;              
    //             $response['event_repeat_option'] = $this->input->post('event_repeat_option');
    //             $response['event_allDay'] = $allDay; 
    //             $response['event_reminder'] = $event_reminder;         
    //             $response['draggable_event'] = $this->input->post('draggable_event');       
    //             $response['draggable_id'] = $response['drag_id'];                   
    //             $response['status'] = TRUE;
    //             $this->session->set_flashdata('message', 'Successfully Updated Events'); 
    //             header('Content-type: application/json');
    //             echo json_encode($response); 
    //         }
            
    //     }
    //     else{
        
    //         if($this->input->post('event_allDay') == 'on'){
    //             $event_reminder = $this->input->post('event_reminder_new');
    //         }else{
    //             $event_reminder = $this->input->post('event_reminder') ;
    //         }
            
    //         $this->form_validation->set_rules('event_name','Event Name','trim|required');
    //         $this->form_validation->set_rules('event_color','Event Color','trim|required');
            
    //         if ($this->form_validation->run() == FALSE)
    //         {
    //             //$errors = array();

    //             $errors = $this->form_validation->error_array();
    //             // Loop through $_POST and get the keys
    //             foreach ($errors as $key => $value)
    //             {
    //             // Add the error message for this field
    //             $errors[$key] = form_error($key);
    //             }
            
    //             $response['errors'] = array_filter($errors); // Some might be empty
    //             $response['status'] = FALSE;
    //             // You can use the Output class here too
    //             header('Content-type: application/json');
    //             //echo json_encode($response);
    //             exit(json_encode($response));
    //         }elseif($this->input->post('event_repeat_option') == 'Does not repeat'){
    //             //  print_r($this->input->post());
    //             //  die;
    //             $type = $this->input->post('type');
    //             $event_start_end_date = $this->input->post('event_start_end_date_new');
    //             $sdd = explode(' - ',$event_start_end_date);
    //             $event_start_date = $this->input->post('event_start_end_date_new');
    //             $event_end_date = $this->input->post('event_start_end_date_new');

    //             if($this->input->post('event_repeat_option') == 'Does not repeat'){
    //                 $end_date = $event_end_date;
    //             }else{
    //                 if($event_start_date <= $this->input->post('end_date')){
    //                     $end_date = $this->input->post('event_start_end_date_new');
    //                 }else{
    //                 $end_date = $event_end_date;
    //                 }
    //             }

    //             function displayDates($date1, $date2, $format = 'Y-m' ) {
    //             $dates = array();
    //             $date1  = date("Y-m", strtotime($date1));
    //             $date2  = date("Y-m", strtotime($date2));
    //             $current = strtotime($date1);
    //             $date2 = strtotime($date2);
    //             $stepVal = '+1 months';
    //             while( $current <= $date2 ) {
    //                 $dates[] = date($format, $current);
    //                 $current = strtotime($stepVal, $current);
    //             }
    //             return $dates;
    //             }
    //             $date = displayDates($event_start_date, $end_date);

    //             $date_array = json_encode($date);

    //             $event_start_time  = date("H:i:s", strtotime($this->input->post('event_start_time')));
    //             $event_end_time  = date("H:i:s", strtotime($this->input->post('event_end_time')));

    //             $allDay = $this->input->post('event_allDay');
    //             if($allDay == 'on'){
    //                 $allDay = 'true';
    //                 $event_start_time  = '00:00:00';
    //                 $event_end_time  = '00:00:00';
    //             }else{
    //                 $allDay = 'false';
    //                 $event_start_date = $event_start_date.' '.$event_start_time;
    //                 $event_end_date = $event_end_date.' '.$event_end_time;
    //             }

    //             $draggable_id = $this->input->post('draggable_id');

    //             $de = $this->Front_model->getDraggableEventsCount($this->session->userdata('student_id'),$this->input->post('event_name'));
    //             if(($this->input->post('draggable_event') != "") && ($de <= 0)){
    //                 $data = array(  'student_id' => $this->session->userdata('student_id'),
    //                                 'event_name' => $this->input->post('event_name'),
    //                                 'event_color' => $this->input->post('event_color'),
    //                                 'event_note' => $this->input->post('event_note'),
    //                                 'event_start_date' =>$this->input->post('event_start_end_date_new'),
    //                                 'event_end_date' => $this->input->post('event_start_end_date_new'),
    //                                 'date_array' => $date_array,
    //                                 'end_date' => $this->input->post('event_start_end_date_new'),
    //                                 'event_start_time' => $event_start_time,
    //                                 'event_end_time' => $event_end_time,
    //                                 'event_repeat_option' => 'Does not repeat',
    //                                 'event_allDay' => $allDay,
    //                                 'event_reminder' => $event_reminder,
    //                                 'show_draggable_event' => 1,
    //                                 'status' => 'active',
    //                                 'date' => date('Y-m-d H:i:s'),
    //                                 'event_repeat_option_type' =>'1',
    //                             );
    //                 $data = $this->security->xss_clean($data); // xss filter
    //                 $this->Front_model->insertDraggableEvent($data);
    //                 $inserted_id = $this->db->insert_id();
    //                 $draggable_id = $inserted_id;
    //                 $response['drag_id'] = $inserted_id;
    //             }else if($this->input->post('draggable_event') == ""){
    //                 $drag_id = $this->input->post('draggable_id');
    //                 $this->Front_model->deleteDraggableEvent($drag_id);
    //                 $response['drag_id'] = 'no_drag_id';
    //             }else{
    //                 $response['drag_id'] = $this->input->post('draggable_id');
    //             }               
    //             $data1 = array( 'student_id' => $this->session->userdata('student_id'),
    //                             'event_name' => $this->input->post('event_name'),
    //                             'event_color' => $this->input->post('event_color'),
    //                             'event_note' => $this->input->post('event_note'),
    //                             'event_start_date' =>$this->input->post('event_start_end_date_new'),
    //                             'event_end_date' => $this->input->post('event_start_end_date_new'),
    //                             'event_start_time' => $event_start_time,
    //                             'event_end_time' => $event_end_time,
    //                             'event_repeat_option' => 'Does not repeat',
    //                             'event_allDay' => $allDay,
    //                             'event_reminder' => $event_reminder,
    //                             'draggable_event' => $this->input->post('draggable_event'),
    //                             'draggable_id' => $draggable_id,
    //                             'type' => $this->input->post('type'),
    //                             'event_repeat_option_type' =>'1',
    //                         );

    //             $event_id = $this->input->post('event_id');
    //                 $data1 = $this->security->xss_clean($data1); // xss filter
    //                 $this->Front_model->updateEvent($data1,$event_id);
    //         if($this->input->post('task_name') != ""){
    //         $task_start_date  = $this->input->post('task_start_date');
    //         $task_start_time  = date("H:i:s", strtotime($this->input->post('task_start_time')));

    //         $task_allDay = $this->input->post('task_allDay');
    //         if($task_allDay == 'on'){
    //             $task_allDay = 'true';
    //             $task_start_time  = '00:00:00';
    //         }else{
    //             $task_allDay = 'false';
    //         }

    //         $data = array( 'student_id' => $this->session->userdata('student_id'),
    //                         'event_id' => $this->input->post('event_id'),
    //                         'task_name' => $this->input->post('task_name'),
    //                         'task_note' => $this->input->post('task_note'),
    //                         'task_start_date' => $this->input->post('task_start_date'),
    //                         'task_start_time' => $task_start_time,
    //                         'task_allDay' => $task_allDay,
    //                         'task_reminder' => $this->input->post('task_reminder'),
    //                         'task_category' => $this->input->post('task_category'),
    //                         'priority' => $this->input->post('priority'),
    //                         'status' => 'active',
    //                         'date' => date('Y-m-d H:i:s')
    //                     );
    //         $data = $this->security->xss_clean($data); // xss filter
    //         $this->Front_model->insertTask($data);
    //         $inserted_id = $this->db->insert_id();
    //         $response['task_id'] = $inserted_id;
    //         $response['task_allDay'] = $task_allDay;
    //         }
    //                 $response['event_id'] = $event_id;
    //                 $response['allDay'] = $allDay;              
    //                 $response['start_date'] = $event_start_date;                
    //                 $response['end_date'] = $event_end_date;                
    //                 $response['event_start_date'] = $this->input->post('event_start_end_date_new');                
    //                 $response['event_end_date'] = $this->input->post('event_start_end_date_new');              
    //                 $response['event_note'] = $this->input->post('event_note');             
    //                 $response['event_start_time'] = $this->input->post('event_start_end_date_new');              
    //                 $response['event_end_time'] = $this->input->post('event_start_end_date_new');              
    //                 $response['event_repeat_option'] = 'Does not repeat';
    //                 $response['event_allDay'] = $allDay;                
    //                 $response['event_reminder'] = $event_reminder;
    //                 $response['type'] = $this->input->post('type'); 
    //                 $response['draggable_event'] = $this->input->post('draggable_event');       
    //                 $response['draggable_id'] = $draggable_id;      
    //             $response['status'] = TRUE;        
    //         $this->session->set_flashdata('message', 'Successfully Updated'); 
    //             header('Content-type: application/json');
    //             echo json_encode($response); 

    //         }
    //         else
    //         {
    //             $type = $this->input->post('type');
    //             $event_start_end_date = $this->input->post('event_start_end_date');
    //             $sdd = explode(' - ',$event_start_end_date);
    //             $event_start_date = $sdd[0];
    //             $event_end_date = $sdd[1];

    //             if($this->input->post('event_repeat_option') == 'Does not repeat'){
    //                 $end_date = $event_end_date;
    //             }else{
    //                 if($event_start_date <= $this->input->post('end_date')){
    //                     $end_date = $this->input->post('end_date');
    //                 }else{
    //                 $end_date = $event_end_date;
    //                 }
    //             }

    //             function displayDates($date1, $date2, $format = 'Y-m' ) {
    //             $dates = array();
    //             $date1  = date("Y-m", strtotime($date1));
    //             $date2  = date("Y-m", strtotime($date2));
    //             $current = strtotime($date1);
    //             $date2 = strtotime($date2);
    //             $stepVal = '+1 months';
    //             while( $current <= $date2 ) {
    //                 $dates[] = date($format, $current);
    //                 $current = strtotime($stepVal, $current);
    //             }
    //             return $dates;
    //             }
    //             $date = displayDates($event_start_date, $end_date);

    //             $date_array = json_encode($date);

    //             $event_start_time  = date("H:i:s", strtotime($this->input->post('event_start_time')));
    //             $event_end_time  = date("H:i:s", strtotime($this->input->post('event_end_time')));

    //             $allDay = $this->input->post('event_allDay');
    //             if($allDay == 'on'){
    //                 $allDay = 'true';
    //                 $event_start_time  = '00:00:00';
    //                 $event_end_time  = '00:00:00';
    //             }else{
    //                 $allDay = 'false';
    //                 $event_start_date = $event_start_date.' '.$event_start_time;
    //                 $event_end_date = $event_end_date.' '.$event_end_time;
    //             }

    //             $draggable_id = $this->input->post('draggable_id');

    //             $de = $this->Front_model->getDraggableEventsCount($this->session->userdata('student_id'),$this->input->post('event_name'));
    //             if(($this->input->post('draggable_event') != "") && ($de <= 0)){
    //                 $data = array(  'student_id' => $this->session->userdata('student_id'),
    //                                 'event_name' => $this->input->post('event_name'),
    //                                 'event_color' => $this->input->post('event_color'),
    //                                 'event_note' => $this->input->post('event_note'),
    //                                 'event_start_date' => $sdd[0],
    //                                 'event_end_date' => $sdd[1],
    //                                 'date_array' => $date_array,
    //                                 'end_date' => $end_date,
    //                                 'event_start_time' => $event_start_time,
    //                                 'event_end_time' => $event_end_time,
    //                                 'event_repeat_option' => 'Does not repeat',
    //                                 'event_allDay' => $allDay,
    //                                 'event_reminder' => $event_reminder,
    //                                 'show_draggable_event' => 1,
    //                                 'status' => 'active',
    //                                 'date' => date('Y-m-d H:i:s'),
    //                                 'event_repeat_option_type' =>'0',
    //                             );
    //                 $data = $this->security->xss_clean($data); // xss filter
    //                 $this->Front_model->insertDraggableEvent($data);
    //                 $inserted_id = $this->db->insert_id();
    //                 $draggable_id = $inserted_id;
    //                 $response['drag_id'] = $inserted_id;
    //             }else if($this->input->post('draggable_event') == ""){
    //                 $drag_id = $this->input->post('draggable_id');
    //                 $this->Front_model->deleteDraggableEvent($drag_id);
    //                 $response['drag_id'] = 'no_drag_id';
    //             }else{
    //                 $response['drag_id'] = $this->input->post('draggable_id');
    //             }               
    //             $data1 = array( 'student_id' => $this->session->userdata('student_id'),
    //                             'event_name' => $this->input->post('event_name'),
    //                             'event_color' => $this->input->post('event_color'),
    //                             'event_note' => $this->input->post('event_note'),
    //                             'event_start_date' => $sdd[0],
    //                             'event_end_date' => $sdd[1],
    //                             'event_start_time' => $event_start_time,
    //                             'event_end_time' => $event_end_time,
    //                             'event_repeat_option' => 'Does not repeat',
    //                             'event_allDay' => $allDay,
    //                             'event_reminder' => $event_reminder,
    //                             'draggable_event' => $this->input->post('draggable_event'),
    //                             'draggable_id' => $draggable_id,
    //                             'type' => $this->input->post('type'),
    //                             'event_repeat_option_type' =>'0',
    //                         );

    //             $event_id = $this->input->post('event_id');
    //                 $data1 = $this->security->xss_clean($data1); // xss filter
    //                 $this->Front_model->updateEvent($data1,$event_id);
    //         if($this->input->post('task_name') != ""){
    //         $task_start_date  = $this->input->post('task_start_date');
    //         $task_start_time  = date("H:i:s", strtotime($this->input->post('task_start_time')));

    //         $task_allDay = $this->input->post('task_allDay');
    //         if($task_allDay == 'on'){
    //             $task_allDay = 'true';
    //             $task_start_time  = '00:00:00';
    //         }else{
    //             $task_allDay = 'false';
    //         }

    //         $data = array( 'student_id' => $this->session->userdata('student_id'),
    //                         'event_id' => $this->input->post('event_id'),
    //                         'task_name' => $this->input->post('task_name'),
    //                         'task_note' => $this->input->post('task_note'),
    //                         'task_start_date' => $this->input->post('task_start_date'),
    //                         'task_start_time' => $task_start_time,
    //                         'task_allDay' => $task_allDay,
    //                         'task_reminder' => $this->input->post('task_reminder'),
    //                         'task_category' => $this->input->post('task_category'),
    //                         'priority' => $this->input->post('priority'),
    //                         'status' => 'active',
    //                         'date' => date('Y-m-d H:i:s')
    //                     );
    //         $data = $this->security->xss_clean($data); // xss filter
    //         $this->Front_model->insertTask($data);
    //         $inserted_id = $this->db->insert_id();
    //         $response['task_id'] = $inserted_id;
    //         $response['task_allDay'] = $task_allDay;
    //         }
    //                 $response['event_id'] = $event_id;
    //                 $response['allDay'] = $allDay;              
    //                 $response['start_date'] = $event_start_date;                
    //                 $response['end_date'] = $event_end_date;                
    //                 $response['event_start_date'] = $sdd[0];                
    //                 $response['event_end_date'] = $sdd[1];              
    //                 $response['event_note'] = $this->input->post('event_note');             
    //                 $response['event_start_time'] = $event_start_time;              
    //                 $response['event_end_time'] = $event_end_time;              
    //                 $response['event_repeat_option'] = 'Does not repeat';
    //                 $response['event_allDay'] = $allDay;                
    //                 $response['event_reminder'] = $event_reminder;
    //                 $response['type'] = $this->input->post('type'); 
    //                 $response['draggable_event'] = $this->input->post('draggable_event');       
    //                 $response['draggable_id'] = $draggable_id;      
    //             $response['status'] = TRUE;        
    //         $this->session->set_flashdata('message', 'Successfully Created'); 
    //             header('Content-type: application/json');
    //             echo json_encode($response); 
    //         }
    //     }
    // }

    public function insert_drop_event() //Insert Event Details
    {

        $drag_start_date = $this->input->post('drag_date');
        $start_date_array = explode(' ', $drag_start_date);
        
        $drag_id = $this->input->post('drag_id');
        $de = $this->Front_model->getDraggableEventById($drag_id);
        $allDay = $this->input->post('allDay');
        if($allDay == 'false')
        {
            $end_date_array = strtotime("+15 minutes", strtotime($drag_start_date));
            $end_date_array = date('Y-m-d h:i:s', $end_date_array);
            $end_date_array = explode(' ', $end_date_array);

            $drag_end_date = strtotime("+15 minutes", strtotime($drag_start_date));
            $drag_end_date = date('Y-m-d h:i:s', $drag_end_date);

            $start_date = $start_date_array[0];
            $end_date = $end_date_array[0];

            $start_time = $start_date_array[1];
            $end_time = $end_date_array[1];


        }
        else if($allDay == 'true'){
            $end_date_array = $start_date_array;

            $start_date = $start_date_array[0];
            $end_date = $end_date_array[0];

            $start_time = $start_date_array[1];
            $end_time = $end_date_array[1];

            $drag_end_date = $drag_start_date;
        }
        else{
            $end_date_array = $start_date_array;
            $start_date = $start_date_array[0];
            $end_date = $end_date_array[0];

            if($de->event_start_time){
                $start_time = $de->event_start_time;
            }else{
                $start_time = $start_date_array[1];
            }
            if($de->event_end_time){
                $end_time = $de->event_end_time;
            }else{
                $end_time = $end_date_array[1];
            }
            $drag_start_date = $start_date.' '.$start_time;
            $drag_end_date = $end_date.' '.$end_time;
            $allDay = $de->event_allDay;
        }

        if($de->event_repeat_option == 'Does not repeat'){
            $end_date1 = $end_date;
        }else{
            if($start_date <= $de->end_date){
                $end_date1 = $de->end_date;
            }else{
              $end_date1 = $end_date;
            }
        }

        function displayDates($date1, $date2, $format = 'Y-m' ) {
          $dates = array();
          $date1  = date("Y-m", strtotime($date1));
          $date2  = date("Y-m", strtotime($date2));
          $current = strtotime($date1);
          $date2 = strtotime($date2);
          $stepVal = '+1 months';
          while( $current <= $date2 ) {
             $dates[] = date($format, $current);
             $current = strtotime($stepVal, $current);
          }
          return $dates;
        }
        $date = displayDates($start_date, $end_date1);

        $date_array = json_encode($date);
        
        if($de){            
            $data = array(  'student_id' => $this->session->userdata('student_id'),
                            'event_name' => $de->event_name,
                            'event_color' => $de->event_color,
                            'event_note' => $de->event_note,
                            'event_start_date' => $start_date,
                            'event_end_date' => $end_date,
                            'date_array' => $date_array,
                            'end_date' => $end_date1,
                            'event_start_time' => $start_time,
                            'event_end_time' => $end_time,
                            'event_repeat_option' => $de->event_repeat_option,
                            'event_allDay' => $allDay,
                            'event_reminder' => $de->event_reminder,
                            'draggable_event' => 'on',
                            'draggable_id' => $this->input->post('drag_id'),
                            'type' => 'event',
                            'status' => 'active',
                            'date' => date('Y-m-d H:i:s')
                         );
            $data = $this->security->xss_clean($data); // xss filter
            $this->Front_model->insertEvent($data);
            $inserted_id = $this->db->insert_id();
            $this->session->set_flashdata('message', 'Successfully Added');
            $response['student_id'] = $this->session->userdata('student_id');
            $response['event_id'] = $inserted_id;
            $response['event_name'] = $de->event_name;
            $response['event_color'] = $de->event_color;
            $response['event_note'] = $de->event_note;
            $response['allDay'] = $allDay;
            $response['type'] = 'event';            
            $response['start_date'] = $drag_start_date;             
            $response['end_date'] = $drag_end_date;             
            $response['event_start_date'] = $start_date;                
            $response['event_end_date'] = $end_date;                
            $response['event_start_time'] = $start_time;                
            $response['event_end_time'] = $end_time;                
            $response['event_repeat_option'] = $de->event_repeat_option;             
            $response['event_reminder'] = $de->event_reminder;
            $response['draggable_event'] = 'on';
            $response['draggable_id'] = $this->input->post('drag_id');
            $response['drag_id'] = $drag_id;

            $response['status'] = TRUE;

            header('Content-type: application/json');
            echo json_encode($response);
        } 
    }

    public function update_draggable_event() //Update Draggable Event
    {
        $event_id = $this->input->post('drag_id');
        $data = array(  'show_draggable_event' => 0  );
        $data = $this->security->xss_clean($data); // xss filter
        $this->Front_model->updateDraggableEvent($data,$event_id);
    }

    public function delete_draggable_event() //delete Draggable Event
    {
        $drag_id = $this->input->post('drag_id');
        $this->Front_model->deleteDraggableEvent($drag_id);
    }

    public function get_calendar_events()
    {
        $student_id = $this->session->userdata('student_id');
        $month_year = $this->input->post('month_year');
        // if(($month_year != 'undefined') && ($month_year != '')){
        //  $month_year = str_replace('GMT+0530 (India Standard Time)','',$month_year);
        //  $month_year = date("Y-m", strtotime($month_year));
        // }else{
        //  $month_year = date('Y-m');
        // }
        $month_year = date('Y-m');
        $data = $this->Front_model->getCalendarMonthEvents($student_id,$month_year);
        $data1 = $this->Front_model->getMontsWithcycle($student_id,$month_year);
        
        foreach ($data1 as $data12) {
        $data_array_cyc = array();
        $data15 = array('start_cycle' => $data12->start_cycle);
        } 

        $data_array_cyc[] = $data15;
        $format = 'Y-m-d';
        $data_array = array();
        if($data){
            foreach ($data as $d)
                {
                $all_data = $this->Front_model->getDataByUniqueId($d->unique_key);
                $array_count = count($all_data);
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
                                    'unique_key' => $d->unique_key,
                                    'custom_all_day' => $d->custom_all_day,
                                    'event_repeat_option_type' => $d->event_repeat_option_type,
                                    'array_count' => $array_count,

                                 );
                    $data_array[] = $data1;
                }
                else if($d->event_repeat_option == 'Daily'){
                    $event_start_date = strtotime($d->event_start_date);
                    $event_end_date = strtotime($d->event_end_date);
                    $start_date = strtotime($d->event_start_date);  
                    $end_date = strtotime($d->end_date);  
                    if(date('Y-m',$start_date) != date('Y-m',$end_date))
                    {
                        if(date('Y-m',$start_date) < $month_year){
                            $start_date = date("Y-m-01", strtotime($month_year));
                            $start_date = strtotime($start_date);                            
                        }else{
                            $end_date = date("Y-m-t", strtotime($month_year));
                            $end_date = strtotime($end_date);
                        }
                    }
                    // Formulate the Difference between two dates
                    $diff = abs($event_start_date - $event_end_date); 
                    $years = floor($diff / (365*60*60*24));   
                    $months = floor(($diff - $years * 365*60*60*24)/ (30*60*60*24)); 
                    $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
                    $day = '+'.$days.' days';
                    $stepVal = '+1 day';                  
                    while( $start_date <= $end_date ) {
                        $event_start_date = date($format, $start_date);
                        $event_end_date = date($format, strtotime($day, $start_date));
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
                                        'custom_all_day' => $d->custom_all_day,
                                        'type' => $d->type,
                                        'array_count' => $array_count,
                                     );
                        $data_array[] = $data1;
                        $start_date = strtotime($stepVal, $start_date);
                    }
                }
            }
        }
        header('Content-type: application/json');
        echo json_encode($data_array);  

    }

    public function get_allcalendar_events()
    {
        $student_id = $this->session->userdata('student_id');
        $month_year = $this->input->post('month_year');
        $button = $this->input->post('button');
        $words = explode(' ', $month_year);
        $count_my = count($words);
        if($button == 'prev'){
          if($count_my == 2){
            $month_year = date("Y-m", strtotime($month_year. " -1 month"));
            $data = $this->Front_model->getCalendarMonthEvents($student_id,$month_year);
            $format = 'Y-m-d';
            $data_array = array();
            if($data){
                foreach ($data as $d) {
                    $all_data = $this->Front_model->getDataByUniqueId($d->unique_key);
                    $array_count = count($all_data);
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
                                        'custom_all_day' => $d->custom_all_day,
                                        'unique_key' => $d->unique_key,
                                        'event_repeat_option_type' => $d->event_repeat_option_type,
                                        'array_count' => $array_count,
                                     );
                        $data_array[] = $data1;
                    }
                    else if($d->event_repeat_option == 'Daily'){
                        $event_start_date = strtotime($d->event_start_date);
                        $event_end_date = strtotime($d->event_end_date);

                        $start_date = strtotime($d->event_start_date);  
                        $end_date = strtotime($d->end_date);  
                        if(date('Y-m',$start_date) != date('Y-m',$end_date))
                        {
                            if(date('Y-m',$start_date) < $month_year){
                                if(date('Y-m',$end_date) != $month_year){
                                    $start_date = date("Y-m-01", strtotime($month_year));
                                    $start_date = strtotime($start_date);

                                    $end_date = date("Y-m-t", strtotime($month_year));
                                    $end_date = strtotime($end_date);
                                }else{
                                    $start_date = date("Y-m-01", $end_date);
                                    $start_date = strtotime($start_date);
                                }
                            }else{
                                $end_date = date("Y-m-t", $start_date);
                                $end_date = strtotime($end_date);
                            }
                            
                        }

                        // Formulate the Difference between two dates
                        $diff = abs($event_start_date - $event_end_date); 
                        $years = floor($diff / (365*60*60*24));   
                        $months = floor(($diff - $years * 365*60*60*24)/ (30*60*60*24)); 
                        $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
                        $day = '+'.$days.' days';
                        $stepVal = '+1 day';                    
                        while( $start_date <= $end_date ) {
                            $event_start_date = date($format, $start_date);
                            $event_end_date = date($format, strtotime($day, $start_date));
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
                                            'unique_key' => $d->unique_key,
                                            'custom_all_day' => $d->custom_all_day,
                                            'event_repeat_option_type' => $d->event_repeat_option_type,
                                            'array_count' => $array_count,
                                         );
                            $data_array[] = $data1;
                            $start_date = strtotime($stepVal, $start_date);
                        }
                    }
                }
            }
          }else if($count_my == 3){
            $day_list = date("Y-m-d", strtotime($month_year. " -1 days"));
            $data = $this->Front_model->getCalendarDlEvents($student_id,$day_list);
          }else if($count_my == 5){
            $d = $this->input->post('month_year'); //Jul 4 – 10, 2021
            $s = explode(" – ", $d);// Array ( [0] => Jul 4 [1] => 10, 2021 )
            $m = explode(" ", $s[0]);// Array ( [0] => Jul [1] => 4 )
            $y = explode(", ", $s[1]);// Array ( [0] => 10 [1] => 2021 )

            $date1 = $s[0].' '.$y[1];//jul 4 2021
            $date2 = $m[0].' '.$y[0].' '.$y[1];//jul 10 2021

            $date1 = date('Y-m-d', strtotime($date1. " -1 weeks"));
            $date2 = date('Y-m-d', strtotime($date2. " -1 weeks"));
            $data = $this->Front_model->getCalendarWeekEvents($student_id,$date1,$date2);
          }else{
            $l = $this->input->post('month_year'); //May 30 – Jun 5, 2021
            $s = explode(" – ", $l);//Array ( [0] => May 30 [1] => Jun 5, 2021 )
            $m = explode(" ", $s[0]);// Array ( [0] => May [1] => 30 )
            $y = explode(", ", $s[1]);//Array ( [0] => Jun 5 [1] => 2021 )

            $date1 = $s[0].' '.$y[1];//May 30 2021
            $date2 = $y[0].' '.$y[1];//Jun 5 2021

            $date1 = date('Y-m-d', strtotime($date1 . " -1 weeks"));
            $date2 = date('Y-m-d', strtotime($date2 . " -1 weeks"));
            $data = $this->Front_model->getCalendarWeekEvents($student_id,$date1,$date2);
          }
        }else if($button == 'next'){
          if($count_my == 2){
            $month_year = date("Y-m", strtotime($month_year. " +1 month"));
            $data = $this->Front_model->getCalendarMonthEvents($student_id,$month_year);
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
                                        'unique_key' => $d->unique_key,
                                        'custom_all_day' => $d->custom_all_day,
                                        'event_repeat_option_type' => $d->event_repeat_option_type,
                                     );
                        $data_array[] = $data1;
                    }
                    else if($d->event_repeat_option == 'Daily'){
                        $event_start_date = strtotime($d->event_start_date);
                        $event_end_date = strtotime($d->event_end_date);

                        $start_date = strtotime($d->event_start_date);  
                        $end_date = strtotime($d->end_date);  
                        if(date('Y-m',$start_date) != date('Y-m',$end_date))
                        {
                            if(date('Y-m',$start_date) < $month_year){
                                if(date('Y-m',$end_date) != $month_year){
                                    $start_date = date("Y-m-01", strtotime($month_year));
                                    $start_date = strtotime($start_date);

                                    $end_date = date("Y-m-t", strtotime($month_year));
                                    $end_date = strtotime($end_date);
                                }else{
                                    $start_date = date("Y-m-01", $end_date);
                                    $start_date = strtotime($start_date);
                                }
                            }else{
                                $end_date = date("Y-m-t", $start_date);
                                $end_date = strtotime($end_date);
                            }  
                        }
                        // Formulate the Difference between two dates
                        $diff = abs($event_start_date - $event_end_date);
                        $years = floor($diff / (365*60*60*24));
                        $months = floor(($diff - $years * 365*60*60*24)/ (30*60*60*24));
                        $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
                        $day = '+'.$days.' days';
                        $stepVal = '+1 day';            
                        while( $start_date <= $end_date ) {
                            $event_start_date = date($format, $start_date);
                            $event_end_date = date($format, strtotime($day, $start_date));
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
                                            'unique_key' => $d->unique_key,
                                            'custom_all_day' => $d->custom_all_day,
                                            'event_repeat_option_type' => $d->event_repeat_option_type,
                                        );
                            $data_array[] = $data1;
                            $start_date = strtotime($stepVal, $start_date);
                        }
                    }
                }
            }
          }else if($count_my == 3){
            $day_list = date("Y-m-d", strtotime($month_year. " +1 days"));
            $data = $this->Front_model->getCalendarDlEvents($student_id,$day_list);
          }else if($count_my == 5){
            $d = $this->input->post('month_year'); //Jul 4 – 10, 2021
            $s = explode(" – ", $d);//Array ( [0] => Jul 4 [1] => 10, 2021 )
            $m = explode(" ", $s[0]);// Array ( [0] => Jul [1] => 4 )
            $y = explode(", ", $s[1]);//Array ( [0] => 10 [1] => 2021 )

            $date1 = $s[0].' '.$y[1];//jul 4 2021
            $date2 = $m[0].' '.$y[0].' '.$y[1];//jul 10 2021

            $date1 = date('Y-m-d', strtotime($date1. " +1 weeks"));
            $date2 = date('Y-m-d', strtotime($date2. " +1 weeks"));
            $data = $this->Front_model->getCalendarWeekEvents($student_id,$date1,$date2);
          }else{
            $l = $this->input->post('month_year'); //May 30 – Jun 5, 2021
            $s = explode(" – ", $l);//Array ( [0] => May 30 [1] => Jun 5, 2021 )
            $m = explode(" ", $s[0]);// Array ( [0] => May [1] => 30 )
            $y = explode(", ", $s[1]);//Array ( [0] => Jun 5 [1] => 2021 )

            $date1 = $s[0].' '.$y[1];//May 30 2021
            $date2 = $y[0].' '.$y[1];//Jun 5 2021

            $date1 = date('Y-m-d', strtotime($date1 . " +1 weeks"));
            $date2 = date('Y-m-d', strtotime($date2 . " +1 weeks"));
            $data = $this->Front_model->getCalendarWeekEvents($student_id,$date1,$date2);
          }
        }else{
          if($count_my == 2){
            echo "ewewe";
            $month_year = date("Y-m", strtotime($month_year));
            $data = $this->Front_model->getCalendarMonthEvents($student_id,$month_year);
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
                                        'unique_key' => $d->unique_key,
                                        'custom_all_day' => $d->custom_all_day,
                                        'event_repeat_option_type' => $d->event_repeat_option_type,
                                     );
                        $data_array[] = $data1;
                    }
                    else if($d->event_repeat_option == 'Daily'){
                        $event_start_date = strtotime($d->event_start_date);
                        $event_end_date = strtotime($d->event_end_date);

                        $start_date = strtotime($d->event_start_date);
                        $end_date = strtotime($d->end_date);
                        if(date('Y-m',$start_date) != date('Y-m',$end_date))
                        {
                            if(date('Y-m',$start_date) < $month_year){
                                if(date('Y-m',$end_date) != $month_year){
                                    $start_date = date("Y-m-01", strtotime($month_year));
                                    $start_date = strtotime($start_date);

                                    $end_date = date("Y-m-t", strtotime($month_year));
                                    $end_date = strtotime($end_date);
                                }else{
                                    $start_date = date("Y-m-01", $end_date);
                                    $start_date = strtotime($start_date);
                                }
                            }else{
                                $end_date = date("Y-m-t", $start_date);
                                $end_date = strtotime($end_date);
                            }
                        }

                        // Formulate the Difference between two dates
                        $diff = abs($event_start_date - $event_end_date); 
                        $years = floor($diff / (365*60*60*24));   
                        $months = floor(($diff - $years * 365*60*60*24)/ (30*60*60*24)); 
                        $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
                        $day = '+'.$days.' days';
                        $stepVal = '+1 day';                    
                        while( $start_date <= $end_date ) {
                            $event_start_date = date($format, $start_date);
                            $event_end_date = date($format, strtotime($day, $start_date));
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
                                            'unique_key' => $d->unique_key,
                                            'custom_all_day' => $d->custom_all_day,
                                            'event_repeat_option_type' => $d->event_repeat_option_type,
                                         );
                            $data_array[] = $data1;
                            $start_date = strtotime($stepVal, $start_date);
                        }
                    }
                }
            }
          }else if($count_my == 3){
            $day_list = date("Y-m-d", strtotime($month_year));
            $data = $this->Front_model->getCalendarDlEvents($student_id,$day_list);
            $data_array[] = $data;
          }else if($count_my == 5){
            $d = $this->input->post('month_year'); //Jul 4 – 10, 2021   
            $s = explode(" – ", $d);//Array ( [0] => Jul 4 [1] => 10, 2021 ) 
            $m = explode(" ", $s[0]);// Array ( [0] => Jul [1] => 4 ) 
            $y = explode(", ", $s[1]);//Array ( [0] => 10 [1] => 2021 )

            $date1 = $s[0].' '.$y[1];//jul 4 2021
            $date2 = $m[0].' '.$y[0].' '.$y[1];//jul 10 2021

            $date1 = date('Y-m-d', strtotime($date1));
            $date2 = date('Y-m-d', strtotime($date2)); 
            $data = $this->Front_model->getCalendarWeekEvents($student_id,$date1,$date2);
            $data_array[] = $data;
          }else{
            $l = $this->input->post('month_year'); //May 30 – Jun 5, 2021
            $s = explode(" – ", $l);//Array ( [0] => May 30 [1] => Jun 5, 2021 )
            $m = explode(" ", $s[0]);// Array ( [0] => May [1] => 30 )
            $y = explode(", ", $s[1]);//Array ( [0] => Jun 5 [1] => 2021 )

            $date1 = $s[0].' '.$y[1];//May 30 2021
            $date2 = $y[0].' '.$y[1];//Jun 5 2021

            $date1 = date('Y-m-d', strtotime($date1));
            $date2 = date('Y-m-d', strtotime($date2));
            $data = $this->Front_model->getCalendarWeekEvents($student_id,$date1,$date2);
            $data_array[] = $data;
          }
        }
        header('Content-type: application/json');
        echo json_encode($data_array);  
    }

    public function get_drag_event_data() //Draggable Event Details
    {

        $drag_id = $this->input->post('drag_id');
        $de = $this->Front_model->getDraggableEventById($drag_id);
        $response['student_id'] = $this->session->userdata('student_id');
        $response['event_name'] = $de->event_name;
        $response['event_color'] = $de->event_color;
        $response['event_note'] = $de->event_note;
        $response['allDay'] = $de->event_allDay;                            
        $response['event_start_date'] = $de->event_start_date;              
        $response['event_end_date'] = $de->event_end_date;              
        $response['event_start_time'] = $de->event_start_time;              
        $response['event_end_time'] = $de->event_end_time;              
        $response['event_repeat_option'] = $de->event_repeat_option;             
        $response['event_reminder'] = $de->event_reminder;
        $response['drag_id'] = $drag_id;
        $response['status'] = TRUE;
        header('Content-type: application/json');
        echo json_encode($response);
    }

    public function insert_task() //Insert Task Details
    {
        $this->form_validation->set_rules('task_name','Title','trim|required');
        $this->form_validation->set_rules('task_start_date','Start Date','trim|required');
        $this->form_validation->set_rules('task_start_time','Start Time','trim|required');
        $this->form_validation->set_rules('priority','Priority','trim|required');
        $this->form_validation->set_rules('task_category','Category','trim');
        
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
            $task_start_date  = $this->input->post('task_start_date');
            $task_start_time  = date("H:i:s", strtotime($this->input->post('task_start_time')));

            $allDay = $this->input->post('task_allDay');
            if($allDay == 'on'){
                $allDay = 'true';
                $task_start_time  = '00:00:00';
            }else{
                $allDay = 'false';
            }

            $data = array(  'student_id' => $this->session->userdata('student_id'),
                            'event_id' => $this->input->post('event_id'),
                            'task_name' => $this->input->post('task_name'),
                            'task_note' => $this->input->post('task_note'),
                            'task_start_date' => $this->input->post('task_start_date'),
                            'task_start_time' => $task_start_time,
                            'task_allDay' => $allDay,
                            'task_reminder' => $this->input->post('task_reminder'),
                            'task_category' => $this->input->post('task_category'),
                            'priority' => $this->input->post('priority'),
                            'status' => 'active',
                            'date' => date('Y-m-d H:i:s')
                         );
            $data = $this->security->xss_clean($data); // xss filter
            $this->Front_model->insertTask($data);
            $inserted_id = $this->db->insert_id();
            $response['task_id'] = $inserted_id;
            $response['allDay'] = $allDay;
            $response['priority'] = $this->input->post('priority');
            if($this->input->post('event_id') != ""){
                    $response['hidden_event_id'] = $this->input->post('event_id');
                }else{
                    $response['hidden_event_id'] = '0';
                }
            $this->session->set_flashdata('message', 'Successfully Created');           
            $response['status'] = TRUE;
            header('Content-type: application/json');
            echo json_encode($response); 
        }
    }

    public function task_data() //Task Details
    {
        $data['student_id'] = $this->session->userdata('student_id');
        $data['event_id']  = $this->input->post('event_id');
        
        $response['task_data'] = $this->load->view('user/task_data',$data);
    }
    public function task_data_new() //Task Details
    {
        $event_id = $this->input->post('event_id');
        $event_data  = $this->Front_model->getTaskDataNew($event_id);
        $response['task_start_date'] = $event_data[0]->event_start_date;
        $response['task_end_date'] = array_slice($event_data, -1)[0]->event_end_date;
        // print_r($response);
        // die;
        header('Content-type: application/json');
        echo json_encode($response);
    }

    public function get_task_data() //Task Details
    {
        $task_id = $this->input->post('task_id');
        $tk = $this->Front_model->getTaskById($task_id);
        $evt = $this->Front_model->getEventById($tk->event_id);
        if($evt){
            $response['event_name'] = $evt->event_name;
        }else{
            $response['event_name'] = '';
        }       
        $response['task_name'] = $tk->task_name;
        $response['task_note'] = $tk->task_note;
        $response['task_start_date'] = $tk->task_start_date;
        $response['task_start_time'] = $tk->task_start_time;
        $response['priority'] = $tk->priority;
        $response['task_reminder'] = $tk->task_reminder;
        $response['task_category'] = $tk->task_category;
        $response['task_allDay'] = $tk->task_allDay;
        $response['event_id'] = $tk->event_id;
        $response['task_id'] = $tk->id;
        $response['status'] = TRUE;
        header('Content-type: application/json');
        echo json_encode($response);
    }

    public function get_view_task_data() //Task Details
    {
        $task_id = $this->input->post('task_id');
        $tk = $this->Front_model->getTaskById($task_id);
        $evt = $this->Front_model->getEventById($tk->event_id);

        $student_id = $this->session->userdata('student_id');
        $stud_del = $this->Front_model->getStudentById($student_id);
        if($stud_del->photo){
          $response['photo'] = '<img class="avatar mr-10 bg-light rounded-circle" src="'.base_url('assets/student_photos/'.$stud_del->photo).'">';
        }else{
          $fullname = $stud_del->first_name.' '.$stud_del->last_name;
          $student_name = explode(" ", $fullname);
          $profile_name = "";

          foreach ($student_name as $sn) {
            $profile_name .= $sn[0];
          }
            $response['photo'] = '<p class="avatar mb-0 mr-10 bg-light rounded-circle">'.strtoupper($profile_name).'</p>';
        }
        $response['student_name'] = $stud_del->first_name.' '.$stud_del->last_name;
        $task_comments = $this->Front_model->getCommentsByTaskId($task_id);
        $response['task_comments'] = $task_comments;

        if($evt){
          $response['event_name'] = $evt->event_name;
        }else{
          $response['event_name'] = '';
        }   
        $response['task_name'] = $tk->task_name;
        $response['task_note'] = $tk->task_note;
        $response['task_start_date'] = $tk->task_start_date;
        $response['task_start_time'] = $tk->task_start_time;
        $response['priority'] = $tk->priority;
        $response['task_reminder'] = $tk->task_reminder;
        $response['task_category'] = $tk->task_category;
        $response['task_allDay'] = $tk->task_allDay;
        $response['event_id'] = $tk->event_id;
        $response['task_id'] = $tk->id;
        $response['status'] = TRUE;
        header('Content-type: application/json');
        echo json_encode($response);
    }

    public function get_event_data() //Event Details
    {
        $event_id = $this->input->post('event_id');
        $evt = $this->Front_model->getEventById($event_id);
        $response['event_name'] = $evt->event_name; 
        $response['event_note'] = $evt->event_note;
        $response['event_start_date'] = $evt->event_start_date;
        $response['event_end_date'] = $evt->event_end_date;
        $response['event_start_time'] = $evt->event_start_time;
        $response['event_end_time'] = $evt->event_end_time;
        $response['event_color'] = $evt->event_color;
        $response['event_repeat_option'] = $evt->event_repeat_option;
        $response['event_reminder'] = $evt->event_reminder;
        $response['event_allDay'] = $evt->event_allDay;
        $response['draggable_event'] = $evt->draggable_event;
        $response['event_id'] = $evt->id;
        $data['tasks'] = $this->Front_model->getTaskByEventId($event_id);
        // $response['taskdata'] = $this->load->view('user/task-data',$data);
        $response['status'] = TRUE;
        header('Content-type: application/json');
        echo json_encode($response);
    }

    public function edit_task() //Edit Task Details
    {
        $this->form_validation->set_rules('task_name','Title','trim|required');
        $this->form_validation->set_rules('task_start_date','Start Date','trim|required');
        $this->form_validation->set_rules('task_start_time','Start Time','trim|required');
        $this->form_validation->set_rules('priority','Priority','trim|required');
        
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
            $task_id  = $this->input->post('task_id');
            $task_start_date  = $this->input->post('task_start_date');
            $task_start_time  = date("H:i:s", strtotime($this->input->post('task_start_time')));

            $allDay = $this->input->post('task_allDay');
            if($allDay == 'on'){
                $allDay = 'true';
                $task_start_time  = '00:00:00';
            }else{
                $allDay = 'false';
            }

            $data = array(  'event_id' => $this->input->post('event_id'),
                            'task_name' => $this->input->post('task_name'),
                            'task_note' => $this->input->post('task_note'),
                            'task_start_date' => $this->input->post('task_start_date'),
                            'task_start_time' => $task_start_time,
                            'task_allDay' => $allDay,
                            'task_reminder' => $this->input->post('task_reminder'),
                            'task_category' => $this->input->post('task_category'),
                            'priority' => $this->input->post('priority'),
                        );
            $data = $this->security->xss_clean($data); // xss filter
            $this->Front_model->editTask($data,$task_id);
            if($this->input->post('event_id') != ""){
                $response['event_id'] = $this->input->post('hidden_event_id');
            }else{
                $response['event_id'] = '0';
            }
            $response['task_id'] = $this->input->post('task_id');
            $response['allDay'] = $allDay;
            $this->session->set_flashdata('message', 'Successfully Updated');           
            $response['status'] = TRUE;
            header('Content-type: application/json');
            echo json_encode($response); 
        }
    }

    public function delete_task() //Delete Task
    {
        $task_id = $this->input->post('task_id');
        $this->Front_model->deleteTask($task_id);
    }

    public function delete_comment() //Delete Comment
    {
        $comment_id = $this->input->post('comment_id');
        $this->Front_model->deleteComment($comment_id);
    }

    public function complete_task() //Complete Task
    {
        $complete = $this->input->post('complete');
        $task_id = $this->input->post('task_id');
        $data = array('is_completed' => $complete);
        $this->Front_model->editTask($data,$task_id);
        $tk = $this->Front_model->getTaskById($task_id);
        if($tk->is_completed == 'yes'){
            $response['status'] = '<span class="badge badge-pill badge-success font-size-12 mb-0">Completed</span>';
        }else{
            if(strtotime(date('Y-m-d')) > strtotime($tk->task_start_date)){
                $response['status'] = '<span class="badge badge-pill badge-danger font-size-12 mb-0">Overdue</span>';
            }else{
                $response['status'] = '<span class="badge badge-pill badge-warning font-size-12 mb-0">Pending</span>';
            }
        } 
        header('Content-type: application/json');
        echo json_encode($response);                           
    }

    public function complete_event_task() //Complete Task
    {
        $student_id = $this->session->userdata('student_id');
        $complete = $this->input->post('complete');
        $task_id = $this->input->post('task_id');
        $event_id = $this->input->post('event_id');

        $data = array('is_completed' => $complete);
        $this->Front_model->editTask($data,$task_id);

        $tasks = $this->Front_model->getEventTasks($student_id,$event_id);
        $task_count = count($tasks);
        $comp_tasks = $this->Front_model->getCompletetaskCount($student_id,$event_id);
        $task_percent = round(($comp_tasks/$task_count)*100);
        
        $response['task_percent'] = $task_percent;
        header('Content-type: application/json');
        echo json_encode($response); 
    }

    public function change_task_id() //Change task ID
    {
        $sortable_id = $this->input->post('sortable_id');
        $replaced_id = $this->input->post('replaced_id');
        $sortable_data = $this->Front_model->getTaskById($sortable_id);
        $replaced_data = $this->Front_model->getTaskById($replaced_id);
        $sortable_id = $sortable_data->id;
        $replaced_id = $replaced_data->id;
        $data1 = array('sort_id' => $replaced_id );
        $this->Front_model->editTask($data1, $sortable_id);

        $data2 = array('sort_id' => $sortable_id );
        $this->Front_model->editTask($data2, $replaced_id);
    }

    public function insert_comment() //Insert Comments
    {
        $this->form_validation->set_rules('comment','Comment','trim|required');
    
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
          $student_id = $this->session->userdata('student_id');
          $data = array(  'student_id' => $this->session->userdata('student_id'),
                          'task_id' => $this->input->post('task_id'),
                          'comment' => $this->input->post('comment'),
                          'date' => date('Y-m-d H:i:s'),
                        );
          $data = $this->security->xss_clean($data); // xss filter
          $this->Front_model->insertComment($data);
          $inserted_id = $this->db->insert_id();
          $this->session->set_flashdata('message', 'Comment Successfully Added');
          $response['comment_id'] = $inserted_id;

          $task_comments = $this->Front_model->getCommentsByTaskId($this->input->post('task_id'));
          $response['task_comments'] = $task_comments;

          $stud_del = $this->Front_model->getStudentById($student_id);
          if($stud_del->photo){
            $response['photo'] = '<img class="avatar mr-10 bg-light rounded-circle" src="'.base_url('assets/student_photos/'.$stud_del->photo).'">';
          }else{
            $fullname = $stud_del->first_name.' '.$stud_del->last_name;
            $student_name = explode(" ", $fullname);
            $profile_name = "";

            foreach ($student_name as $sn) {
              $profile_name .= $sn[0];
            }
              $response['photo'] = '<p class="avatar mb-0 mr-10 bg-light rounded-circle">'.strtoupper($profile_name).'</p>';
          }
          $response['student_name'] = $stud_del->first_name.' '.$stud_del->last_name;
          $response['status'] = TRUE;
          header('Content-type: application/json');
          echo json_encode($response);  
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('student_id');
        $this->session->sess_destroy();
        // redirect(base_url('login-register'));
    }

    public function timer_logout()
    {
        $this->session->unset_userdata('student_id');
        $this->session->sess_destroy();
        redirect(base_url('login-register'));
    }
    public function settings()
    {
        if(($this->session->userdata('student_id')) || ($this->session->userdata('student_id') != ""))
        {
            $student_id = $this->session->userdata('student_id');
            $data['stud_del'] = $this->Front_model->getStudentById($student_id);
            $stud_mod = $this->Front_model->getStudentModuleCount($student_id);
            if($stud_mod > 0){
                $data['allocator_mod'] = $this->Front_model->getModuleByStudId($student_id,1);
                $data['scheduler_mod'] = $this->Front_model->getModuleByStudId($student_id,2);
                $data['motivator'] = $this->Front_model->getRandMotivator();  
                $data['stud_mod'] = $this->Front_model->getStudentModuleById($student_id);
                $data['active_courses'] = $this->Front_model->getCourses();
                $data['active_conf_level'] = $this->Front_model->getConfidenceLevel();
                $data['schools'] = $this->Front_model->getSchoolNames();
                $data['hear_from'] = $this->Front_model->getHearFrom();
                $data['sc'] = $this->Front_model->getStudCourseById($student_id);
                $this->load->view('user/settings',$data);
            }else{
                redirect(base_url('complete-process'));
            }           
        }else{
            redirect(base_url('login-register'));
        }
    }
    public function update_course() //Update Course
    {
        
        $this->form_validation->set_rules('course','Module','trim|required');
        $this->form_validation->set_rules('is_scheduled','Is Exam Date Scheduled','trim|required');
        $this->form_validation->set_rules('confidence_level','Confidence level','trim');
        
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
            $original_exam_date = $this->input->post('exam_date'); // m/d/Y            
            $exam_date = date("Y-m-d", strtotime($original_exam_date));

            $student_id = $this->session->userdata('student_id');
            $data = array(  'course_id' => $this->input->post('course'),
                            'is_scheduled' => $this->input->post('is_scheduled'),
                            'exam_date' => $exam_date,
                            'confidence_level_id' => $this->input->post('confidence_level'),
                         );
            $data = $this->security->xss_clean($data); // xss filter
            $this->Front_model->updateCourse($data,$student_id);
            $this->session->set_flashdata('message', 'Successfully Updated');
            $response['status'] = TRUE;
            $response['page'] = $this->input->post('page');
            header('Content-type: application/json');
            echo json_encode($response);  
        }
    }
    public function taskboard()
    {
        if(($this->session->userdata('student_id')) || ($this->session->userdata('student_id') != ""))
        {
            $completed = $this->uri->segment(2);
            $student_id = $this->session->userdata('student_id');
            $data['stud_del'] = $this->Front_model->getStudentById($student_id);
            $stud_mod = $this->Front_model->getStudentModuleCount($student_id);
            $data['motivator'] = $this->Front_model->getRandMotivator();   
            
            if($stud_mod > 0){
                $data['allocator_mod'] = $this->Front_model->getModuleByStudId($student_id,1);
                $data['scheduler_mod'] = $this->Front_model->getModuleByStudId($student_id,2);
                $data['events'] = $this->Front_model->getActiveEvents($student_id);
                if($completed == 'completed-tasks'){
                    $data['tasks'] = $this->Front_model->getCompletedTasks($student_id);
                }else if($completed == 'overdue-tasks'){
                    $data['tasks'] = $this->Front_model->getOverdueTasks($student_id);
                }else if($completed == 'open-tasks'){
                    $data['tasks'] = $this->Front_model->getActiveTasks($student_id);
                }
                else{
                    $data['tasks'] = $this->Front_model->getAllTasks($student_id);
                }
                $data['time_12hrs'] = $this->Front_model->gettime_12hrs();
                if($completed == 'events'){
                    $this->load->view('user/events',$data);
                }else{
                    $this->load->view('user/taskboard',$data);
                }
                
            }else{
                redirect(base_url('complete-process'));
            }               
        }else{
            redirect(base_url('login-register'));
        }
    }
    public function planner()
    {
        if(($this->session->userdata('student_id')) || ($this->session->userdata('student_id') != ""))
        {
            $student_id = $this->session->userdata('student_id');
            $data['stud_del'] = $this->Front_model->getStudentById($student_id);
            $data['mentor'] = $this->Front_model->getMentors();
            $stud_mod = $this->Front_model->getStudentModuleCount($student_id);
            if($stud_mod > 0){
                $data['allocator_mod'] = $this->Front_model->getModuleByStudId($student_id,1);
                $data['scheduler_mod'] = $this->Front_model->getModuleByStudId($student_id,2);
                $data['motivator'] = $this->Front_model->getRandMotivator();   
                $data['planner'] = $this->Front_model->getStudentPlanner($student_id);
                $data['active_courses'] = $this->Front_model->getCourses();
                $data['active_conf_level'] = $this->Front_model->getConfidenceLevel();
                $data['sc'] = $this->Front_model->getStudCourseById($student_id);
                $data['sb_course'] = $this->Front_model->getCourseById($data['sc']->course_id);
                $this->load->view('user/planner',$data);
            }else{
                redirect(base_url('complete-process'));
            }           
        }else{
            redirect(base_url('login-register'));
        }
    }
    public function insert_planner() //Insert Planner Details
    {
        $this->form_validation->set_rules('title','Title','trim|required');
        $this->form_validation->set_rules('course_id','Exam','trim|required');
        $this->form_validation->set_rules('mentor_id','Mentor','trim');
        
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
            $student_id = $this->session->userdata('student_id');
            $email_address = $this->input->post('email_address');
            $studdel = $this->Front_model->getStudentById($student_id);
            $data = array(  'student_id' => $student_id,
                            'title' => $this->input->post('title'),
                            'course_id' => $this->input->post('course_id'),
                            'mentor_id' => $this->input->post('mentor_id'),
                            'email_address' => $email_address,
                            'status' => 'active',
                            'date' => date('Y-m-d H:i:s'),
                         );
            $data = $this->security->xss_clean($data); // xss filter
            $this->Front_model->insertplanner($data);
            $planner_id = $this->db->insert_id();

            if($planner_id){
                $original_exam_date = $this->input->post('exam_date'); // m/d/Y            
                $exam_date = date("Y-m-d", strtotime($original_exam_date));
                $data = array(  'course_id' => $this->input->post('course_id'),
                                'is_scheduled' => $this->input->post('is_scheduled'),
                                'exam_date' => $exam_date,
                                'confidence_level_id' => $this->input->post('confidence_level'),
                             );
                $data = $this->security->xss_clean($data); // xss filter
                $this->Front_model->updateCourse($data,$student_id);
            }

            $mentor_id = $this->input->post('mentor_id');
            $course_id = $this->input->post('course_id');
            if($mentor_id && $planner_id && ($mentor_id != '9999')){
                $mendel = $this->Front_model->getStudentById($mentor_id);
                $pln = $this->Front_model->getPlannerById($planner_id);
                $sb_course = $this->Front_model->getCourseById($course_id);
                $email_to = $mendel->email_address;
                $email_from = 'saramaazkhan123@gmail.com'; 
                $email_name = 'project91';

                $this->load->library('email');  
                $config=array(
                  'charset'=>'utf-8',
                  'wordwrap'=> TRUE,
                  'mailtype' => 'html'
                  );
                $this->email->initialize($config);
                $this->email->from($email_from, $email_name);
                $this->email->set_header('Reply-To', $email_from."\r\n");
                $this->email->set_header('Return-Path', $email_from."\r\n");
                $this->email->set_header('X-Mailer', 'PHP/' . phpversion().'\r\n');
                $this->email->set_header('MIME-Version', '1.0' . "\r\n");
                $this->email->to(strtolower($email_to));
                $this->email->set_mailtype('html');
                $this->email->subject('Planner Request | project91');
                $this->email->message('
                  <!doctype html>
                  <html lang="en-US">

                  <head>
                    <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
                    <title>Planner Request</title>
                    <meta name="description" content="Planner Request">
                    <style type="text/css">
                        a:hover {text-decoration: underline !important;pointer:cursor !important;}
                    </style>
                  </head>

                  <body marginheight="0" topmargin="0" marginwidth="0" style="margin: 0px; background-color: #f2f3f8;" leftmargin="0">
                    <!--100% body table-->
                    <table cellspacing="0" border="0" cellpadding="0" width="100%" bgcolor="#f2f3f8"
                        style="@import url(https://fonts.googleapis.com/css?family=Rubik:300,400,500,700|Open+Sans:300,400,600,700); font-family: Open Sans, sans-serif;">
                        <tr>
                            <td>
                                <table style="background-color: #f2f3f8; max-width:670px;  margin:0 auto;" width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                                    <tr>
                                        <td style="height:80px;">&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td style="text-align:center;">
                                          <a href="'.base_url().'" title="project91" target="_blank">
                                            <img width="50%" src="'.base_url("assets/images/logo-dark-text111.png").'" title="project91" alt="project91">
                                          </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="height:20px;">&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <table width="95%" border="0" align="center" cellpadding="0" cellspacing="0"
                                                style="max-width:670px;background:#fff; border-radius:3px; text-align:center;-webkit-box-shadow:0 6px 18px 0 rgba(0,0,0,.06);-moz-box-shadow:0 6px 18px 0 rgba(0,0,0,.06);box-shadow:0 6px 18px 0 rgba(0,0,0,.06);">
                                                <tr>
                                                    <td style="height:30px;">&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td style="padding:0 35px;">
                                                        <h1 style="color:#336e6a; font-weight:600; margin:0;font-size:30px;font-family:Rubik,sans-serif;">Your expertise are needed...</h1>
                                                        <span
                                                            style="display:inline-block; vertical-align:middle; margin:29px 0 26px; border-bottom:1px solid #cecece; width:100px;"></span>
                                                        <p style="color:#455056; font-size:15px;line-height:24px;text-align:left; margin:0;">
                                                        Hello '.$mendel->first_name.',<br><br>
                                                            '.$studdel->first_name.' '.$studdel->last_name.'  has requested you to be their mentor for a <b>'.$sb_course->name.'</b> study plan. Just click the appropriate button below to accept or ignore the request.
                                                        </p>
                                                        <a href="'.base_url('accept-study-block-request/'.$planner_id.'/'.$student_id.'/'.$mentor_id).'"
                                                            style="background:#3a70d4;text-decoration:none !important; font-weight:500; margin-top:35px; color:#fff;text-transform:uppercase; font-size:14px;padding:12px 40px;display:inline-block;border-radius:10px;">ACCEPT</a>&nbsp;&nbsp;
                                                            <a href="'.base_url('reject-study-block-request/'.$planner_id.'/'.$student_id.'/'.$mentor_id).'"
                                                            style="background:#9fcd53;text-decoration:none !important; font-weight:500; margin-top:35px; color:#fff;text-transform:uppercase; font-size:14px;padding:12px 40px;display:inline-block;border-radius:10px;">IGNORE</a>
                                                            <br><br>
                                                <p style="color:#455056; font-size:15px;line-height:24px;text-align:left;margin:0;">
                                                <br><br>
                                                            Thanks,
                                                            <br>
                                                            The project91 Team
                                                        </p>
                                                        <a href="'.base_url().'" title="project91" target="_blank">
                                                            <img style="float:right;" width="16%" src="'.base_url('assets/images/project91_Round_logo.png').'" title="project91" alt="project91">
                                                        </a>
                                                        
                                                        <p style="float:left; color:#000000; font-size:12px;line-height:24px;text-align:left;margin:0;"><br>
                                                        You received this email because you just signed up for an account. If it looks weird, <a style="color:#3a70d4;" onMouseOver="this.style.pointer=cursor" href="'.base_url().'">view it in your browser</a>
                                                        </p>
                                                        
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="height:30px;">&nbsp;</td>
                                                </tr>
                                            </table>
                                        </td>
                                    <tr>
                                        <td style="height:20px;">&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td style="text-align:center;">
                                        <p style="color:#455056;font-size:10px;line-height:15px;margin:0;">Please note: This e-mail was sent from an auto-notification system that cannot accept incoming e-mail. Do not reply to this message.  You can’t unsubscribe from important emails about your account like this one.</p>
                                        <br><br>
                                            <p style="font-size:14px; color:rgba(69, 80, 86, 0.7411764705882353); line-height:18px; margin:0 0 0;">&copy; <strong>Copyright 2012 – 2021  |  project91, LLC  |  All Rights Reserved </strong></p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="height:80px;">&nbsp;</td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                    <!--/100% body table-->
                  </body>

                  </html>' 
                      );
                $this->email->send();
            } 
            if(($email_address != '') && ($mentor_id == '9999')){
                $pln = $this->Front_model->getPlannerById($planner_id);
                $sb_course = $this->Front_model->getCourseById($course_id);
                $email_to = $email_address;
                $email_from = 'saramaazkhan123@gmail.com'; 
                $email_name = 'project91';

                $this->load->library('email');  
                $config=array(
                  'charset'=>'utf-8',
                  'wordwrap'=> TRUE,
                  'mailtype' => 'html'
                  );
                $this->email->initialize($config);
                $this->email->from($email_from, $email_name);
                $this->email->set_header('Reply-To', $email_from."\r\n");
                $this->email->set_header('Return-Path', $email_from."\r\n");
                $this->email->set_header('X-Mailer', 'PHP/' . phpversion().'\r\n');
                $this->email->set_header('MIME-Version', '1.0' . "\r\n");
                $this->email->to(strtolower($email_to));
                $this->email->set_mailtype('html');
                $this->email->subject('Planner Request | project91');
                $this->email->message('
                  <!doctype html>
                  <html lang="en-US">

                  <head>
                    <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
                    <title>Planner Request</title>
                    <meta name="description" content="Planner Request">
                    <style type="text/css">
                        a:hover {text-decoration: underline !important;pointer:cursor !important;}
                    </style>
                  </head>

                  <body marginheight="0" topmargin="0" marginwidth="0" style="margin: 0px; background-color: #f2f3f8;" leftmargin="0">
                    <!--100% body table-->
                    <table cellspacing="0" border="0" cellpadding="0" width="100%" bgcolor="#f2f3f8"
                        style="@import url(https://fonts.googleapis.com/css?family=Rubik:300,400,500,700|Open+Sans:300,400,600,700); font-family: Open Sans, sans-serif;">
                        <tr>
                            <td>
                                <table style="background-color: #f2f3f8; max-width:670px;  margin:0 auto;" width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                                    <tr>
                                        <td style="height:80px;">&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td style="text-align:center;">
                                          <a href="'.base_url().'" title="project91" target="_blank">
                                            <img width="50%" src="'.base_url("assets/images/logo-dark-text111.png").'" title="project91" alt="project91">
                                          </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="height:20px;">&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <table width="95%" border="0" align="center" cellpadding="0" cellspacing="0"
                                                style="max-width:670px;background:#fff; border-radius:3px; text-align:center;-webkit-box-shadow:0 6px 18px 0 rgba(0,0,0,.06);-moz-box-shadow:0 6px 18px 0 rgba(0,0,0,.06);box-shadow:0 6px 18px 0 rgba(0,0,0,.06);">
                                                <tr>
                                                    <td style="height:30px;">&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td style="padding:0 35px;">
                                                        <h1 style="color:#336e6a; font-weight:600; margin:0;font-size:30px;font-family:Rubik,sans-serif;">Your expertise are needed...</h1>
                                                        <span
                                                            style="display:inline-block; vertical-align:middle; margin:29px 0 26px; border-bottom:1px solid #cecece; width:100px;"></span>
                                                        <p style="color:#455056; font-size:15px;line-height:24px;text-align:left; margin:0;">
                                                        Hello,<br><br>
                                                            '.$studdel->first_name.' '.$studdel->last_name.'  has requested you to be their mentor for a <b>'.$sb_course->name.'</b> study plan. Just click the appropriate button below to accept or ignore the request.
                                                        </p>
                                                        <a href="'.base_url('login-register').'"
                                                            style="background:#3a70d4;text-decoration:none !important; font-weight:500; margin-top:35px; color:#fff;text-transform:uppercase; font-size:14px;padding:12px 40px;display:inline-block;border-radius:10px;">ACCEPT</a>&nbsp;&nbsp;
                                                            <a href="'.base_url('reject-study-block-request/'.$planner_id.'/'.$student_id.'/'.$mentor_id).'"
                                                            style="background:#9fcd53;text-decoration:none !important; font-weight:500; margin-top:35px; color:#fff;text-transform:uppercase; font-size:14px;padding:12px 40px;display:inline-block;border-radius:10px;">IGNORE</a>
                                                            <br><br>
                                                <p style="color:#455056; font-size:15px;line-height:24px;text-align:left;margin:0;">
                                                <br><br>
                                                            Thanks,
                                                            <br>
                                                            The project91 Team
                                                        </p>
                                                        <a href="'.base_url().'" title="project91" target="_blank">
                                                            <img style="float:right;" width="16%" src="'.base_url('assets/images/project91_Round_logo.png').'" title="project91" alt="project91">
                                                        </a>
                                                        
                                                        <p style="float:left; color:#000000; font-size:12px;line-height:24px;text-align:left;margin:0;"><br>
                                                        You received this email because you just signed up for an account. If it looks weird, <a style="color:#3a70d4;" onMouseOver="this.style.pointer=cursor" href="'.base_url().'">view it in your browser</a>
                                                        </p>
                                                        
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="height:30px;">&nbsp;</td>
                                                </tr>
                                            </table>
                                        </td>
                                    <tr>
                                        <td style="height:20px;">&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td style="text-align:center;">
                                        <p style="color:#455056;font-size:10px;line-height:15px;margin:0;">Please note: This e-mail was sent from an auto-notification system that cannot accept incoming e-mail. Do not reply to this message.  You can’t unsubscribe from important emails about your account like this one.</p>
                                        <br><br>
                                            <p style="font-size:14px; color:rgba(69, 80, 86, 0.7411764705882353); line-height:18px; margin:0 0 0;">&copy; <strong>Copyright 2012 – 2021  |  project91, LLC  |  All Rights Reserved </strong></p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="height:80px;">&nbsp;</td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                    <!--/100% body table-->
                  </body>

                  </html>' 
                      );
                $this->email->send();
            } 
            $this->session->set_flashdata('message', 'Planner Created Successfully');
            $response['status'] = TRUE;
            header('Content-type: application/json');
            echo json_encode($response); 
        }
    }

    public function insert_edit_planner() //Edit Planner Details
    {
        $this->form_validation->set_rules('title','Title','trim|required');
        $this->form_validation->set_rules('course_id','Exam','trim|required');
        $this->form_validation->set_rules('mentor_id','Mentor','trim');
        
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
            $planner_id = $this->input->post('planner_id'); 
            $email_address = $this->input->post('email_address');
            $pln = $this->Front_model->getPlannerById($planner_id);
            $prev_mentor = $pln->mentor_id;
            $prev_mentor_email = $pln->email_address;
            $mentor_id = $this->input->post('mentor_id');
            $student_id = $this->session->userdata('student_id');
            $studdel = $this->Front_model->getStudentById($student_id);            
            $course_id = $this->input->post('course_id');
            $sb_course = $this->Front_model->getCourseById($course_id);
            if(($prev_mentor != $mentor_id) || ($email_address != "")){
                $mentor_request = '';
            }else{
                $mentor_request = $pln->mentor_request;
            }
            $data = array(  'student_id' => $student_id,
                            'title' => $this->input->post('title'),
                            'course_id' => $this->input->post('course_id'),
                            'mentor_id' => $this->input->post('mentor_id'),
                            'email_address' => $email_address,
                            'mentor_request' => $mentor_request,
                            'status' => 'active',
                            'date' => date('Y-m-d H:i:s'),
                         );
            $data = $this->security->xss_clean($data); // xss filter
            $this->Front_model->updatePlanner($data,$planner_id);
            $pln = $this->Front_model->getPlannerById($planner_id);            
            if(($prev_mentor != $mentor_id) && ($mentor_id != 0) && ($mentor_id != '9999')){
                $mendel = $this->Front_model->getStudentById($mentor_id);
                $email_to = $mendel->email_address;
                $email_from = 'saramaazkhan123@gmail.com'; 
                $email_name = 'project91';

                $this->load->library('email');  
                $config=array(
                  'charset'=>'utf-8',
                  'wordwrap'=> TRUE,
                  'mailtype' => 'html'
                  );
                $this->email->initialize($config);
                $this->email->from($email_from, $email_name);
                $this->email->set_header('Reply-To', $email_from."\r\n");
                $this->email->set_header('Return-Path', $email_from."\r\n");
                $this->email->set_header('X-Mailer', 'PHP/' . phpversion().'\r\n');
                $this->email->set_header('MIME-Version', '1.0' . "\r\n");
                $this->email->to(strtolower($email_to));
                $this->email->set_mailtype('html');
                $this->email->subject('Planner Request | project91');
                $this->email->message('
                    <!doctype html>
                      <html lang="en-US">

                      <head>
                        <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
                        <title>Planner Request</title>
                        <meta name="description" content="Planner Request">
                        <style type="text/css">
                            a:hover {text-decoration: underline !important;pointer:cursor !important;}
                        </style>
                      </head>

                      <body marginheight="0" topmargin="0" marginwidth="0" style="margin: 0px; background-color: #f2f3f8;" leftmargin="0">
                        <!--100% body table-->
                        <table cellspacing="0" border="0" cellpadding="0" width="100%" bgcolor="#f2f3f8"
                            style="@import url(https://fonts.googleapis.com/css?family=Rubik:300,400,500,700|Open+Sans:300,400,600,700); font-family: Open Sans, sans-serif;">
                            <tr>
                                <td>
                                    <table style="background-color: #f2f3f8; max-width:670px;  margin:0 auto;" width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                                        <tr>
                                            <td style="height:80px;">&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td style="text-align:center;">
                                              <a href="'.base_url().'" title="project91" target="_blank">
                                                <img width="50%" src="'.base_url("assets/images/logo-dark-text111.png").'" title="project91" alt="project91">
                                              </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="height:20px;">&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <table width="95%" border="0" align="center" cellpadding="0" cellspacing="0"
                                                    style="max-width:670px;background:#fff; border-radius:3px; text-align:center;-webkit-box-shadow:0 6px 18px 0 rgba(0,0,0,.06);-moz-box-shadow:0 6px 18px 0 rgba(0,0,0,.06);box-shadow:0 6px 18px 0 rgba(0,0,0,.06);">
                                                    <tr>
                                                        <td style="height:30px;">&nbsp;</td>
                                                    </tr>
                                                    <tr>
                                                        <td style="padding:0 35px;">
                                                            <h1 style="color:#336e6a; font-weight:600; margin:0;font-size:30px;font-family:Rubik,sans-serif;">Your expertise are needed...</h1>
                                                            <span
                                                                style="display:inline-block; vertical-align:middle; margin:29px 0 26px; border-bottom:1px solid #cecece; width:100px;"></span>
                                                            <p style="color:#455056; font-size:15px;line-height:24px;text-align:left; margin:0;">
                                                            Hello '.$mendel->first_name.',<br><br>
                                                                '.$studdel->first_name.' '.$studdel->last_name.' has requested you to be their mentor for a <b>'.$sb_course->name.'</b> study plan. Just click the appropriate button below to accept or ignore the request.
                                                            </p>
             
                                                            <a href="'.base_url('accept-study-block-request/'.$planner_id.'/'.$student_id.'/'.$mentor_id).'"
                                                                style="background:#3a70d4;text-decoration:none !important; font-weight:500; margin-top:35px; color:#fff;text-transform:uppercase; font-size:14px;padding:12px 40px;display:inline-block;border-radius:10px;">ACCEPT</a>&nbsp;&nbsp;
                                                                <a href="'.base_url('reject-study-block-request/'.$planner_id.'/'.$student_id.'/'.$mentor_id).'"
                                                                style="background:#9fcd53;text-decoration:none !important; font-weight:500; margin-top:35px; color:#fff;text-transform:uppercase; font-size:14px;padding:12px 40px;display:inline-block;border-radius:10px;">IGNORE</a>
                                                                <br><br>
                                                    <p style="color:#455056; font-size:15px;line-height:24px;text-align:left;margin:0;">
                                                    <br><br>
                                                        Thanks,
                                                        <br>
                                                        The project91 Team
                                                    </p>
                                                    <a href="'.base_url().'" title="project91" target="_blank">
                                                        <img style="float:right;" width="16%" src="'.base_url('assets/images/project91_Round_logo.png').'" title="project91" alt="project91">
                                                    </a>
                                                    
                                                    <p style="float:left; color:#000000; font-size:12px;line-height:24px;text-align:left;margin:0;"><br>
                                                    You received this email because you just signed up for an account. If it looks weird, <a style="color:#3a70d4;" onMouseOver="this.style.pointer=cursor" href="'.base_url().'">view it in your browser</a>
                                                    </p>
                                                            
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="height:30px;">&nbsp;</td>
                                                    </tr>
                                                </table>
                                            </td>
                                        <tr>
                                            <td style="height:20px;">&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td style="text-align:center;">
                                            <p style="color:#455056;font-size:10px;line-height:15px;margin:0;">Please note: This e-mail was sent from an auto-notification system that cannot accept incoming e-mail. Do not reply to this message.  You can’t unsubscribe from important emails about your account like this one.</p>
                                            <br><br>
                                                <p style="font-size:14px; color:rgba(69, 80, 86, 0.7411764705882353); line-height:18px; margin:0 0 0;">&copy; <strong>Copyright 2012 – 2021  |  project91, LLC  |  All Rights Reserved </strong></p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="height:80px;">&nbsp;</td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                        <!--/100% body table-->
                      </body>

                      </html>' 
                      );
                $this->email->send();
            }
            if(($prev_mentor != $mentor_id) && ($mentor_id != 0) && ($prev_mentor_email != $email_address) && ($email_address != '') && ($mentor_id == '9999')){
                $pln = $this->Front_model->getPlannerById($planner_id);
                $email_to = $email_address;
                $email_from = 'saramaazkhan123@gmail.com'; 
                $email_name = 'project91';

                $this->load->library('email');  
                $config=array(
                  'charset'=>'utf-8',
                  'wordwrap'=> TRUE,
                  'mailtype' => 'html'
                  );
                $this->email->initialize($config);
                $this->email->from($email_from, $email_name);
                $this->email->set_header('Reply-To', $email_from."\r\n");
                $this->email->set_header('Return-Path', $email_from."\r\n");
                $this->email->set_header('X-Mailer', 'PHP/' . phpversion().'\r\n');
                $this->email->set_header('MIME-Version', '1.0' . "\r\n");
                $this->email->to(strtolower($email_to));
                $this->email->set_mailtype('html');
                $this->email->subject('Planner Request | project91');
                $this->email->message('
                    <!doctype html>
                      <html lang="en-US">

                      <head>
                        <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
                        <title>Planner Request</title>
                        <meta name="description" content="Planner Request">
                        <style type="text/css">
                            a:hover {text-decoration: underline !important;pointer:cursor !important;}
                        </style>
                      </head>

                      <body marginheight="0" topmargin="0" marginwidth="0" style="margin: 0px; background-color: #f2f3f8;" leftmargin="0">
                        <!--100% body table-->
                        <table cellspacing="0" border="0" cellpadding="0" width="100%" bgcolor="#f2f3f8"
                            style="@import url(https://fonts.googleapis.com/css?family=Rubik:300,400,500,700|Open+Sans:300,400,600,700); font-family: Open Sans, sans-serif;">
                            <tr>
                                <td>
                                    <table style="background-color: #f2f3f8; max-width:670px;  margin:0 auto;" width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                                        <tr>
                                            <td style="height:80px;">&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td style="text-align:center;">
                                              <a href="'.base_url().'" title="project91" target="_blank">
                                                <img width="50%" src="'.base_url("assets/images/logo-dark-text111.png").'" title="project91" alt="project91">
                                              </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="height:20px;">&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <table width="95%" border="0" align="center" cellpadding="0" cellspacing="0"
                                                    style="max-width:670px;background:#fff; border-radius:3px; text-align:center;-webkit-box-shadow:0 6px 18px 0 rgba(0,0,0,.06);-moz-box-shadow:0 6px 18px 0 rgba(0,0,0,.06);box-shadow:0 6px 18px 0 rgba(0,0,0,.06);">
                                                    <tr>
                                                        <td style="height:30px;">&nbsp;</td>
                                                    </tr>
                                                    <tr>
                                                        <td style="padding:0 35px;">
                                                            <h1 style="color:#336e6a; font-weight:600; margin:0;font-size:30px;font-family:Rubik,sans-serif;">Your expertise are needed...</h1>
                                                            <span
                                                                style="display:inline-block; vertical-align:middle; margin:29px 0 26px; border-bottom:1px solid #cecece; width:100px;"></span>
                                                            <p style="color:#455056; font-size:15px;line-height:24px;text-align:left; margin:0;">
                                                            Hello,<br><br>
                                                                '.$studdel->first_name.' '.$studdel->last_name.'  has requested you to be their mentor for a <b>'.$sb_course->name.'</b> study plan. Just click the appropriate button below to accept or ignore the request.
                                                            </p>
                                                            <a href="'.base_url('login-register').'"
                                                                style="background:#3a70d4;text-decoration:none !important; font-weight:500; margin-top:35px; color:#fff;text-transform:uppercase; font-size:14px;padding:12px 40px;display:inline-block;border-radius:10px;">ACCEPT</a>&nbsp;&nbsp;
                                                                <a href="'.base_url('reject-study-block-request/'.$planner_id.'/'.$student_id.'/'.$mentor_id).'"
                                                                style="background:#9fcd53;text-decoration:none !important; font-weight:500; margin-top:35px; color:#fff;text-transform:uppercase; font-size:14px;padding:12px 40px;display:inline-block;border-radius:10px;">IGNORE</a>
                                                                <br><br>
                                                    <p style="color:#455056; font-size:15px;line-height:24px;text-align:left;margin:0;">
                                                    <br><br>
                                                                Thanks,
                                                                <br>
                                                                The project91 Team
                                                            </p>
                                                            <a href="'.base_url().'" title="project91" target="_blank">
                                                                <img style="float:right;" width="16%" src="'.base_url('assets/images/project91_Round_logo.png').'" title="project91" alt="project91">
                                                            </a>
                                                            
                                                            <p style="float:left; color:#000000; font-size:12px;line-height:24px;text-align:left;margin:0;"><br>
                                                            You received this email because you just signed up for an account. If it looks weird, <a style="color:#3a70d4;" onMouseOver="this.style.pointer=cursor" href="'.base_url().'">view it in your browser</a>
                                                            </p>
                                                            
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="height:30px;">&nbsp;</td>
                                                    </tr>
                                                </table>
                                            </td>
                                        <tr>
                                            <td style="height:20px;">&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td style="text-align:center;">
                                            <p style="color:#455056;font-size:10px;line-height:15px;margin:0;">Please note: This e-mail was sent from an auto-notification system that cannot accept incoming e-mail. Do not reply to this message.  You can’t unsubscribe from important emails about your account like this one.</p>
                                            <br><br>
                                                <p style="font-size:14px; color:rgba(69, 80, 86, 0.7411764705882353); line-height:18px; margin:0 0 0;">&copy; <strong>Copyright 2012 – 2021  |  project91, LLC  |  All Rights Reserved </strong></p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="height:80px;">&nbsp;</td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                        <!--/100% body table-->
                      </body>

                      </html>' 
                      );
                $this->email->send();
            } 
            $this->session->set_flashdata('message', 'Planner Updated Successfully');
            $response['status'] = TRUE;
            header('Content-type: application/json');
            echo json_encode($response);
        }
    }

    public function delete_planner() //Delete Planner
    {
        $planner_id = $this->input->post('planner_id');
        $this->Front_model->deletePlanner($planner_id);
    }

    public function study_blocks()
    {
        if(($this->session->userdata('student_id')) || ($this->session->userdata('student_id') != ""))
        {
            $student_id = $this->session->userdata('student_id');
            $planner_id = $this->uri->segment(2);
            $data['stud_del'] = $this->Front_model->getStudentById($student_id);
            $stud_mod = $this->Front_model->getStudentModuleCount($student_id);
            if($stud_mod > 0){
                $data['allocator_mod'] = $this->Front_model->getModuleByStudId($student_id,1);
                $data['scheduler_mod'] = $this->Front_model->getModuleByStudId($student_id,2);
                $data['motivator'] = $this->Front_model->getRandMotivator();   
                $data['study_block'] = $this->Front_model->getPlannerStudyBlock($planner_id,$student_id);
                $data['time_12hrs'] = $this->Front_model->gettime_12hrs();
                $data['duration'] = $this->Front_model->getDuration();
                $this->load->view('user/study_block',$data);
            }else{
                redirect(base_url('complete-process'));
            }           
        }else{
            redirect(base_url('login-register'));
        }
    }

    public function insert_study_block() //Insert Study Block Details
    {
        $this->form_validation->set_rules('course_id','Exam','trim|required');
        $this->form_validation->set_rules('subject_id','Subject','trim|required');
        $this->form_validation->set_rules('planner_task_id','Task','trim|required');
        $this->form_validation->set_rules('notes','Notes','trim');
        $this->form_validation->set_rules('start_date','Start date','trim|required');
        $this->form_validation->set_rules('start_time','Start time','trim|required');
        $this->form_validation->set_rules('duration','Duration','trim|required');
        $this->form_validation->set_rules('timer','Timer','trim');
        $this->form_validation->set_rules('reminder','Reminder','trim');
        $this->form_validation->set_rules('files','Files','trim');
        
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
            $original_start_date = $this->input->post('start_date'); // m/d/Y            
            $start_date = date("Y-m-d", strtotime($original_start_date));
            $start_time  = date("H:i:s", strtotime($this->input->post('start_time')));

            $student_id = $this->session->userdata('student_id');
            $studdel = $this->Front_model->getStudentById($student_id);
            $study_block_files = '';

            $this->load->library('upload');
            $dataInfo = array();
            $files = $_FILES;

            if(!empty($_FILES['files']['name'][0])){

                $cpt = count($_FILES['files']['name']);

                for($i=0; $i<$cpt; $i++)
                {
                    if($files['files']['size'][$i] >  2100000){
                        $response['status'] = 'filesErr';
                        $response['filesErr'] = $files['files']['name'][$i].' File size should be less than 20MB';
                        header('Content-type: application/json');
                        exit(json_encode($response));
                    }else{}
                }
                for($i=0; $i<$cpt; $i++)
                {           
                    $_FILES['files']['name']= $files['files']['name'][$i];
                    $_FILES['files']['type']= $files['files']['type'][$i];
                    $_FILES['files']['tmp_name']= $files['files']['tmp_name'][$i];
                    $_FILES['files']['error']= $files['files']['error'][$i];
                    $_FILES['files']['size']= $files['files']['size'][$i];    

                    $this->upload->initialize($this->planner_upload());
                    if($this->upload->do_upload('files'))
                    {
                        $fileData = $this->upload->data();
                        $uploadDataa[$i]['ffimage'] = $fileData['file_name'];
                    }
                    else
                    {
                        $response['status'] = 'filesErr';
                        $response['filesErr'] = $files['files']['name'][$i].' File size should be less than 20MB of Image '.$i;
                        header('Content-type: application/json');
                        exit(json_encode($response));
                    }
                    
                }
                if(is_array($uploadDataa)){
                    $study_block_files = implode(', ', array_column($uploadDataa, 'ffimage'));
                } 
            }

            $student_id = $this->session->userdata('student_id');
            $data = array(  'student_id' => $student_id,
                            'planner_id' => $this->input->post('planner_id'),
                            'course_id' => $this->input->post('course_id'),
                            'subject_id' => $this->input->post('subject_id'),
                            'planner_task_id' => $this->input->post('planner_task_id'),
                            'notes' => $this->input->post('notes'),
                            'start_date' => $start_date,
                            'start_time' => $start_time,
                            'duration' => $this->input->post('duration'),
                            'timer' => $this->input->post('timer'),
                            'reminder' => $this->input->post('reminder'),
                            'files' => $study_block_files,
                            'status' => 'active',
                            'date' => date('Y-m-d H:i:s'),
                         );
            $data = $this->security->xss_clean($data); // xss filter
            $this->Front_model->insertStudyBlock($data);
            $study_block_id = $this->db->insert_id();
            $this->session->set_flashdata('message', 'Study Block Created Successfully');
            $response['sid'] = $study_block_id;
            $response['status'] = TRUE;
            header('Content-type: application/json');
            echo json_encode($response); 
        }
    }

    public function insert_edit_study_block() //Edit Study Block Details
    {
        $this->form_validation->set_rules('course_id','Exam','trim|required');
        $this->form_validation->set_rules('subject_id','Subject','trim|required');
        $this->form_validation->set_rules('planner_task_id','Task','trim|required');
        $this->form_validation->set_rules('notes','Notes','trim');
        $this->form_validation->set_rules('start_date','Start date','trim|required');
        $this->form_validation->set_rules('start_time','Start time','trim|required');
        $this->form_validation->set_rules('duration','Duration','trim|required');
        $this->form_validation->set_rules('timer','Timer','trim');
        $this->form_validation->set_rules('reminder','Reminder','trim');
        $this->form_validation->set_rules('files','Files','trim');
        
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
            $planner_id = $this->input->post('planner_id');    
            $study_block_id = $this->input->post('study_block_id'); 

            $original_start_date = $this->input->post('start_date'); // m/d/Y            
            $start_date = date("Y-m-d", strtotime($original_start_date));
            $start_time  = date("H:i:s", strtotime($this->input->post('start_time')));

            $student_id = $this->session->userdata('student_id');
            $studdel = $this->Front_model->getStudentById($student_id);
            
            $sb = $this->Front_model->getStudyBlockById($study_block_id);
            $study_block_files = $sb->files;

            $this->load->library('upload');
            $dataInfo = array();
            $files = $_FILES;

            if(!empty($_FILES['files']['name'][0])){

                $cpt = count($_FILES['files']['name']);

                for($i=0; $i<$cpt; $i++)
                {
                    if($files['files']['size'][$i] >  2100000){
                        $response['status'] = 'filesErr';
                        $response['filesErr'] = $files['files']['name'][$i].' File size should be less than 20MB';
                        header('Content-type: application/json');
                        exit(json_encode($response));
                    }else{}
                }
                for($i=0; $i<$cpt; $i++)
                {           
                    $_FILES['files']['name']= $files['files']['name'][$i];
                    $_FILES['files']['type']= $files['files']['type'][$i];
                    $_FILES['files']['tmp_name']= $files['files']['tmp_name'][$i];
                    $_FILES['files']['error']= $files['files']['error'][$i];
                    $_FILES['files']['size']= $files['files']['size'][$i];    

                    $this->upload->initialize($this->planner_upload());
                    if($this->upload->do_upload('files'))
                    {
                        $fileData = $this->upload->data();
                        $uploadDataa[$i]['ffimage'] = $fileData['file_name'];
                    }
                    else
                    {
                        $response['status'] = 'filesErr';
                        $response['filesErr'] = $files['files']['name'][$i].' File size should be less than 20MB of Image '.$i;
                        header('Content-type: application/json');
                        exit(json_encode($response));
                    }
                    
                }
                if(is_array($uploadDataa)){
                    $study_block_files_2 = implode(', ', array_column($uploadDataa, 'ffimage'));
                    if(!empty($study_block_files)){
                        $study_block_files = $study_block_files.', '.$study_block_files_2;
                    }else{
                        $study_block_files = $study_block_files_2;
                    }
                } 
            }

            $student_id = $this->session->userdata('student_id');
            $data = array(  'student_id' => $student_id,
                            'planner_id' => $this->input->post('planner_id'),
                            'course_id' => $this->input->post('course_id'),
                            'subject_id' => $this->input->post('subject_id'),
                            'planner_task_id' => $this->input->post('planner_task_id'),
                            'notes' => $this->input->post('notes'),
                            'start_date' => $start_date,
                            'start_time' => $start_time,
                            'duration' => $this->input->post('duration'),
                            'timer' => $this->input->post('timer'),
                            'reminder' => $this->input->post('reminder'),
                            'files' => $study_block_files,
                            'status' => 'active',
                            'date' => date('Y-m-d H:i:s'),
                         );
            $data = $this->security->xss_clean($data); // xss filter
            $this->Front_model->updateStudyBlock($data,$study_block_id);
            $this->session->set_flashdata('message', 'Study Block Updated Successfully');
            $response['sid'] = $study_block_id;
            $response['status'] = TRUE;
            header('Content-type: application/json');
            echo json_encode($response); 
        }
    }

    public function view_study_block()
    {
        if(($this->session->userdata('student_id')) || ($this->session->userdata('student_id') != ""))
        {
            $student_id = $this->session->userdata('student_id');
            $data['stud_del'] = $this->Front_model->getStudentById($student_id);
            $stud_mod = $this->Front_model->getStudentModuleCount($student_id);
            if($stud_mod > 0){
                $data['allocator_mod'] = $this->Front_model->getModuleByStudId($student_id,1);
                $data['scheduler_mod'] = $this->Front_model->getModuleByStudId($student_id,2);
                $data['motivator'] = $this->Front_model->getRandMotivator();   
                $study_block_id = $this->uri->segment(2);
                $data['sb'] = $this->Front_model->getStudyBlockById($study_block_id);
                $data['planner_task'] = $this->Front_model->getPlannerTask();
                $data['time_12hrs'] = $this->Front_model->gettime_12hrs();
                $data['duration'] = $this->Front_model->getDuration();
                $this->load->view('user/view_study_block',$data);
            }else{
                redirect(base_url('complete-process'));
            }           
        }else{
            redirect(base_url('login-register'));
        }
    }
    public function delete_study_block() //Delete Study Block
    {
        $study_block_id = $this->input->post('study_block_id');
        $this->Front_model->deleteStudyBlock($study_block_id);
    }



}
/* End of file Front.php */
/* Location: ./application/controllers/Front.php */
?>