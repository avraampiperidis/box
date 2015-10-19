<?php


/**
 * kali periptosh gia unit testing!
 *
 * @param $data string eisodos
 * @return string to string xoris kena ,eidikous xaraktires kai '//'
 */
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

?>