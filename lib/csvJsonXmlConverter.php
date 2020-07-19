<?php
    namespace CsvConverter;

    use CsvConverter\Printer;

    class csvJsonXmlConverter
    {
        protected $file = "";
        private $keysArray = array();
        private $itemsArray= array();
        private $privileeArray= array();
        private $printer;

        /**
         * Public function to load csv file from path taken from CLI input
         */
        public function __construct(array $argv)
        {
            if (isset($argv[1])) {
                $this->file = $argv[1];
                $this->printer = new Printer();
                $this->generateArrayFromCSV();
            }
    
        }
        /**
         * Private function to generate array from CSV Object
         */
        private function generateArrayFromCSV(){
            $row = 1;
            $this->printer->printTitle();
            if (($handle = fopen($this->file, "r")) !== FALSE) {
                while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                    $num = count($data);
                    for ($c=0; $c < $num; $c++) {
                        //build key array
                        if($row == 1){
                            array_push($this->keysArray, $this->remove_utf8_bom($data[$c]));
                            $this->printer->printInlineText("\n building key array ; adding key " . $data[$c]);
                        }else{
                            $this->item_array[$this->keysArray[$c]] = $data[$c]; 
                        }        
                    }
                    //skip adding the $item_array first time
                    if($row > 1){
                        array_push($this->privileeArray,$this->item_array);
                    }
                    $row++;
                }

            }
            $this->printer->printArray($this->privileeArray);
        }
        /**
         * Public Function to generate JSON file
         */
        public function generateJSONfile($filename){

            if(isset($filename)){
                $json = json_encode($this->privileeArray, JSON_PRETTY_PRINT);
                $this->saveFile($json,$filename,'json');
                
            }

        }
        /**
         * Public function to generate XML file
         */
        public function generateXMLfile($filename){
            $xml = new \SimpleXMLElement('<offer/>');
            $this->to_xml($xml, $this->privileeArray);
            $xmlcontent = $xml->asXML();

            $this->saveFile($xmlcontent,$filename,'xml');
        }
        /**
         * Private function to save file,copy it into the specific directory of backend storage and remove it from root folder once finished
         */
        private function saveFile($content, $filename, $ext){
            $fp = fopen($filename.'.'.$ext, 'w');
            fwrite($fp, $content);
            fclose($fp);
            copy($filename.'.'.$ext, 'be/storage/'.$filename.'.'.$ext);
            unlink($filename.'.'.$ext);
        }
        /**
         * Private function to convert array into XML object
         */
        private function to_xml(\SimpleXMLElement $object, array $data)
        {   
            foreach ($data as $key => $value) {
                if (is_array($value)) {
                    $new_object = $object->addChild($key);
                    $this->to_xml($new_object, $value);
                } else {
                    $object->addChild($key, $value);
                }   
            }   
        }   
        /**
         * Private function to remove Byte Order Mark from key values
         */
        private function remove_utf8_bom($text)
        {
            $bom = pack('H*','EFBBBF');
            $text = preg_replace("/^$bom/", '', $text);
            return $text;
        }
    }

?>