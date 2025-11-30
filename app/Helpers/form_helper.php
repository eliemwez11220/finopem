<?php 
	function display_validation_error($validation, $field){
        //$validation = \CodeIgniter\Config\Services::validation();
		if(isset($validation) && ! empty($validation))
		{
			if($validation->hasError($field)){
				echo $validation->getError($field);
            }
       }
       return false;
	}
	function displayFormError($validation, $field){
        //$validation = \CodeIgniter\Config\Services::validation();
		if(isset($validation) && ! empty($validation))
		{
			if($validation->hasError($field)){
				echo $validation->getError($field);
            }
       }
       return false;
	}
	?>