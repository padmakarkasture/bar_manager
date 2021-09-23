<?php
function derive($name, $category){
    $concat=$name.$category;
    $trimmed=str_replace(' ', '', $concat);
    $sidetrimmed=trim($trimmed);
    $lowered=strtolower($sidetrimmed);
    return $lowered;
}
?>
