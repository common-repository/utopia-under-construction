<?php


if ( ! class_exists( 'ki_check' ) ) {	
    class ki_check{
	
		function im_isset_var($name) {
			if (isset($name)) {
				return $name; 
			} else 
			return "";
		}
		function im_isset_var2($array,$name) {
			if (isset($array[$name])) {
				return $this->im_isset_var($array[$name]); 
			} else 
			return "";
		}
		function isset_var($array,$name) {
			if (isset($array[$name])) {
				return $this->im_isset_var($array[$name][0]); 
			} else 
			return "";
		}
        
        // End of Class					
    }
}

?>