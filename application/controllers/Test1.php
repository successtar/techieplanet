<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Test1 extends CI_Controller {

	/**
	 *
	 * Techie Planet Challenge Test 1 Controller.
	 * 
	 * Contain Part A and B of the exercise
	 * 
	 * Part A => Proramming and Algorithm
	 *
	 * Part B => Databases and SQL
	 *
	 */


	public function one(){

	/*
	|--------------------------------------------------------------------------
	| Part A => Question 1
	|--------------------------------------------------------------------------
	|
	| Convert inputtime to statement
	|
	*/	
		// Page heading
		$data['heading'] = 'Programming Test 1 (P & A) <br/><br/> <strong><small>Ques one</small></strong>';

		// Does user enter time
		if (isset($_POST['hour']) && isset($_POST['minute'])){

			$hr = ceil($_POST['hour']);

			$min = ceil($_POST['minute']);
			
			if ($hr >= 1 && $hr <= 12 && $min >= 0 &&  $min < 60){	// Does user enter a valid time

				// Array for most possible numbers
				$words = array(0 => 'zero', 1 => 'one', 2 => 'two', 3 => 'three', 4 => 'four', 5 => 'five', 6 => 'six', 7 => 'seven', 8 => 'eight', 9 => 'nine', 10 => 'ten', 11 => 'eleven', 12 => 'twelve', 13 => 'thirteen', 14 => 'fourteen', 15 => 'fifteen', 16 => 'sixteen', 17 => 'seventeen', 18 => 'eighteen', 19 => 'nineteen', 20 => 'twenty', 30 => 'thirty', 40 => 'fourty', 50 => 'fifty', 60 => 'twenty');

				/* Test time conditions */

				if ($min == 30){

					$data['post'] = $_POST['hour'].' : '.$_POST['minute'].' => Half past '.$words[$hr].' <br/><br/>';
				}
				elseif ($min == 15){

					$data['post'] = $_POST['hour'].' : '.$_POST['minute'].' => Quarter past '.$words[$hr].' <br/><br/>';
				}
				elseif ($min == 45){

					$xhr = ($hr+1) > 12 ? 1 : $hr+1;

					$data['post'] = $_POST['hour'].' : '.$_POST['minute'].' => Quarter to '.$words[$xhr].' <br/><br/>';
				}
				elseif ($min == 0){

					$data['post'] = $_POST['hour'].' : '.$_POST['minute'].' => '.ucfirst($words[$hr]).' o\'clock <br/><br/>';
				}
				elseif ($min <= 20){

					$data['post'] = $_POST['hour'].' : '.$_POST['minute'].' => '.ucfirst($words[$min]).' minutes past '.$words[$hr].' <br/><br/>';
				}
				elseif ($min > 20 && $min <30){

					$tenth = floor($min/10)*10;

					$rem = $min - $tenth;

					$data['post'] = $_POST['hour'].' : '.$_POST['minute'].' => '.ucfirst($words[$tenth]).' '.$words[$rem].' minutes past '.$words[$hr].' <br/><br/>';
				}
				elseif ($min > 30 && $min <40){

					$to = 60 - $min; 

					$tenth = floor($to/10)*10;

					$rem = $to - $tenth;

					$xhr = ($hr+1) > 12 ? 1 : $hr+1;

					$data['post'] = $_POST['hour'].' : '.$_POST['minute'].' => '.ucfirst($words[$tenth]).' '.$words[$rem].' minutes to '.$words[$xhr].' <br/><br/>';
				}
				elseif ($min >= 40 && $min < 60){

					$to = 60 - $min; 

					$xhr = ($hr+1) > 12 ? 1 : $hr+1;

					$data['post'] = $_POST['hour'].' : '.$_POST['minute'].' => '.ucfirst($words[$to]).' minutes to '.$words[$xhr].' <br/><br/>';
				}
				else{

					$data['post'] = $_POST['hour'].' : '.$_POST['minute'].' => No Answer <br/><br/>';

				}		
			}
			else{

				$data['post'] = "Please, Enter a valid time <br/><br/>";
			}

		}

		$data['post'] = '<h3>Convert time to word</h3>'.(isset($data['post']) ? $data['post'] : '').'<form action="/test1/one" method="post"> <label>Enter Time</label> <input type="number" name="hour" placeholder="Hour"/><b> : </b><input type="number" name="minute" placeholder="Minute"/> <input type="submit" name="submit" value="Convert"> </form>';

		// Load layout in the view folder with data generated in this controller 
		$this->load->view('layout', $data);

	}

	public function two(){

	/*
	|--------------------------------------------------------------------------
	| Part A => Question 2
	|--------------------------------------------------------------------------
	|
	| Palindrome
	|
	*/	
		/* Page heading */

		$data['heading'] = 'Programming Test 1 (P & A) <br/><br/> <strong><small>Ques two</small></strong>';

		/* Does user enter input */

		if (isset($_POST['word'])){
			
			if (strlen($_POST['word']) >= 2){	// is user input more than or equal two characters

				$input = $_POST['word'];

				/* Test if user input is same as the reversed */

				if (strtolower(strrev($input)) === strtolower($input)){ 

					$data['post'] = 'TRUE => '.$input." is a palindrome word <br/><br/>";

				}
				else{

					$data['post'] = 'FALSE => <strong>'.$input."</strong> is not a palindrome word <br/><br/>";

				}

			}
			else{

				$data['post'] = "Enter Minimum of Two characters <br/><br/>";
			}

		}

		$data['post'] = '<h3>Test for Palindrome word</h3>'.(isset($data['post']) ? $data['post'] : '').'<form action="/test1/two" method="post"> <input type="text" name="word" placeholder="Enter word"/> <input type="submit" name="submit" value="Check"> </form>';

		/* Load layout in the view folder with data generated in this controller */

		$this->load->view('layout', $data);

	}

	public function three(){

	/*
	|--------------------------------------------------------------------------
	| Part A => Question 3
	|--------------------------------------------------------------------------
	|
	| Creating of staircase 
	|
	*/		
		/* Page heading */

		$data['heading'] = 'Programming Test 1 (P & A) <br/><br/> <strong><small>Ques three</small></strong>';

		/* Is height data post with the request */
		
		if (isset($_POST['height'])){

			// Filter integer
			$height = filter_var($_POST['height'], FILTER_SANITIZE_NUMBER_INT);

			// Test height Range
			if ($height >= 1 && $height <= 100){

				$res = '';

				$hash = '';

				$space = '&nbsp;';

				// Generate Maximum #
				for ($i=0; $i < $height; $i++){

					$hash = $hash.'#';

				}

				// Increase space while decreasing #
				for ($i=0; $i < $height; $i++){

					$res = '<div>'.$space.$hash.'</div>'.$res;

					$space = $space.'&nbsp;&nbsp;';

					$hash = substr($hash,1);
				}

				$data['post'] = $res.'<br/><br/>';
			}
			else{

				$data['post'] = "Please, enter integer in the range 1 to 100 <br/><br/>";
			}
		}

		$data['post'] = '<h3>Create staircase by specifying height between 1 and 100</h3>'.(isset($data['post']) ? $data['post'] : '').'<form action="/test1/three" method="post"> <input type="number" name="height" placeholder="Enter height"/> <input type="submit" name="submit" value="Create"> </form>';

		// Load layout in the view folder with data generated in this controller 
		$this->load->view('layout', $data);
	}


	public function four(){

	/*
	|--------------------------------------------------------------------------
	| Part A => Question 4
	|--------------------------------------------------------------------------
	|
	| Sum Numbers with Recursive function
	|
	*/		
		// Page heading
		$data['heading'] = 'Programming Test 1 (P & A)<br/><br/> <strong><small>Ques Four</small></strong>';

		// Is digit data post with the request
		if (isset($_POST['input'])){

			
			if ($_POST['input'] > 0){

				function compute($res, $i, $input){

					$res = $res + $input[$i];

					$i++;

					return ($i >= strlen($input)) ? $res : compute($res, $i, $input);				
				}

				$sum = compute(0, 0, $_POST['input']);

				$data['post'] = 'Result for '.$_POST['input'].' => <strong>'.$sum.'</strong> <br/><br/>';
			}
			else{

				$data['post'] = "Please, enter a valid digit <br/><br/>";
			}
		}

		$data['post'] = '<h3>Summation of digits with recursive function</h3>'.(isset($data['post']) ? $data['post'] : '').'<form action="/test1/four" method="post"> <input type="number" name="input" placeholder="Enter digit"/> <input type="submit" name="submit" value="Calculate"> </form>';

		// Load layout in the view folder with data generated in this controller 
		$this->load->view('layout', $data);
	}

	public function sql(){

	/*
	|--------------------------------------------------------------------------
	| Part B (SQL)
	|--------------------------------------------------------------------------
	|
	| Sum Numbers 
	|
	*/		
		// Page heading
		$data['heading'] = 'Programming Test 1 (SQL)<br/><br/> <strong><small>All Question</small></strong>';

		// The SQL Answers
		$data['post'] = '<p><strong>Question 2 Answer</strong></p>
		<code>SELECT MAX(salary) FROM emp WHERE salary < (SELECT MAX(salary) FROM emp)</code>
		<code>SELECT salary FROM (SELECT DISTINCT salary FROM emp ORDER BY salary DESC LIMIT 2) AS emp ORDER BY salary LIMIT 1 </code>

		<p> <strong>Question 3 Answer</strong></p>
		<code>SELECT games.yr, city.country FROM games INNER JOIN city ON games.city=city.name ORDER BY games.yr</code>

		<p> <strong>Question 4 Answer</strong></p>
		<div>The SQL JOIN keyword is used in an SQL statement to query data from two or more tables, based on a relationship between certain columns in these tables. </div>
		<p>SQL LEFT JOIN</p>
		<div>The LEFT JOIN keyword returns all rows from the left table (games), even if there are no matches in the right table (city). i,e all values in the game table will appear in the result</div>
		<code>SELECT games.yr, games.city, city.country FROM games LEFT JOIN city ON games.city=city.name ORDER BY games.yr </code>

		<p>SQL RIGHT JOIN</p>
		<div>The RIGHT JOIN keyword Return all rows from the right table (city), even if there are no matches in the left table (game). i,e all values in the city table will appear in the result</div>
		<code>SELECT games.yr, games.city, city.country FROM games RIGHT JOIN city ON games.city=city.name ORDER BY games.yr </code>

		<p><strong>Question 5 Answer</strong></p>
		<code>SELECT userId, AVG(duration) FROM sessions GROUP BY userId HAVING COUNT(userId)>1</code>';
		

		// Load layout in the view folder with data generated in this controller 
		$this->load->view('layout', $data);
	}

	public function index(){

		/* Test 1 default Page */

		$data['heading'] = 'Programming Test 1';

		$data['post'] = '	<p><a href="/test1/one">Question 1</a>	 (P & A)</p>
							<p>	<a href="/test1/two">Question 2</a>	 (P & A)</p>
							<p>	<a href="/test1/three">Question 3</a>	 (P & A)</p>
							<p>	<a href="/test1/four">Question 4</a>	 (P & A)</p>
							<p>	<a href="/test1/sql">Part B</a>	 (SQL)</p>	';

		$this->load->view('layout', $data);
	}
}
