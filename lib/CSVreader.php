<?php
    function readCSV($filepath, $col, $row) {

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
?>