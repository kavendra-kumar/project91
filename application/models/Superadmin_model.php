<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Superadmin_model extends CI_Model {

	public function checkLogin($username,$password)
	{
		$this->db->where('username', $username);
		$this->db->where('password', md5($password));
		$query = $this->db->get('superadmin');
		return $query->num_rows();
	}

	public function selectLogin()
	{
		$this->db->where('username', $this->session->userdata('msuperadmin_id'));
		$query = $this->db->get('superadmin');
		return $query->row();
	}

	public function registeredUsers()
	{
		$this->db->order_by('reg_id', 'DESC');
		$query = $this->db->get('registration');
		return $query->result();
	}

	public function getRole()
	{
		$this->db->where('status', 'active');
		$query = $this->db->get('role');
		return $query->result();
	}

	public function deleteStudent($id)
	{
		$this->db->where('reg_id', $id);
		$this->db->delete('registration');
	}

	public function updateRegistration($data,$id)
	{
		$this->db->where('reg_id', $id);
		$this->db->update('registration',$data);
	}

	public function getStudentById($id)
	{
		$this->db->where('reg_id', $id);
		$query = $this->db->get('registration');
		return $query->row();
	}

	function getStudCourseById($student_id)
	{
		// $this->db->where('student_id', $student_id);
		// $query = $this->db->get('student_course');
		// return $query->row();
		$sql = "select name FROM courses JOIN student_course ON courses.id = student_course.course_id WHERE student_course.student_id = $student_id AND courses.status = 'active'";
		$query = $this->db->query($sql);
		return $query->row();	
	}
	
	public function getStudentModuleById($student_id)
	{
		$this->db->where('student_id', $student_id);
		$this->db->where('status', 'active');
		$query = $this->db->get('student_module');
		return $query->result();
	}

	public function getModuleByStudId($student_id,$module_id)
	{
		$this->db->where('student_id', $student_id);
		$this->db->where('module_id', $module_id);
		$this->db->where('status', 'active');
		$query = $this->db->get('student_module');
		return $query->num_rows();
	}

	public function getModuleById($id)
	{
		$this->db->where('status', 'active');
		$this->db->where('id', $id);
		$query = $this->db->get('module');
		return $query->row();
	}

	public function getSchoolById($id)
	{
		$this->db->where('status', 'active');
		$this->db->where('id', $id);
		$query = $this->db->get('school_names');
		return $query->row();
	}

	public function getMotivator()
	{
		$this->db->order_by('id', 'DESC');
		$this->db->where('status', 'active');
		$query = $this->db->get('motivator');
		return $query->result();
	}

	public function insertMotivator($data){
		if($this->db->insert('motivator',$data)){
			return TRUE;
		}else{
			return FALSE;
		}
	}

	public function getMotivatorById($mid)
	{
		$this->db->where('id', $mid);
		$query = $this->db->get('motivator');
		return $query->row();
	}

	public function updateMotivator($data,$mid)
	{
		$this->db->where('id', $mid);
		$this->db->update('motivator',$data);
	}

	public function deleteMotivator($mid)
	{
		$this->db->where('id', $mid);
		$this->db->delete('motivator');
	}

	public function getProgram()
	{
		$this->db->order_by('id', 'ASC');
		$this->db->where('status', 'active');
		$query = $this->db->get('courses');
		return $query->result();
	}

	public function getPlanner()
	{
		$this->db->order_by('id', 'ASC');
		$this->db->where('status', 'active');
		$query = $this->db->get('planner_template');
		return $query->result();
	}

	public function insertProgram($data){
		if($this->db->insert('courses',$data)){
			return TRUE;
		}else{
			return FALSE;
		}
	}

	public function insertPlanner($data){
		if($this->db->insert('planner_template',$data)){
			return TRUE;
		}else{
			return FALSE;
		}
	}

	public function getProgramById($pid)
	{
		$this->db->where('id', $pid);
		$query = $this->db->get('courses');
		return $query->row();
	}

	public function getPlannerById($pid)
	{
		$this->db->where('id', $pid);
		$query = $this->db->get('planner_template');
		return $query->row();
	}
	public function updateProgram($data,$pid)
	{
		$this->db->where('id', $pid);
		$this->db->update('courses',$data);
	}

	public function updatePlanner($data,$pid)
	{
		$this->db->where('id', $pid);
		$this->db->update('planner_template',$data);
	}


	public function deleteProgram($pid)
	{
		$this->db->where('id', $pid);
		$this->db->delete('courses');
	}


	public function deletePlanner($pid)
	{
		$this->db->where('id', $pid);
		$this->db->delete('planner_template');
	}

	public function getProgramCycleByPid($pid)
	{
		$this->db->where('pid', $pid);
		$this->db->order_by('day', 'ASC');
		$this->db->where('status', 'active');
		$query = $this->db->get('program_cycle');
		return $query->result();
	}

	public function getProgramCycle()
	{
		$this->db->order_by('day', 'ASC');
		$this->db->where('status', 'active');
		$query = $this->db->get('program_cycle');
		return $query->result();
	}

	public function insertProgramCycle($data){
		if($this->db->insert('program_cycle',$data)){
			return TRUE;
		}else{
			return FALSE;
		}
	}

	

	public function getProgramCycleById($scid)
	{
		$this->db->where('id', $scid);
		$query = $this->db->get('program_cycle');
		return $query->row();
	}

	public function updateProgramCycle($data,$scid)
	{
		$this->db->where('id', $scid);
		$this->db->update('program_cycle',$data);
	}

	public function deleteProgramCycle($scid)
	{
		$this->db->where('id', $scid);
		$this->db->delete('program_cycle');
	}

	public function getHoliday()
	{
		$this->db->order_by('on_date', 'ASC');
		$this->db->where('status', 'active');
		$query = $this->db->get('holiday');
		return $query->result();
	}

	public function insertHoliday($data){
		if($this->db->insert('holiday',$data)){
			return TRUE;
		}else{
			return FALSE;
		}
	}

	public function getHolidayById($wid)
	{
		$this->db->where('id', $wid);
		$query = $this->db->get('holiday');
		return $query->row();
	}

	public function updateHoliday($data,$wid)
	{
		$this->db->where('id', $wid);
		$this->db->update('holiday',$data);
	}

	public function deleteHoliday($wid)
	{
		$this->db->where('id', $wid);
		$this->db->delete('holiday');
	}

	function getCalendarSubjects($id,$month_year)
	{
		$this->db->where('student_id', $id);
		$this->db->where('status', 'active');
		$this->db->group_start();
		$this->db->like('date_array', $month_year); 
		// $this->db->or_like('event_end_date', $month_year); 
		$this->db->group_end();
		$query = $this->db->get('admin_exam');
		return $query->result();
		
	}

}
/* End of file Superadmin_model.php */
/* Location: ./application/models/Superadmin_model.php */
?>