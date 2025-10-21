<?php
    function readCSV($filename) {

        echo "<html><body><center><table>\n\n";

        if(!file_exists($filename)) {
            echo "File not found";
            return;
        }
        
        $file = fopen($filename, "r");
        while (($data = fgetcsv($file)) !== false) {

            echo "<tr>";
            foreach ($data as $i) {
                echo "<td>" . htmlspecialchars($i) 
                    . "</td>";
            }
            echo "</tr> \n";
        }

        fclose($file);

        echo "\n</table></center></body></html>";
    }
?>