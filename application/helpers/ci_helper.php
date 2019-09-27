<?php
/**
	* Fetch an item from either the GET array or the POST
	*
	* @access	public
	* @param	string	The index key
	* @param	mixed	Default value if false	 
	* @param	bool	XSS cleaning
	* @param	bool	MYSQL REAL ESCAPE STRING cleaning
	* @return	mixed
	*/	
if ( ! function_exists('get_post'))
{
	function get_post($index="",$default="",$escape=false,$xss_clean=true){
		$CI=&get_instance();
		if(isset($_POST[$index])){
			if(!$escape) {
				return $CI->input->post($index, $xss_clean);
			} else {
				$data = $CI->input->post($index, $xss_clean);
				if(is_array($data)){
					foreach($data as $key => $val){
						$data[$key] = mysqli_real_escape_string($CI->db->conn_id,$val);
					}
					return $data;
				} else {
					return mysqli_real_escape_string($CI->db->conn_id, $data);
				}				
			}
		} else if(isset($_GET[$index])) {
			if($escape) {
				$data = $CI->input->get($index, $xss_clean);
				if(is_array($data)){
					foreach($data as $key => $val){
						$data[$key] = mysqli_real_escape_string($CI->db->conn_id,$val);
					}
					return $data;
				} else {
					return mysqli_real_escape_string($CI->db->conn_id, $data);
				}
			} else {
				return $CI->input->get($index, $xss_clean);
			}
		} else {
			return $default;
		}
	}
}	
