<?php
    if(isset($_SESSION)){
        foreach ($_SESSION as $chave => $valor) {
            unset($_SESSION[$chave]);
        }
    }
    session_start(); 
    session_destroy(); 
   
   header('Refresh: 1; URL = index.php'); 