<?php
    /**
     * Class to print console output with public functions
     * 
     */
    namespace CsvConverter;

    class Printer {

        public function printTitle(){
            echo "\n**********************************************\n";
            echo "*** CREATE JSON FILE AND XML FILE FROM CSV ***";
            echo "\n**********************************************\n";
        }

        public function printInlineText($text){
            echo $text;
        }

        public function printArray($array){
            echo "\n\n-------------------------------------------\n\n";
            echo "\nOutput Array\n";
            print_r($array);
        }
    }
?>