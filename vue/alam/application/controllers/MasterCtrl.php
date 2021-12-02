<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MasterCtrl extends MY_Controller {

	public function index() {
		redirect('page');
	}

	public function users($id_admin = NULL) {
		if ($this->input->post()) {
			$data = $this->input->post();
			if ($this->input->post('id_admin')) {
				if ($this->input->post('password') == '') {
					unset($data['password']);
				} else {
					$data['password'] = crypt($this->input->post('password'),'');
				}
			}
			if ($this->input->post('id_admin')) {
				$user = $this->master->checkAvailableUser($data['username']);
				if ($data) {
					if ($data['id_admin'] != $user->id_admin) {
						$this->message('Ooppsss!','Username sudah terdaftar, silahkan coba username lain','error');
						redirect('page/users');
					}
				}
				$this->master->updateUser($data);
				$this->message('Selamat!','Data pengguna berhasil diubah','success');
			} else {
				if ($this->master->checkAvailableUser($data['username'])) {
					$this->message('Ooppsss!','Username sudah terdaftar, silahkan coba username lain','error');
					redirect('page/users');
				}
				$data['admin_created'] = date('Y-m-d');
				$data['password'] = crypt($this->input->post('password'),'');
				$this->master->insertUser($data);
				$this->message('Selamat!','Data pengguna berhasil ditambahkan','success');
				// SIMPAN LOG //
				$this->SetLog('User menambahkan siswa baru');
			}
		} elseif($id_admin) {
			$data = [
				'id_admin' => $id_admin,
				'admin_hide' => 1
			];
			$this->master->updateUser($data);
			$this->message('Selamat!','Data pengguna berhasil dihapus','success');
		}
		redirect('page/users');
	}

	public function lessons($id_lesson = NULL) {
		if ($this->input->post()) {
			$data = $this->input->post();
			if ($this->input->post('id_lesson')) {
				$this->master->updateLesson($data);
				$this->message('Selamat!','Data pelajaran berhasil diubah','success');
			} else {
				$data['lesson_created'] = date('Y-m-d');
				$this->master->insertLesson($data);
				$this->message('Selamat!','Data pelajaran berhasil ditambahkan','success');
			}
		} elseif($id_lesson) {
			$data = [
				'id_lesson' => $id_lesson,
				'lesson_hide' => 1
			];
			$this->master->updateLesson($data);
			$this->message('Selamat!','Data pelajaran berhasil dihapus','success');
		}
		redirect('page/lessons');
	}

	public function classes($id_class = NULL) {
		if ($this->input->post()) {
			$data = $this->input->post();
			if ($this->input->post('id_class')) {
				$this->master->updateClass($data);
				$this->message('Selamat!','Data kelas berhasil diubah','success');
			} else {
				$data['class_created'] = date('Y-m-d');
				$this->master->insertClass($data);
				$this->message('Selamat!','Data kelas berhasil ditambahkan','success');
			}
		} elseif($id_class) {
			$data = [
				'id_class' => $id_class,
				'class_hide' => 1
			];
			$this->master->updateClass($data);
			$this->message('Selamat!','Data kelas berhasil dihapus','success');
		}
		redirect('page/classes');
	}

	public function teachers($id_teacher = NULL) {
		if ($this->input->post()) {
			$data = $this->input->post();
			$teacherUsername = $this->preg($this->input->post('teacher_username'));
			if ($this->master->getTeacherByUsername($teacherUsername)) {
				$this->message('Ooppsss','Username telah terdaftar, silahkan coba username lain','error');
				redirect('page/teacher_add');
			}
			if ($_FILES['teacher_photo']['name']) {
				$this->imageConf('teachers'); // Validation image
	            if(!$this->upload->do_upload('teacher_photo')) :
	                $this->message('Oopppsss',$this->upload->display_errors(),'error');
	            	redirect('page/teachers');
	            else :
	            	$dataUpload = $this->upload->data();
	            	$data['teacher_photo'] = str_replace(' ', '_', $dataUpload['file_name']);
	            	// COMPRESS IMAGE //
	            	$resolution = ['width' => 500, 'height' => 500];
		            $this->compreesImage('teachers',$dataUpload['file_name'],$resolution);
	            endif;
			}
			$data['teacher_created'] = date('Y-m-d');
			unset($data['id_class']);
			unset($data['id_lesson']);
			$data['teacher_password'] = crypt($this->input->post('teacher_password'),'');
			$data['teacher_username'] = $teacherUsername;
			$idTeacher = $this->master->insertTeacher($data);
			foreach ($this->input->post('id_class') as $rClass => $vClass) {
				$singleClass = [
					'id_teacher' => $idTeacher,
					'id_class' => $vClass,
				];
				$this->master->insertTeacherClass($singleClass);
			}
			foreach ($this->input->post('id_lesson') as $rLesson => $vLesson) {
				$singleLesson = [
					'id_teacher' => $idTeacher,
					'id_lesson' => $vLesson,
				];
				$this->master->insertTeacherLesson($singleLesson);
			}
			$this->message('Selamat!','Data guru berhasil ditambahkan','success');
		} elseif($id_teacher) {
			$data = [
				'id_teacher' => $id_teacher,
				'teacher_hide' => 1
			];
			$this->master->updateTeacher($data);
			$this->message('Selamat!','Data guru berhasil dihapus','success');
		}
		redirect('page/teachers');
	}
	public function teacher_update() {
		if ($this->input->post()) {
			$data = $this->input->post();
			$teacherUsername = $this->preg($this->input->post('teacher_username'));
			$teacher = $this->master->getTeacherByUsername($teacherUsername);
			if ($data) {
				if ($data['id_teacher'] != $teacher->id_teacher) {
					$this->message('Ooppsss!','Username sudah terdaftar, silahkan coba username lain','error');
					redirect('page/teacher_add');
				}
			} // VALIDATION USERNAME //
			if ($_FILES['teacher_photo']['name']) {
				$this->imageConf('teachers'); // Validation image
	            if(!$this->upload->do_upload('teacher_photo')) :
	                $this->message('Oopppsss',$this->upload->display_errors(),'error');
	            	redirect('page/teachers');
	            else :
	            	$dataUpload = $this->upload->data();
	            	$data['teacher_photo'] = str_replace(' ', '_', $dataUpload['file_name']);
	            	// COMPRESS IMAGE //
	            	$resolution = ['width' => 500, 'height' => 500];
		            $this->compreesImage('teachers',$dataUpload['file_name'],$resolution);
	            endif;
			}
			unset($data['id_class']);
			unset($data['id_lesson']);
			if ($this->input->post('password') != '') {
				$data['teacher_password'] = crypt($this->input->post('teacher_password'),'');
			} else {
				unset($data['teacher_password']);
			}
			$data['teacher_username'] = $teacherUsername;
			$this->master->updateTeacher($data);
			// FOR CLASS //
			foreach ($this->master->getClassByTeacher($this->input->post('id_teacher')) as $rClass => $vClass) {
				$classDel = true;
				foreach ($this->input->post('id_class') as $_rClass => $_vClass) {
					if ($_vClass == $vClass->id_class) {
						$classDel = false;
					}
				}
				if ($classDel) {
					$this->master->deleteClassByTeacher($this->input->post('id_teacher'),$vClass->id_class);
				}
			}
			foreach ($this->input->post('id_class') as $__rClass => $__vClass) {
				$classIns = true;
				foreach ($this->master->getClassByTeacher($this->input->post('id_teacher')) as $rClass_ => $vClass_) {
					if ($__vClass == $vClass_->id_class) {
						$classIns = false;
					}
				}
				if ($classIns) {
					$singleClass = [
						'id_teacher' => $this->input->post('id_teacher'),
						'id_class' => $__vClass,
					];
					$this->master->insertTeacherClass($singleClass);
				}
			}
			// FOR LESSON //
			foreach ($this->master->getLessonByTeacher($this->input->post('id_teacher')) as $rLesson => $vLesson) {
				$lessonDel = true;
				foreach ($this->input->post('id_lesson') as $_rLesson => $_vLesson) {
					if ($_vLesson == $vLesson->id_lesson) {
						$lessonDel = false;
					}
				}
				if ($lessonDel) {
					$this->master->deleteLessonByTeacher($this->input->post('id_teacher'),$vLesson->id_lesson);
				}
			}
			foreach ($this->input->post('id_lesson') as $__rLesson => $__vLesson) {
				$lessonIns = true;
				foreach ($this->master->getLessonByTeacher($this->input->post('id_teacher')) as $rLesson_ => $vLesson_) {
					if ($__vLesson == $vLesson_->id_lesson) {
						$lessonIns = false;
					}
				}
				if ($lessonIns) {
					$singleLesson = [
						'id_teacher' => $this->input->post('id_teacher'),
						'id_lesson' => $__vLesson,
					];
					$this->master->insertTeacherLesson($singleLesson);
				}
			}
			$this->message('Selamat!','Data guru berhasil diubah','success');
		}
		redirect('page/teachers');
	}

	public function students($id_student = NULL) {
		if ($this->input->post()) {
			$data = $this->input->post();
			// CHECK NIS //
			if ($this->input->post('id_student')) {
				$dataStudent = $this->master->getStudentByNis($data['student_nis']);
				if ($dataStudent) {
					if ($dataStudent->id_student != $data['id_student']) {
						$this->message('Ooppsss!','NIS sudah terdaftar, silahkan coba NIS lain','error');
						redirect('page/student_edit/'.$data['id_student']);
					}
				}
			} else {
				if ($this->master->getStudentByNis($data['student_nis'])) {
					$this->message('Ooppsss!','NIS sudah terdaftar, silahkan coba NIS lain','error');
					redirect('page/student_add');
				}
			} // VALIDATION NIS AVAILABLE //


			if ($_FILES['student_photo']['name']) {
				$this->imageConf('students'); // Validation image
	            if(!$this->upload->do_upload('student_photo')) :
	                $this->message('Oopppsss',$this->upload->display_errors(),'error');
	            	redirect('page/students');
	            else :
	            	$dataUpload = $this->upload->data();
	            	$data['student_photo'] = str_replace(' ', '_', $dataUpload['file_name']);
	            	// COMPRESS IMAGE //
	            	$resolution = ['width' => 500, 'height' => 500];
		            $this->compreesImage('students',$dataUpload['file_name'],$resolution);
	            endif;
			} // IMAGE //

			if ($this->input->post('student_password') != '') {
				$data['student_password'] = crypt($this->input->post('student_password'),'');
			} else {
				unset($data['student_password']);
			}

			if ($this->input->post('id_student')) {
				$this->master->updateStudent($data);
				$this->message('Selamat!','Data siswa berhasil diubah','success');
			} else {
				$data['student_created'] = date('Y-m-d');
				$this->master->insertStudent($data);
				$this->message('Selamat!','Data siswa berhasil ditambahkan','success');
			}
		} elseif($id_student) {
			$data = [
				'id_student' => $id_student,
				'student_hide' => 1
			];
			$this->master->updateStudent($data);
			$this->message('Selamat!','Data siswa berhasil diubah','success');
		}
		redirect('page/students');
	}

	public function findTypeAndClassForReport($id_lesson) {
		if (!$id_lesson) {
			echo "failure";
		}
		$dataLesson = $this->assignment->getLessonById($id_lesson);
		if (!$dataLesson) {
			echo "failure";
		}
		$dataType = $this->assignment->getAsssignmentTypeByLesson($id_lesson);
		$dataClass = [];
		$assignmentClass = [];
		foreach ($this->assignment->getAssignmentByLesson($id_lesson) as $r => $v) {
			foreach ($this->assignment->getClassByAssignment($v->id_assignment) as $_r => $_v) {
				if ($this->session->userdata('level') == 'guru') {
					$valPush = false;
					foreach ($this->master->getClassByTeacher($this->session->userdata('id_')) as $__r => $__v) {
						if ($__v->id_class == $_v->id_class) {
							$valPush = true;
						}
					}
					if ($valPush) {
						array_push($assignmentClass, $_v);
					}
				} else {
					array_push($assignmentClass, $_v);
				}
			}
		}
		foreach ($assignmentClass as $r_ => $v_) {
			if ($dataClass) {
				$val = true;
				foreach ($dataClass as $row => $value) {
					if ($value->id_class == $v_->id_class) {
						$val = false;
					}
				}
				if ($val) {
					array_push($dataClass, $v_);
				}
			} else {
				array_push($dataClass,$v_);
			}
		}
		if ($dataType) {
			$callback = ['dataType' => $dataType, 'dataClass' => $dataClass ];
			echo json_encode($callback);
		} else {
			echo "failure";
		}
	}
}

/* End of file MasterCtrl.php */
/* Location: ./application/controllers/MasterCtrl.php */