<?php
function redirectHelper($page){
    header('Location:' . URLROOT . '/' . $page);
}
?>