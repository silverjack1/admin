<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AssignmentCtrl extends MY_Controller {

	public function index() {
		redirect('page/assignments');
	}
	public function create() {
		if (!$this->input->post()) {
			redirect('page/create');
		}
		$data = $this->input->post();
		unset($data['show_report']);
		unset($data['show_analytic']);
		unset($data['id_class']);
		if ($this->input->post('show_analytic')) {
			$data['show_analytic'] = 1;
		}
		if ($this->input->post('show_report')) {
			$data['show_report'] = 1;
		}
		$data['id_'] = $this->session->userdata('id_');
		$data['author_'] = $this->session->userdata('level');
		$data['assignment_created'] = date('Y-m-d H:i:s');
		$dirName = date('s').'-'.substr(sha1($data['id_']), 4,7).'-'.$data['id_'];
		if (!is_dir('assets/images/assignments/'.$dirName)) {
			mkdir('./assets/images/assignments/' . $dirName, 0777, TRUE);
		}
		$data['assignment_path'] = $dirName;
		$idAssignment = $this->assignment->insertAssignment($data);
		
		// CLASS //
		foreach ($this->input->post('id_class') as $row => $value) {
			$single = [
				'id_assignment' => $idAssignment,
				'id_class' => $value
			];
			$this->assignment->insertAssignmentClass($single);
		}
		$this->message('Selamat!','Data ujian berhasil di simpan, silahkan buat soal untuk melanjutkan','success');
		redirect('page/list_question/'.$idAssignment);
	}
	public function update() {
		if (!$this->input->post()) {
			redirect('page/assignments');
		}
		$data = $this->input->post();
		unset($data['show_report']);
		unset($data['show_analytic']);
		unset($data['id_class']);
		if ($this->input->post('show_analytic')) {
			$data['show_analytic'] = 1;
		} else {
			$data['show_analytic'] = 0;
		}
		if ($this->input->post('show_report')) {
			$data['show_report'] = 1;
		} else {
			$data['show_report'] = 0;
		}
		$this->assignment->updateAssignment($data);
		
		// CLASS //
		foreach ($this->assignment->getClassByAssignment($this->input->post('id_assignment')) as $r => $v) {
			$valDel = true;
			foreach ($this->input->post('id_class') as $row => $value) {
				if ($value == $v->id_class) {
					$valDel = false;
				}
			}
			if ($valDel) {
				$this->assignment->deleteAssignmentClassId($v->id_aclass);
			}
		}
		foreach ($this->input->post('id_class') as $_row => $_value) {
			$valIns = true;
			foreach ($this->assignment->getClassByAssignment($this->input->post('id_assignment')) as $_r => $_v) {
				if ($_v->id_class == $_value) {
					$valIns = false;
				}
			}
			if ($valIns) {
				$single = [
					'id_assignment' => $this->input->post('id_assignment'),
					'id_class' => $_value
				];
				$this->assignment->insertAssignmentClass($single);
			}
		}
		$this->message('Selamat!','Data ujian berhasil di ubah','success');
		redirect('page/edit/'.$this->input->post('id_assignment'));
	}

	public function create_question() {
		if ($this->input->post('question_') == '') {
			$this->message('Ooppsss','Anda belum membuat soal, pastikan anda membuat soal terlebih dahulu','error');
			redirect('page/create_question/'.$this->input->post('id_assignment'));
		}
		$dataQuestion = [
			'id_lesson' => $this->input->post('id_lesson'),
			'question_' => $this->input->post('question_'),
			'question_created' => date('Y-m-d H:i:s')
		];
		// IMAGE QUESTION //
		if ($_FILES['question_image']['name']) {
			$this->imageConf('assignments/'.$this->input->post('assignment_path')); // Validation image
            if(!$this->upload->do_upload('question_image')) :
                $this->message('Oopppsss',$this->upload->display_errors(),'error');
            	redirect('page/create_question/'.$this->input->post('id_assignment'));
            else :
            	$dataUpload = $this->upload->data();
            	$dataQuestion['question_image'] = str_replace(' ', '_', $dataUpload['file_name']);
            	// COMPRESS IMAGE //
            	$resolution = ['width' => 500, 'height' => 500];
	            $this->compreesImage('assignments/'.$this->input->post('assignment_path'),$dataUpload['file_name'],$resolution);
            endif;
		} // IMAGE QUESTION //
		// SOUND QUESTION //
		if ($_FILES['question_sound']['name']) {
			$this->soundConf('assignments/'.$this->input->post('assignment_path')); // Validation image
            if(!$this->upload->do_upload('question_sound')) :
                $this->message('Oopppsss',$this->upload->display_errors(),'error');
            	redirect('page/create_question/'.$this->input->post('id_assignment'));
            else :
            	$dataUpload = $this->upload->data();
            	$dataQuestion['question_sound'] = str_replace(' ', '_', $dataUpload['file_name']);
            endif;
		} // SOUND QUESTION //
		$idQuestion = $this->assignment->insertQuestion($dataQuestion);
		// FOR OPTION //
		foreach (json_decode($this->input->post('JSONanswer')) as $row => $value) {
			$answer = [
				'id_question' => $idQuestion,
				'option_' => $this->input->post('option_'.$value->row),
				'option_created' => date('Y-m-d H:i:s')
			];
			if ($value->row == $this->input->post('choosedAnswer')) {
				$answer['option_true'] = 1;
			}
			// IMAGE OPTION //
			if ($_FILES['option_image'.$value->row]['name']) {
				$this->imageConf('assignments/'.$this->input->post('assignment_path')); // Validation image
	            if(!$this->upload->do_upload('option_image'.$value->row)) :
	                $this->message('Oopppsss','Unggah jawaban nomor '.($value->row + 1).' gagal, detail -> '.$this->upload->display_errors(),'error');
	            	redirect('page/create_question/'.$this->input->post('id_assignment'));
	            else :
	            	$dataUpload = $this->upload->data();
	            	$answer['option_image'] = str_replace(' ', '_', $dataUpload['file_name']);
	            	// COMPRESS IMAGE //
	            	$resolution = ['width' => 500, 'height' => 500];
		            $this->compreesImage('assignments/'.$this->input->post('assignment_path'),$dataUpload['file_name'],$resolution);
	            endif;
			} // END IMAGE OPTION //
			$this->assignment->insertOption($answer);
		}
		// INSERT ASSIGNMENT QUESTION //
		$assignmentQuestion = [
			'id_assignment' => $this->input->post('id_assignment'),
			'id_question' => $idQuestion
		];
		$this->assignment->insertAssignmentQuestion($assignmentQuestion);
		$this->message('Yeeayy!','Soal dan jawaban berhasil disimpan :)','success');
		redirect('page/create_question/'.$this->input->post('id_assignment'));
	}
	public function updateQuestion() {
		if ($this->input->post('question_') == '') {
			$this->message('Ooppsss','Anda belum membuat soal, pastikan anda membuat soal terlebih dahulu','error');
			redirect('page/update_question/'.$this->input->post('id_assignment').'/'.$this->input->post('id_question'));
		}
		$dataQuestion = [
			'id_question' => $this->input->post('id_question'),
			'id_lesson' => $this->input->post('id_lesson'),
			'question_' => $this->input->post('question_'),
			'question_created' => date('Y-m-d H:i:s')
		];
		// IMAGE QUESTION //
		if ($_FILES['question_image']['name']) {
			$this->imageConf('assignments/'.$this->input->post('assignment_path')); // Validation image
            if(!$this->upload->do_upload('question_image')) :
                $this->message('Oopppsss',$this->upload->display_errors(),'error');
            	redirect('page/update_question/'.$this->input->post('id_assignment').'/'.$this->input->post('id_question'));
            else :
            	$dataUpload = $this->upload->data();
            	$dataQuestion['question_image'] = str_replace(' ', '_', $dataUpload['file_name']);
            	// COMPRESS IMAGE //
            	$resolution = ['width' => 500, 'height' => 500];
	            $this->compreesImage('assignments/'.$this->input->post('assignment_path'),$dataUpload['file_name'],$resolution);
            endif;
		} // IMAGE QUESTION //
		// SOUND QUESTION //
		if ($_FILES['question_sound']['name']) {
			$this->soundConf('assignments/'.$this->input->post('assignment_path')); // Validation image
            if(!$this->upload->do_upload('question_sound')) :
                $this->message('Oopppsss',$this->upload->display_errors(),'error');
            	redirect('page/update_question/'.$this->input->post('id_assignment').'/'.$this->input->post('id_question'));
            else :
            	$dataUpload = $this->upload->data();
            	$dataQuestion['question_sound'] = str_replace(' ', '_', $dataUpload['file_name']);
            endif;
		} // SOUND QUESTION //
		$this->assignment->updateQuestion($dataQuestion);
		// FOR OPTION //
		foreach (json_decode($this->input->post('JSONanswer')) as $row => $value) {
			$answer = [
				'id_question' => $this->input->post('id_question'),
				'option_' => $this->input->post('option_'.$value->row),
				'option_created' => date('Y-m-d H:i:s')
			];
			if ($value->row == $this->input->post('choosedAnswer')) {
				$answer['option_true'] = 1;
			}
			// IMAGE OPTION //
			if ($_FILES['option_image'.$value->row]['name']) {
				$this->imageConf('assignments/'.$this->input->post('assignment_path')); // Validation image
	            if(!$this->upload->do_upload('option_image'.$value->row)) :
	                $this->message('Oopppsss','Unggah jawaban nomor '.($value->row + 1).' gagal, detail -> '.$this->upload->display_errors(),'error');
	            	redirect('page/update_question/'.$this->input->post('id_assignment').'/'.$this->input->post('id_question'));
	            else :
	            	$dataUpload = $this->upload->data();
	            	$answer['option_image'] = str_replace(' ', '_', $dataUpload['file_name']);
	            	// COMPRESS IMAGE //
	            	$resolution = ['width' => 500, 'height' => 500];
		            $this->compreesImage('assignments/'.$this->input->post('assignment_path'),$dataUpload['file_name'],$resolution);
	            endif;
			} // END IMAGE OPTION //
			if ($this->input->post('id_option'.$row)) {
				$answer['id_option'] = $this->input->post('id_option'.$row);
				unset($answer['option_created']);
				$this->assignment->updateOption($answer);
			} else {
				$this->assignment->insertOption($answer);
			}
		}
		$this->message('Yeeayy!','Soal dan jawaban berhasil diubah :)','success');
		redirect('page/update_question/'.$this->input->post('id_assignment').'/'.$this->input->post('id_question'));
	}

	public function removeQuestion($id_question = NULL, $id_assignment = NULL) {
		if (!$id_question OR !$id_assignment) {
			redirect('page/assignments');
		}
		$dataQuestion = $this->assignment->getQuestionById($id_question);
		$dataAssignment = $this->assignment->getAssignmentById($id_assignment);
		if (!$dataQuestion OR !$dataAssignment) {
			redirect('page/assignments');
		}
		$forQuestion = [
			'id_question' => $id_question,
			'question_hide' => 1
		];
		$this->assignment->updateQuestion($forQuestion);
		$forAssignmetnQuestion = [
			'id_assignment' => $id_assignment,
			'id_question' => $id_question,
			'val_hide' => 1
		];
		$this->assignment->updateAssignmentQuestion($forAssignmetnQuestion);
		$this->message('Yeeayy!','Soal yang anda pilih berhasil dihapus :)','success');
		redirect('page/list_question/'.$id_assignment);
	}
	public function deleteAssignment($id_assignment = NULL) {
		if (!$id_assignment) {
			redirect('page/assignments');
		}
		$dataAssignment = $this->assignment->getAssignmentById($id_assignment);
		if (!$dataAssignment) {
			redirect('page/assignments');
		}
		$data = [
			'id_assignment' => $id_assignment,
			'assignment_hide' => 1
		];
		$this->assignment->updateAssignment($data);
		$this->message('Sukses!','Data ujian berhasil dihapus :)','success');
		redirect('page/assignments');
	}

	// AJAX //
	public function changeStatusAssignment($id_assignment,$status) {
		if ($status == 2) {
			$status = 0;
		}
		$data = [
			'id_assignment' => $id_assignment,
			'assignment_active' => $status,
		];
		$totalAssignment = 0;
		foreach ($this->assignment->getAllAssignment() as $row => $value) {
			if ($value->assignment_active == 1) {
				$totalAssignment++;
			}
		}
		if ($totalAssignment >= 10 AND $status == 1) {
			echo "limit";
		} else {
			$this->assignment->updateAssignment($data);
			return true;
		}
	}

}

/* End of file AssignmentCtrl.php */
/* Location: ./application/controllers/AssignmentCtrl.php */