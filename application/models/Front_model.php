<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Front_model extends CI_Model {


	function insertCourse($data){
		if($this->db->insert('student_course',$data)){
			return TRUE;
		}else{
			return FALSE;
		}
	}

	function insertEvent($data){
		if($this->db->insert('events',$data)){
			return TRUE;
		}else{
			return FALSE;
		}
	}

	function insertModule($data){
		if($this->db->insert('student_module',$data)){
			return TRUE;
		}else{
			return FALSE;
		}
	}

		
	function updateRegistration($data,$id)
	{
		$this->db->where('reg_id', $id);
		$this->db->update('registration',$data);
	}

	function insertDraggableEvent($data){
		if($this->db->insert('draggable_events',$data)){
			return TRUE;
		}else{
			return FALSE;
		}
	}

	function insertDailyActivity($data){
		if($this->db->insert('daily_activities',$data)){
			return TRUE;
		}else{
			return FALSE;
		}
	}

	function insertTask($data){
		if($this->db->insert('tasks',$data)){
			return TRUE;
		}else{
			return FALSE;
		}
	}

	function insertComment($data){
		if($this->db->insert('comments',$data)){
			return TRUE;
		}else{
			return FALSE;
		}
	}

	function insertplanner($data){
		if($this->db->insert('planner',$data)){
			return TRUE;
		}else{
			return FALSE;
		}
	}

	function insertStudyBlock($data){
		if($this->db->insert('study_block',$data)){
			return TRUE;
		}else{
			return FALSE;
		}
	}

	function insertplannerMember($data){
		if($this->db->insert('planner_members',$data)){
			return TRUE;
		}else{
			return FALSE;
		}
	}

	function checkLogin($email,$password)
	{
		$this->db->where('email_address', $email);
		$this->db->where('password', $password);
		$query = $this->db->get('registration');
		return $query->num_rows();
	}

	function selectLogin($email)
	{
		$this->db->where('email_address', $email);
		$query = $this->db->get('registration');
		return $query->row();
	}

	function getStudentById($id)
	{
		$this->db->where('reg_id', $id);
		$query = $this->db->get('registration');
		return $query->row();
	}

	function getStudentModuleById($student_id)
	{
		$this->db->where('student_id', $student_id);
		$this->db->where('status', 'active');
		$query = $this->db->get('student_module');
		return $query->result();
	}

	function getStudentModuleCount($id)
	{
		$this->db->where('student_id', $id);
		$this->db->where('status', 'active');
		$query = $this->db->get('student_module');
		return $query->num_rows();
	}

	function getModuleByStudId($student_id,$module_id)
	{
		$this->db->where('student_id', $student_id);
		$this->db->where('module_id', $module_id);
		$this->db->where('status', 'active');
		$query = $this->db->get('student_module');
		return $query->num_rows();
	}

	function getSchoolNames()
	{
		$this->db->where('status', 'active');
		$query = $this->db->get('school_names');
		return $query->result();
	}
	function getModules()
	{
		$this->db->where('status', 'active');
		$query = $this->db->get('module');
		return $query->result();
	}

	function getHearFrom()
	{
		$this->db->where('status', 'active');
		$query = $this->db->get('hear_from');
		return $query->result();
	}
	function getCourses()
	{
		$this->db->where('status', 'active');
		$query = $this->db->get('courses');
		return $query->result();
	}

	function getStudentPlanner($id)
	{
		$this->db->where('student_id', $id);
		$this->db->where('status', 'active');
		$query = $this->db->get('planner');
		return $query->result();
	}

	function getPlannerStudyBlock($planner_id,$student_id)
	{
		$this->db->where('planner_id', $planner_id);
		$this->db->where('student_id', $student_id);
		$this->db->where('status', 'active');
		$query = $this->db->get('study_block');
		return $query->result();
	}

	function getPlannerTask()
	{
		$this->db->where('status', 'active');
		$query = $this->db->get('planner_task');
		return $query->result();
	}

	function getTeamMembers($student_id)
	{
		$this->db->where('verified', 'yes');
		$this->db->where('reg_id !=', $student_id);
		$query = $this->db->get('registration');
		return $query->result();
	}

	function getSubjectByCid($course_id)
	{
		$this->db->where('course_id', $course_id);
		$query = $this->db->get('subjects');
		return $query->result();
	}

	function getCourseById($id)
	{
		$this->db->where('id', $id);
		$query = $this->db->get('courses');
		return $query->row();
	}

	function getSubjectById($id)
	{
		$this->db->where('id', $id);
		$query = $this->db->get('subjects');
		return $query->row();
	}

	function getPlannerTaskById($id)
	{
		$this->db->where('id', $id);
		$query = $this->db->get('planner_task');
		return $query->row();
	}

	function deletePlanner($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('planner');
	}

	function deleteStudyBlock($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('study_block');
	}

	function deletePlannerMembersByPid($pid)
	{
		$this->db->where('planner_id', $pid);
		$this->db->delete('planner_members');
	}

	function getPlannerById($id)
	{
		$this->db->where('id', $id);
		$query = $this->db->get('planner');
		return $query->row();
	}

	function updateStudyBlock($data,$study_block_id)
	{
		$this->db->where('id', $study_block_id);
		$this->db->update('study_block',$data);
	}

	function getStudyBlockById($study_block_id)
	{
		$this->db->where('id', $study_block_id);
		$query = $this->db->get('study_block');
		return $query->row();
	}


	function getConfidenceLevel()
	{
		$this->db->where('status', 'active');
		$query = $this->db->get('confidence_level');
		return $query->result();
	}

	function getConfidenceLevelById($id)
	{
		$this->db->where('status', 'active');
		$this->db->where('id', $id);
		$query = $this->db->get('confidence_level');
		return $query->row();
	}

	function getDailyActivities($student_id)
	{
		$this->db->where('status', 'active');
		$this->db->where('student_id', $student_id);
		$this->db->or_where('student_id', 0);
		$query = $this->db->get('daily_activities');
		return $query->result();
	}

	function getModuleById($id)
	{
		$this->db->where('status', 'active');
		$this->db->where('id', $id);
		$query = $this->db->get('module');
		return $query->row();
	}

	function updateEvent($data,$id)
	{
		$this->db->where('id', $id);
		$this->db->update('events',$data);
	}

	function getActiveEvents($id)
	{
		$this->db->where('student_id', $id);
		$this->db->where('status', 'active');
		$this->db->order_by('event_start_date DESC, event_start_time DESC, id DESC');
		$query = $this->db->get('events');
		return $query->result();
	}

	function getCalendarMonthEvents($id,$month_year)
	{
		$this->db->where('student_id', $id);
		$this->db->where('status', 'active');
		$this->db->group_start();
		$this->db->like('date_array', $month_year); 
		// $this->db->or_like('event_end_date', $month_year); 
		$this->db->group_end();
		$query = $this->db->get('events');
		return $query->result();
		
	}

	function getMontsWithcycle($id)
	{
		// $this->db->select('registration.*,events.*');
		// $this->db->from('registration');
		// $this->db->join('events', 'registration.reg_id ='.$id); 
		// $query = $this->db->get();
		// return $query->result();

		$this->db->where('reg_id', $id);
		$this->db->where('verified', 'yes');
		$query = $this->db->get('registration');
		return $query->result();

	}

	function getCalendarDlEvents($id,$day_list)
	{
		$this->db->where('student_id', $id);
		$this->db->where('status', 'active');
	    $this->db->group_start();
		$this->db->where('event_start_date', $day_list); 
		$this->db->or_like('event_start_date', date("Y-m", strtotime($day_list))); 
		$this->db->or_like('event_end_date', date("Y-m", strtotime($day_list))); 
		$this->db->group_end();
		$query = $this->db->get('events');
		return $query->result();
	}

	function getCalendarWeekEvents($student_id,$date1,$date2)
	{
		$d1=date("Y-m", strtotime($date1));
		$d2=date("Y-m", strtotime($date2));
		$this->db->where('student_id', $student_id);
		$this->db->where('status', 'active');
		$this->db->group_start();
		$this->db->where("event_start_date BETWEEN '$date1' AND '$date2'"); 
		$this->db->or_where("'$date1' BETWEEN event_start_date AND event_end_date"); 
		$this->db->or_where("'$date2' BETWEEN event_start_date AND event_end_date"); 
		$this->db->group_end();
		$query = $this->db->get('events');
		return $query->result();
	}

	function getDraggableEvents($id)
	{
		$this->db->where('student_id', $id);
		$this->db->where('show_draggable_event', 1);
		$this->db->where('status', 'active');
		$query = $this->db->get('draggable_events');
		return $query->result();
	}

	function deleteEvent($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('events');
	}

	function getEventById($id)
	{
		$this->db->where('id', $id);
		$query = $this->db->get('events');
		return $query->row();
	}

	function getActiveTasks($id)
	{
		$this->db->where('student_id', $id);
		$this->db->where('task_start_date >=', date('Y-m-d'));
		$this->db->where('is_completed !=', 'yes');
		$this->db->where('status', 'active');
		$this->db->order_by('task_start_date ASC, task_start_time ASC, id ASC');
		$query = $this->db->get('tasks');
		return $query->result();
	}

	function getCompletedTasks($id)
	{
		$this->db->where('student_id', $id);
		$this->db->where('is_completed', 'yes');
		$this->db->where('status', 'active');
		$this->db->order_by('task_start_date ASC, task_start_time ASC, id ASC');
		$query = $this->db->get('tasks');
		return $query->result();
	}

	function getOverdueTasks($id)
	{
		$this->db->where('student_id', $id);
		$this->db->where('task_start_date <', date('Y-m-d'));
		$this->db->where('is_completed !=', 'yes');
		$this->db->where('status', 'active');
		$this->db->order_by('task_start_date ASC, task_start_time ASC, id ASC');
		$query = $this->db->get('tasks');
		return $query->result();
	}

	function getEventTasks($id,$event_id)
	{
		$this->db->where('student_id',$id);
		$this->db->where('event_id',$event_id);
		$this->db->where('status', 'active');
		$this->db->order_by('task_start_date ASC, task_start_time ASC, id ASC');
		$query = $this->db->get('tasks');
		return $query->result();
	}

	function getCompletetaskCount($id,$event_id)
	{
		$this->db->where('student_id',$id);
		$this->db->where('event_id',$event_id);
		$this->db->where('is_completed', 'yes');
		$this->db->where('status', 'active');
		$query = $this->db->get('tasks');
		return $query->num_rows();
	}

	function getIncompleteTasks($id)
	{
		$this->db->where('student_id',$id);
		$this->db->where('is_completed !=', 'yes');
		$this->db->where('status', 'active');
		$this->db->order_by('task_start_date ASC, task_start_time ASC, id ASC');
		$query = $this->db->get('tasks');
		return $query->result();
	}

	function getAllTasks($id)
	{
		$this->db->where('student_id',$id);
		$this->db->where('status', 'active');
		$this->db->order_by('is_completed ASC, task_start_date ASC, task_start_time ASC, id ASC');
		$query = $this->db->get('tasks');
		return $query->result();
	}

	function getTasksByDate($student_id,$date)
	{
		$this->db->like('date', $date);
		$this->db->where('student_id', $student_id);
		$this->db->where('is_completed !=', 'yes');
		$this->db->where('status', 'active');
		$this->db->order_by('task_start_date ASC, task_start_time ASC, id ASC');
		$query = $this->db->get('tasks');
		return $query->result();
	}

	function getTaskById($id)
	{
		$this->db->where('id', $id);
		$query = $this->db->get('tasks');
		return $query->row();
	}

	function getTaskByEventId($id)
	{
		$this->db->where('event_id', $id);
		$this->db->order_by('task_start_date ASC, task_start_time ASC, id ASC');
		$query = $this->db->get('tasks');
		return $query->result();
	}

	function editTask($data,$id)
	{
		$this->db->where('id', $id);
		$this->db->update('tasks',$data);
	}

	function deleteTask($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('tasks');
	}

	function deleteComment($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('comments');
	}

	function getCommentsByTaskId($task_id)
	{
		$this->db->where('task_id', $task_id);
		$query = $this->db->get('comments');
		return $query->result();
	}

	function getDraggableEventById($id)
	{
		$this->db->where('id', $id);
		$query = $this->db->get('draggable_events');
		return $query->row();
	}

	function updateDraggableEvent($data,$id)
	{
		$this->db->where('id', $id);
		$this->db->update('draggable_events',$data);
	}

	function deleteDraggableEvent($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('draggable_events');
	}

	function getEventDates($id)
	{
		$this->db->select('id, student_id, date');
		$this->db->where('student_id', $id);
		$this->db->where('status', 'active');
		$this->db->group_by('DATE(date)');
		$this->db->order_by('event_start_date ASC, event_start_time ASC, id ASC');
		$query = $this->db->get('events');
		return $query->result();
	}

	function getDraggableEventsCount($id,$event_name)
	{
		$this->db->where('student_id', $id);
		$this->db->where('event_name', $event_name);
		$this->db->where('show_draggable_event', 1);
		$this->db->where('status', 'active');
		$query = $this->db->get('draggable_events');
		return $query->num_rows();
	}

	function getRegisteredMember()
	{
		$this->db->order_by('first_name', 'asc');
		$this->db->where('reg_id !=', $this->session->userdata('student_id'));
		$query = $this->db->get('registration');
		return $query->result();
	}

	function get5StudentTotalTasks($id)
	{
		$this->db->where('student_id', $id);
		$this->db->where('is_completed !=', 'yes');
		$this->db->where('status', 'active');
		$this->db->order_by('task_start_date ASC, task_start_time ASC, id ASC');
		$this->db->limit(5);
		$query = $this->db->get('tasks');
		return $query->result();
	}

	function get5StudentEvents($id)
	{
		$this->db->where('student_id', $id);
		$this->db->where('status', 'active');
		// $this->db->where('event_start_date >=', date('Y-m-d'));
		$this->db->order_by('event_start_date DESC, event_start_time DESC, id DESC');
		$this->db->limit(5);
		$query = $this->db->get('events');
		return $query->result();
	}

	function getStudentTotalTasksCount($id)
	{
		$this->db->where('student_id', $id);
		$this->db->where('status', 'active');
		$query = $this->db->get('tasks');
		return $query->num_rows();
	}

	function getStudentCompletedTasksCount($id)
	{
		$this->db->where('student_id', $id);
		$this->db->where('is_completed', 'yes');
		$this->db->where('status', 'active');
		$query = $this->db->get('tasks');
		return $query->num_rows();
	}

	function getMentors()
	{
		$this->db->where('role_id', 1);
		$this->db->like('email_address', '@project91.com');
		$query = $this->db->get('registration');
		return $query->result();
	}

	function getStudCourseById($student_id)
	{
		$this->db->where('student_id', $student_id);
		$this->db->where('status', 'active');
		$query = $this->db->get('student_course');
		return $query->row();
	}

	function updateCourse($data,$student_id)
	{
		$this->db->where('student_id', $student_id);
		$this->db->update('student_course',$data);
	}

	function gettime_24hrs()
	{
		$this->db->where('status', 'active');
		$this->db->order_by('id', 'asc');
		$query = $this->db->get('time_24hours');
		return $query->result();
	}

	function gettime_12hrs()
	{
		$this->db->where('status', 'active');
		$this->db->order_by('id', 'asc');
		$query = $this->db->get('time_12hours');
		return $query->result();
	}

	function getDuration()
	{
		$this->db->where('status', 'active');
		$this->db->order_by('id', 'asc');
		$query = $this->db->get('duration');
		return $query->result();
	}

	function getRandMotivator()
    {
    	$query = $this->db->query("SELECT * FROM motivator ORDER BY rand() LIMIT 1");
        return $query->row();
    }
	
	function checkEmailinPlanner($email_address)
	{
		$this->db->where('email_address', $email_address);
		$this->db->where('mentor_request', '');
		$this->db->where('status', 'active');
		$query = $this->db->get('planner');
		return $query->row();
	}
}
/* End of file Front_model.php */
/* Location: ./application/helpers/Front_model.php */
?>