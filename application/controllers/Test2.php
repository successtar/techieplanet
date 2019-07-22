<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Test2 extends CI_Controller {

	/**
	 *
	 * Techie Planet Challenge Test 2 Controller.
	 * 
	 * Javascript
	 *
	 * Web Development
	 *
	 */


	public function javascript(){

	/*
	|--------------------------------------------------------------------------
	| JavaScript Test
	|--------------------------------------------------------------------------
	|
	|
	*/			

		// Page heading
		$data['heading'] = 'Programming Test 2 <br/><br/> <strong><small>Javascript</small></strong>';

		// Page form
		$data['post'] = '<div id="output">	</div> <form id="form" name="form"> <h3>Enter Your Information!</h3> <div> <label for="name">Name :</label><br> <input id="name" type="text"> <br><br> <label>Email :</label><br> <input id="email" type="text"> <br><br> <label for="age"> Age:</label><br> <input id="age" type="text"> <br><br> <label for="addr">Address :</label><br> <input id="addr" type="text"> <br><br> <input id="submit" onclick="send()" type="button" value="Send"> </div> </form>';

		$this->load->view('layout', $data);
		
	}

	public function ajax(){

	/*
	|--------------------------------------------------------------------------
	|  JavaScript Test => Ajax Backend
	|--------------------------------------------------------------------------
	| This return all user inputs via Ajax
	*/
		echo '
			<h3>Your Inputs</h3>
			<p> Name : '.$_POST['name'].'</p>
			<p> Email : '.$_POST['email'].'</p>
			<p> Age : '.$_POST['age'].'</p>
			<p> Address : '.$_POST['addr'].'</p>';

	}


	public function app(){

	/*
	|--------------------------------------------------------------------------
	| Application Development
	|--------------------------------------------------------------------------
	| Simple Web Application for Saving and processing Students report in Five subjects
	|
	*/			

		// Page heading
		$data['heading'] = 'Programming Test 2 <br/><br/> <strong><small>App Development </small></strong>';

		// Check if all required field are posted
		if(isset($_POST['name']) & isset($_POST['eng']) & isset($_POST['phy']) & isset($_POST['chem']) & isset($_POST['bio']) & isset($_POST['maths'])){

			// Covert Inputs to array
			$data1 = array(
					'name' => $this->input->post('name'),
					'eng' => $this->input->post('eng'),
					'maths' => $this->input->post('maths'),
					'phy' => $this->input->post('phy'),
					'bio' => $this->input->post('bio'),
					'chem' => $this->input->post('chem')
					);

			// Get database Model ready
			$this->load->model('students_Db');

			// Save records
			if ($this->students_Db->save_record($data1)) {
				
				$data['post'] = "Record Save Successfully for <strong>".$data1['name'].'</strong>';

			}
			else{

				$data['post'] = '<strong> Unable to complete your Request. Please, try again Later</strong>';
			}

		}

		// Input form
		$data['post'] = (isset($data['post']) ? $data['post'] : '').'<form id="form" name="form" action="/test2/app" method="post"> <h3>Enter Student Result</h3> <div> <label > Student Name :</label><br> <input name="name" type="text" required> <br><br> <label>English :</label><br> <input name="eng" type="number" required> <br><br> <label>Mathematics :</label><br> <input name="maths" type="number" required> <br><br> <label>Physics :</label><br> <input name="phy" type="number" required> <br><br> <label>Chemistry :</label><br> <input name="chem" type="number" required> <br><br> <label>Biology :</label><br> <input name="bio" type="number" required> <br><br> <input type="submit" name="submit" value="Save"> </div> </form> <p><a href="/test2/report">View Students Report</a></p>';

		$this->load->view('layout', $data);
		
	}	

	public function report(){

		/* Students Report Processing */

		$data['heading'] = 'Programming Test 2 <br/><br/> <strong><small>App Development </small></strong>';

		// Get database Model ready
		$this->load->model('students_Db');

		// Load Students record
		$report = $this->students_Db->load_report();

		$data['post'] = '<h3> Students Report</h3><table><thead><tr><th>S/N</th><th>Students Name</th><th>English</th><th>Mathematics</th><th>Physics</th><th>Biology</th><th>Chemistry</th><th>Average Score</th><th>Median Score</th><th>Maximum Score</th></tr></thead><tbody>';

		// Test if report is empty
		if (count($report) > 0){
			
			for ($i=0; $i < count($report) ; $i++) { 

				// Generate table rows for each record
				$data['post'] = $data['post'].'<tr><td>'.($i + 1).'</th><td>'.$report[$i]['name'].'</td><td>'.$report[$i]['eng'].'</td><td>'.$report[$i]['maths'].'</td><td>'.$report[$i]['phy'].'</td><td>'.$report[$i]['bio'].'</td><td>'.$report[$i]['chem'].'</td><td>'.$report[$i]['average'].'</td><td>'.$report[$i]['median'].'</td><td>'.$report[$i]['mode'].'</td></tr>';		
			}
		}
		else{

			// Return no record found for empty table
			$data['post'] = $data['post'].'<tr><td colspan="10"> No Record Found </td></tr>';

		}

		$data['post'] = $data['post'].'</tbody></table><p><a href="/test2/app">Add New Record</a></p>';

		$this->load->view('layout', $data);
	}	

	public function index(){

		/* Test 2 default Page */

		$data['heading'] = 'Programming Test 2';

		$data['post'] = '	<p><a href="/test2/javascript">JavaScript</a> </p>
							<p>	<a href="/test2/app">Application Development</a> </p>	';

		$this->load->view('layout', $data);
	}
}
