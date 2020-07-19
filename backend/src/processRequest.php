<?php
    namespace Src;


    class ProcessRequest {

         /**
         * Retrive the images filtered or not by name and purchase discount.
         *
         * @return json
         */
        private $valueArray = array();
        private $data = array();

        public function getData($name,$discount)
        {
            $path = "./storage/privileeOffers.json";
            $jsonString = file_get_contents($path);
            $this->data = json_decode($jsonString, true);

            $name = $name ?? 'all';
            $discount = $discount ?? '';

            //Default request: returns all data
            if( $name == 'all' && $discount == '' ) {
                $this->valueArray = $this->data;
            }
            //Search for all other possible results 
            else {
                $this->filterOffersArray($name,$discount);
            }

            //return response()->json($this->valueArray);
            $this->sendResponse();
        }

        private function sendResponse(){
            $response['status_code_header'] = 'HTTP/1.1 200 OK';
            $response = json_encode($this->valueArray);
            echo $response;
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