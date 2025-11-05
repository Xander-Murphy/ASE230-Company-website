<?php
    function readCSVElement($filepath, $col, $row) {

        if(!file_exists($filepath)) {
            echo "File not found";
            return;
        }
        
        $file = fopen($filepath, "r");
        $currentRow = 0;
        
        while (($data = fgetcsv($file)) !== false) {

            if ($currentRow == $row) {
                fclose($file);
                
                return $data[$col];

            }
            $currentRow++;
        }

        fclose($file);

    }

    function readCSVObject($filepath, $row) {
        if(!file_exists($filepath)) {
            echo "File not found";
            return;
        }
        $file = fopen($filepath, "r");
        $currentRow = 0;
        
        while (($data = fgetcsv($file)) !== false) {

            if ($currentRow == $row) {
                fclose($file);
                return $data;
            }
            $currentRow++;
        }
        fclose($file);
    }

    function readAllCSV($filepath) {

        if(!file_exists($filepath)) {
            echo "File not found";
            return;
        }
        
        $file = fopen($filepath, "r");
        $all = [];
        
        while (($data = fgetcsv($file)) !== false) {

            array_push($all, $data);
        }

        fclose($file);

        return $all;

    }

    function getCSVByTwo($filepath, $name, $year) {

        if(!file_exists($filepath)) {
            echo "File not found";
            return;
        }
        
        $objects = readAllCSV($filepath);
        foreach($objects as $obj){
            if($obj[1] == $name && $obj[0] == $year)
                return $obj;
        }
    }

    function appendCSV($filepath, $newData){
        $handle = fopen($filepath, 'r+');
        fseek($handle, -1, SEEK_END);
        $lastChar = fgetc($handle);
        if ($lastChar !== "\n") {
            fwrite($handle, PHP_EOL);
        }
        fputcsv($handle, $newData);
        fclose($handle);
    }

    function deleteCSV($filepath, $object){
        $rows = [];
        if (($handle = fopen($filepath, 'r')) !== false) {
            while (($data = fgetcsv($handle)) !== false) {
                if (!($data[0] === $object[0] && $data[1] === $object[1])) {
                    $rows[] = $data;
                }
            }
            fclose($handle);
        }

        if (($handle = fopen($filepath, 'w')) !== false) {
            foreach ($rows as $row) {
                fputcsv($handle, $row);
            }
            fclose($handle);
        }
    }

    function updateCSVRow($filepath, $oldRow, $newRow){
        if(!file_exists($filepath)) {
            echo "File not found";
            return;
        }
        
        $file = fopen($filepath, "r");
        $all = [];
        
        while (($data = fgetcsv($file)) !== false) {
            if($data == $oldRow)
                array_push($all, $newRow);
            else
                array_push($all, $data);
        }

        fclose($file);

        if (($handle = fopen($filepath, 'w')) !== false) {
            foreach ($all as $row) {
                fputcsv($handle, $row);
            }
            fclose($handle);
        }
    }
?>