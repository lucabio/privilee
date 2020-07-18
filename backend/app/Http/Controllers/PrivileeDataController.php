<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PrivileeDataController extends Controller
{
    /**
     * Retrive the images filtered or not by name and purchase discount.
     *
     * @param  Request  $request
     * @return json
     */
    private $valueArray = array();
    private $data = array();

    public function getData(Request $request)
    {
        $path = storage_path() . "/data/privileeOffers.json";
        $jsonString = file_get_contents($path);
        $this->data = json_decode($jsonString, true);

        $name = $request->route('name') ?? 'all';
        $discount = $request->route('discount') ?? '';

        //Default request: returns all data
        if( $name == 'all' && $discount == '' ) {
            $this->valueArray = $this->data;
        }
        //Search for all other possible results 
        else {
              $this->filterOffersArray($name,$discount);
        }

        return response()->json($this->valueArray);
    }

    private function filterOffersArray($name,$discount){
        $num = count($this->data);
        $discountFilter = false;
        
        if($discount != ''){
            $discountFilter = true;
        }

        if($name != 'all'){
            for($i=0;$i < $num;$i++){
                if(($pos = strpos(strtolower($this->data[$i]['name']),strtolower($name))) !== false){
                    if($discountFilter){
                        if(intval($this->data[$i]['discount_percentage'] == intval($discount))){
                            array_push($this->valueArray,$this->data[$i]);
                        }
                    }else{
                        array_push($this->valueArray,$this->data[$i]);
                    }
                    
                }
            }
        }else{
            for($i=0;$i < $num;$i++){
                if(intval($this->data[$i]['discount_percentage'] == intval($discount))){
                    array_push($this->valueArray,$this->data[$i]);
                }
            }
        }

        

    }
}
?>