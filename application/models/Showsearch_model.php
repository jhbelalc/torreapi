<?php
 
class Showsearch_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    

    /*
     * Get people data by search param
     * get_data_people(0,"name","john harold belalcazar lozano");
     */
    function get_data_people($offset, $field, $val)
    {
        
        $url = "https://search.torre.co/people/_search/?offset=$offset&size=20&aggregate=false";

        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        $headers = array(
        "Content-Type: application/json",
        );
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

        $data = '{"'.$field.'":{"term":"'.$val.'"}}';

        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);


        $response = curl_exec($curl);
        $err = curl_error($curl);
          
		curl_close($curl);
        //echo $response;
        //die(print_r($response));

		$objUsr= json_decode($response, true);

        return $objUsr;
    }


    
    function get_data_opor($offset, $val)
    {
        
        $url = "https://search.torre.co/opportunities/_search/?offset=$offset&size=20&aggregate=false";

        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        $headers = array(
        "Content-Type: application/json",
        );
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

        $data = '{"skill/role":{"text":"'.$val.'", "experience": "1-plus-year", "status": "open"}}';

        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

        $response = curl_exec($curl);
        $err = curl_error($curl);
          
		curl_close($curl);

		$objUsr= json_decode($response, true);

        return $objUsr;
    }
}
