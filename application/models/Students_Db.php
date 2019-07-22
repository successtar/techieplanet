<?php

Class Students_Db extends CI_Model {

/*
| -------------------------------------------------------------------
|  Students_Db Model
| -------------------------------------------------------------------
| The students record is managed here
|
*/

	public function save_record($data){

		// Query to insert new students record to database
		$this->db->insert('students_record', $data);

		return ($this->db->affected_rows() > 0) ? true : false;
		
	}

	public function  load_report(){

		// Load students record from students_record table in testing database
		$query = $this->db->query('SELECT name, eng, maths, bio, phy, chem, FORMAT(((eng + maths + bio + phy + chem)/5),0) AS average FROM students_record');

		$data = array();

		// Covert results to array
		foreach ($query->result() as $row){

			$data[] = array('name' => $row->name, 'eng' => $row->eng, 'maths' => $row->maths, 'bio' => $row->bio, 'phy' => $row->phy, 'chem' => $row->chem, 'average' => $row->average);
		}

		/* Return empty array if no record found or add median and mode section in the get_median_mode method */

		return (count($data) > 0 ) ? $this->get_median_mode($data) : $data;

	}

	public function get_median_mode($data){

		for ($i=0; $i < count($data); $i++) { 

			// Extract Subjects scores
			$pick = array($data[$i]['eng'], $data[$i]['maths'], $data[$i]['bio'], $data[$i]['phy'], $data[$i]['chem']);

			// Sort Scores in ascending order
			sort($pick);

			// Add median and median key pair to the data array
			$data[$i] = array_merge($data[$i], array('median' => $pick[2], 'mode' => $pick[4]));
		}

		return $data;
	} 
}
