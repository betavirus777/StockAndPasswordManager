<?php

    require_once "/home/vhosts/tenison4.ueuo.com/include/mysql.php";
    
    session_start();
    
	DB::$user = '1018813';
    DB::$password = 'saikiran1';
    DB::$host = 'localhost';
    DB::$dbName = '1018813';
    
    function password_verify($str, $s)
    {
    	if($str == $s)
    		return true;
    	else return false;
    }
    
    function password_hash($str, $s)
    {
    	return $str;
    }
    
    function random_string($length)
    {
    	$chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890!@';
    	
    	$chars = substr(str_shuffle($chars), 0, strlen($chars));
    	return substr(str_shuffle($chars), 0, $length);
    }

    function check_table($database, $table)
    {
    	return DB::queryFirstField("SELECT count(*) FROM information_schema.tables WHERE table_schema = %s AND table_name = %s", $database, $table);
    }
    
    function create_database($host, $username, $password, $database)
    {
    	$conn = new mysqli($host, $username, $password);
    	if ($conn->connect_errno)
    	{
    		echo "Error : Cannot_Connect_to_MySQL";
    		return false;
    	}
    	
    	$db_selected = mysqli_select_db($conn, $database);
    	if (!$db_selected)
    	{
    		$db = $database;
    		$ret = $conn->query("CREATE DATABASE {$db}");
    		if(!$ret)
    		{
    			echo "Error : Cannot_Create_Database";
    			return false;
    		}
    	}
    	$conn->close();
    	return true;
    }

    function dump()
    {
        $arguments = func_get_args();
        require_once realpath($_SERVER["DOCUMENT_ROOT"])."/views/dump.php";
        exit;
    }

    function logout()
    {
        $_SESSION = [];

        if (!empty($_COOKIE[session_name()]))
        {
            setcookie(session_name(), "", time() - 42000);
        }

        session_destroy();
    }

    function redirect($location)
    {
        if (headers_sent($file, $line))
        {
            trigger_error("HTTP headers already sent at {$file}:{$line}", E_USER_ERROR);
        }
        header("Location: {$location}");
        exit;
    }

    function render($view, $values = [])
    {
        if (file_exists("../views/{$view}"))
        {
            extract($values);

            require("../views/header.php");
            require("../views/{$view}");
            require("../views/footer.php");
            exit;
        }

        else
        {
            trigger_error("Invalid view: {$view}", E_USER_ERROR);
        }
    }
    
    function lookup($symbol)
    {
    	if (preg_match("/^\^/", $symbol))
    	{
    		return false;
    	}

    	if (preg_match("/,/", $symbol))
    	{
    		return false;
    	}
    	
    	$headers = [
    			"Accept" => "*/*",
    			"Connection" => "Keep-Alive",
    			"User-Agent" => sprintf("curl/%s", curl_version()["version"])
    	];
    	
    	$context = stream_context_create([
    			"http" => [
    					"header" => implode(array_map(function($value, $key) { return sprintf("%s: %s\r\n", $key, $value); }, $headers, array_keys($headers))),
    					"method" => "GET"
    					]
    				]);

    	$handle = @fopen("http://download.finance.yahoo.com/d/quotes.csv?f=snl1&s={$symbol}", "r", false, $context);
    	if ($handle === false)
    	{
    		trigger_error("Could not connect to Yahoo!", E_USER_ERROR);
    		exit;
    	}

    	$data = fgetcsv($handle);
    	if ($data === false || count($data) == 1)
    	{
    		return false;
    	}

    	fclose($handle);
    	if ($data[2] === "N/A" || $data[2] === "0.00")
    	{
    		return false;
    	}

    	return [
    			"symbol" => strtoupper($data[0]),
    			"name" => $data[1],
    			"price" => floatval($data[2])
    	];
    }

?>
