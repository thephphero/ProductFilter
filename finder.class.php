<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class finder {

    private $file;

    function __construct($filename = 'items.csv') {
        $this->file = $filename;
    }

    //Filter results according to criteria and return result array
    public function filter($filter = array()) {
        $result = array();
        //Filter out empty values from array
        $criteria = array_filter($filter);
        //add missing values
        if (!isset($criteria['socket'])) {
            $criteria['socket'] = 'no';
        }
        if (!isset($criteria['socket'])) {
            $criteria['socket'] = 'no';
        }
        //iterate through file     
        foreach ($this->loadFile() as $item) {
            $flag = true;
            //If one of the criteria is not satisfied, mark as false
            foreach ($criteria as $key => $var) {
                //Shape criteria
                if ($key == 'shape') {
                    if (!in_array($var, $item['shape'])) {
                        $flag = false;
                    }
                }
                //Form criteria
                if ($key == 'form') {
                    if (!in_array($var, $item['form'])) {
                        $flag = false;
                    }
                }
                //Material criteria
                if ($key == 'material') {
                    if (!in_array($var, $item['material'])) {
                        $flag = false;
                    }
                }
                //Height Criteria
                if ($key == 'height') {
                    if (abs($var) > $item['height']) {
                        $flag = false;
                    }
                }
                //Lighting Criteria
                if ($key == 'lighting') {
                    if (!(strtolower($item['lighting']) == $var)) {
                        $flag = false;
                    }
                }
                //Socket Criteria              
                if ($key == 'socket') {
                    if (!(strtolower($item['socket']) == $var)) {
                        $flag = false;
                    }
                }
                //equipment criteria
                if ($key == 'equipment') {
                    if (!(strtolower(trim($var)) == strtolower(trim($item['equipment'])))) {
                        $flag = false;
                    }
                }
            }
            //If all criteria is satisfied, add row to results
            if ($flag) {
                array_push($result, $item);
            }
        }
        return $result;
    }

    //Load valus from CSV file and return data array
    private function loadFile() {
        if (($handle = fopen($this->file, "r")) !== FALSE) {
            $data = array();
            $counter = 0;
            while (($row = fgetcsv($handle, 1000, ";")) !== FALSE) {
                $data[$counter] = array(
                    'alias' => $row[0],
                    'name' => $row[1],
                    'short_url' => $row[3] . $row[2],
                    'shape' => array(),
                    'form' => array(),
                    'material' => array(),
                    'lighting' => (trim(strtolower($row[10])) == 'x') ? 'yes' : 'no',
                    'socket' => (trim(strtolower($row[11])) == 'x') ? 'yes' : 'no',
                    'height' => $row[13],
                    'equipment' => (trim(strtolower($row[14])) == 'x') ? 'lit' : 'unlit',
                    'url' => $row[4]
                );

                if (trim(strtolower($row[5])) == 'x')
                    array_push($data[$counter]['shape'], 'straight');
                if (trim(strtolower($row[6])) == 'x')
                    array_push($data[$counter]['shape'], 'convex');
                if (trim(strtolower($row[7])) == 'x')
                    array_push($data[$counter]['shape'], 'concav');
                if (trim(strtolower($row[8])) == 'x')
                    array_push($data[$counter]['form'], 'triangular');
                if (trim(strtolower($row[9])) == 'x')
                    array_push($data[$counter]['form'], 'cubical');
                //If no other form has been determined, mark as normal
                if (empty($data[$counter]['form'])) {
                    array_push($data[$counter]['form'], 'normal');
                }
                if (trim(strtolower($row[12])) == 'x') {
                    array_push($data[$counter]['material'], 'glass');
                }
                $counter++;
            }

            fclose($handle);
        }
        return $data;
    }

}

?>
