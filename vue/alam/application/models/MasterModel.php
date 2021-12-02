<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MasterModel extends CI_Model {

	// USERS //
	public function getAllUser() {
		$this->db->order_by('full_name', 'asc');
		$this->db->where('admin_hide', 0);
		return $this->db->get('ms_admin')->result_object();
	}
	public function checkAvailableUser($username,$id_admin = NULL) {
		$this->db->where('username', $username);
		if ($id_admin) {
			$this->db->where('id_admin', $id_admin);
		}
		$this->db->where('admin_hide', 0);
		return $this->db->get('ms_admin')->row_object();
	}
	public function insertUser($data) {
		return $this->db->insert('ms_admin', $data);
	}
	public function updateUser($data) {
		$this->db->where('id_admin', $data['id_admin']);
		return $this->db->update('ms_admin', $data);
	}
	// END //

	// LESSONS //
	public function getAllLesson() {
		$this->db->where('lesson_hide', 0);
		$this->db->order_by('lesson_name', 'asc');
		return $this->db->get('ms_lesson')->result_object();
	}
	public function insertLesson($data) {
		return $this->db->insert('ms_lesson', $data);
	}
	public function updateLesson($data) {
		$this->db->where('id_lesson', $data['id_lesson']);
		return $this->db->update('ms_lesson', $data);
	}
	// END //

	// CLASSES //
	public function getAllClass() {
		$this->db->where('class_hide', 0);
		$this->db->order_by('class_name', 'asc');
		return $this->db->get('ms_class')->result_object();
	}
	public function getClassById($id_class) {
		$this->db->where('id_class', $id_class);
		return $this->db->get('ms_class')->row_object();
	}
	public function insertClass($data) {
		return $this->db->insert('ms_class', $data);
	}
	public function updateClass($data) {
		$this->db->where('id_class', $data['id_class']);
		return $this->db->update('ms_class', $data);
	}
	// END //

	// TEACHERS //
	public function getAllTeacher() {
		$this->db->order_by('teacher_name', 'asc');
		$this->db->where('teacher_hide', 0);
		return $this->db->get('ms_teacher')->result_object();
	}
	public function getTeacherById($id_teacher) {
		$this->db->where('id_teacher', $id_teacher);
		$this->db->where('teacher_hide', 0);
		return $this->db->get('ms_teacher')->row_object();
	}
	public function getTeacherByUsername($teacher_username) {
		$this->db->where('teacher_username', $teacher_username);
		$this->db->where('teacher_hide', 0);
		return $this->db->get('ms_teacher')->row_object();
	}
	public function getClassByTeacher($id_teacher) {
		$this->db->where('teacher_class.id_teacher', $id_teacher);
		$this->db->join('ms_class', 'teacher_class.id_class = ms_class.id_class', 'left');
		return $this->db->get('teacher_class')->result_object();
	}
	public function getLessonByTeacher($id_teacher) {
		$this->db->where('teacher_lesson.id_teacher', $id_teacher);
		$this->db->join('ms_lesson', 'teacher_lesson.id_lesson = ms_lesson.id_lesson', 'left');
		return $this->db->get('teacher_lesson')->result_object();
	}
	public function insertTeacher($data) {
		$this->db->insert('ms_teacher', $data);
		return $this->db->insert_id();
	}
	public function insertTeacherClass($data) {
		return $this->db->insert('teacher_class',$data);
	}
	public function insertTeacherLesson($data) {
		return $this->db->insert('teacher_lesson', $data);
	}
	public function updateTeacher($data) {
		$this->db->where('id_teacher', $data['id_teacher']);
		return $this->db->update('ms_teacher', $data);
	}
	public function deleteClassByTeacher($id_teacher,$id_class) {
		$this->db->where('id_teacher', $id_teacher);
		$this->db->where('id_class', $id_class);
		return $this->db->delete('teacher_class');
	}
	public function deleteLessonByTeacher($id_teacher,$id_lesson) {
		$this->db->where('id_teacher', $id_teacher);
		$this->db->where('id_lesson', $id_lesson);
		return $this->db->delete('teacher_lesson');
	}
	// END //

	// STUDENTS //
	public function getAllStudent($class = null) {
		$this->db->order_by('ms_student.student_name', 'asc');
		$this->db->where('ms_student.student_hide', '0');
		$this->db->where('ms_student.id_class',$class);
		$this->db->join('ms_class', 'ms_student.id_class = ms_class.id_class', 'left');
		return $this->db->get('ms_student')->result_object();
	}
	public function getStudentById($id_student) {
		$this->db->where('id_student', $id_student);
		$this->db->where('student_hide', 0);
		return $this->db->get('ms_student')->row_object();
	}
	public function getStudentByClass($id_class) {
		$this->db->where('ms_student.id_class', $id_class);
		$this->db->where('ms_student.student_hide', 0);
		$this->db->join('ms_class', 'ms_student.id_class = ms_class.id_class', 'left');
		return $this->db->get('ms_student')->result_object();
	}
	public function getStudentByNis($student_nis) {
		$this->db->where('student_nis', $student_nis);
		$this->db->where('student_hide', 0);
		return $this->db->get('ms_student')->row_object();
	}
	public function insertStudent($data) {
		return $this->db->insert('ms_student', $data);
	}
	public function updateStudent($data) {
		$this->db->where('id_student', $data['id_student']);
		return $this->db->update('ms_student', $data);
	}
	public function getPresenceByCondition($nis,$from,$until) {
		$query = "SELECT * FROM st_presence WHERE LEFT(presence_log,10) BETWEEN '$from' AND '$until' AND nis = '$nis'";
		return $this->db->query($query)->result_object();
	}
	// END //
	public function getAbsenThisMonth() {
		$month = date('Y-m');
		$query = "SELECT * FROM st_presence WHERE LEFT(presence_log,7) = '$month'";
		return $this->db->query($query)->result_object();
	}
	public function getAbsenWithCondition($date,$type) {
		$query = "SELECT * FROM st_presence WHERE LEFT(presence_log,10) = '$date' AND presence_type = '$type'";
		return $this->db->query($query)->result_object();
	}
	public function getAbsenWithFilteringDashboard($student_nis,$from,$until) {
		$query = "SELECT * FROM st_presence WHERE LEFT(presence_log,10) = '$date' AND presence_type = '$type'";
		return $this->db->query($query)->row_object();
	}
	public function getAbsenWithConditionAndNis($date,$type,$student_nis) {
		$query = "SELECT * FROM st_presence WHERE LEFT(presence_log,10) = '$date' AND presence_type = '$type' AND nis = '$student_nis'";
		// return $query;
		return $this->db->query($query)->result_object();
	}
	public function tendayschart() {
		$arr = [];
		for ($n = 0; $n <= 9; $n++) {
			$tglto = date('Y-m-d',strtotime("-$n days"));
			$qa = "SELECT nis FROM `st_presence` WHERE DATE(presence_log) = '$tglto' And presence_type = 'attend'";
			$ql = "SELECT nis FROM `st_presence` WHERE DATE(presence_log) = '$tglto' And presence_type = 'leave'";
			$qs = "SELECT nis FROM `st_presence` WHERE DATE(presence_log) = '$tglto' And presence_type = 'sick'";
			$qp = "SELECT nis FROM `st_presence` WHERE DATE(presence_log) = '$tglto' And presence_type = 'alpha'";
			$ra = $this->db->query($qa)->num_rows();
			$rl = $this->db->query($ql)->num_rows();
			$rs = $this->db->query($qs)->num_rows();
			$rp = $this->db->query($qp)->num_rows();
			array_unshift($arr, ['logdate' => date('d-m-Y', strtotime($tglto)), 'attend' => $ra, 'leave' => $rl, 'sick' => $rs, 'alpha' => $rp]);
		}
		return $arr;
	}
	public function getAllLog() {
		$this->db->order_by('id_log', 'desc');
		return $this->db->get('ms_log')->result_object();
	}
}

/* End of file MasterModel.php */
/* Location: ./application/models/MasterModel.php */