<?php
    function readCSV($filepath) {

        echo "<html><body><center><table>\n\n";

        if(!file_exists($filepath)) {
            echo "File not found";
            return;
        }
        
        $file = fopen($filepath, "r");
        while (($data = fgetcsv($file)) !== false) {

            echo "<tr>";
            foreach ($data as $i) {
                if($i != "Year" && $i != "Award" && $i != "Details"){
                    echo "<td class='p-3'>" . htmlspecialchars($i) . "</td>";
                }
            }
            echo "</tr> \n";
        }

        fclose($file);

        echo "\n</table></center></body></html>";
    }
?>