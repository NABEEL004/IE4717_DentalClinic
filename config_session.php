<?php
    ini_set('session.use_only_cookies',1);
    ini_set('session.use_strict_mode',1);
    
    session_set_cookie_params([
        'lifetime'=>600,
        'domain'=>'localhost',
        'path'=>'/',
        'secure'=>true,
        'httponly'=>true
    ]);

    session_start();

    // if users have logged in
    if(isset($_SESSION["user_id"])){
        if(!isset($_SESSION["last_regeneration"])){
            regenerate_session_id_logged_in();
        }
        else{
            $interval = 300; // geneate new session id every 5 mins
            if(time()-$_SESSION["last_regeneration"]>=$interval)
            {
                regenerate_session_id_logged_in();
            }
        }
    
    }
    else{
        if(!isset($_SESSION["last_regeneration"])){
            regenerate_session_id();
        }
        else{
            $interval = 300; // geneate new session id every 5 mins
            if(time()-$_SESSION["last_regeneration"]>=$interval)
            {
                regenerate_session_id();
            }
        }
    
    }


    function regenerate_session_id()
    {
        session_regenerate_id(true);
        $_SESSION["last_regeneration"] = time();
    }

    function regenerate_session_id_logged_in()
    {
        session_regenerate_id(true);
        $new_sessionID = session_create_id();
        $sessionID = $new_sessionID."_".$_SESSION["user_id"];
        session_id($sessionID);

        $_SESSION["last_regeneration"] = time();

    }


?>