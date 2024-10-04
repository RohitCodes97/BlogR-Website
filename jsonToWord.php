<?php
// Function to save or update in a word document
function saveToWordDocument($content, $filename = "postData.doc"){
    
    $formattedContent = $content."\n\n";

    file_put_contents($filename, $formattedContent, FILE_APPEND | LOCK_EX);

}

function exportJsonToWord($jsonFile, $filename = 'postData.doc'){
    if(file_exists($jsonFile)){
        $jsonData = file_get_contents($jsonFile);
        $arrayData = json_decode($jsonData, true);

        $content = "Data from $jsonFile:\n".json_encode($arrayData, JSON_PRETTY_PRINT);

        saveToWordDocument($content, $filename);
    }
}

?>