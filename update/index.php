<?php

ini_set('display_errors', 0);
define('BASEPATH','NO');
$db_config_path = '../application/config/database.php';
include($db_config_path);
$cf_config_path = '../application/config/config.php';
include($cf_config_path);
// Only load the classes in case the user submitted the form
if($_POST) {

	// Load the classes and create the new objects
	require_once('includes/core_class.php');
	require_once('includes/database_class.php');

	$core = new Core();
	$database = new Database();


	// Validate the post data
	if($core->validate_post($_POST) == true)
	{

		// First create the database, then create tables, then write config file
		if($database->create_database($_POST) == false) {
			$message = $core->show_message('error',"The database could not be created, please verify your settings.");
		} else if ($database->create_tables($_POST) == false) {
			$message = $core->show_message('error',"The database tables could not be created, please verify your settings.");
		} else if ($core->write_config($_POST) == false) {
			$message = $core->show_message('error',"The database configuration file could not be written, please chmod application/config/database.php and config.php file to 777");
		}
		
		// If no errors, redirect to registration page
		if(!isset($message)) {
		$redir = $_POST['siteurl'];
			?>
			<script>alert('Script successfully updated.\nPLEASE DELETE UPDATE AND INSTALL FOLDER');
				setInterval(function() {
					window.location.href = '<?php echo $redir; ?>';
				}, 500);</script>
<?php
		}

	}
	else {
		$message = $core->show_message('error','Not all fields have been filled in correctly. The host, username, password, and database name are required.');
	}
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

		<title>Update | FixBook - Management Tool</title>

		<link href="../css/style.css" rel="stylesheet">
		<link href="../css/bootstrap.min.css" rel="stylesheet">
		<link href="../css/bootstrap-reset.css" rel="stylesheet">
	</head>
	<body class="login-body">
        
        <div id="login_head">
                <img src="../img/logo.png">
                <?php if(is_writable($db_config_path) && is_writable($cf_config_path)){?>
                <?php if(isset($message)) {echo '<p class="error">' . $message . '</p>';}?> 
            <div style="clear: both;"></div>
        </div>
		
        <div id="status">
            <div id="check">

                <div class="form-signin" id="login-form">
                    <form id="install_form" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                        <div class="install-wrap">
                            <div class="input-field col-lg-12">
                                <h2 class="form-signin-heading">FixBook Update to 3.0</h2>
                            </div>
                            <p class="tips"></p>
                            <div class="input-field col-lg-6">
                                <div class="form-group">
                                    <label>Panel url (with final /)</label><input type="text" id="siteurl" value="<?php echo $config['base_url']?>" class="form-control" name="siteurl"  />
                                </div>
                            </div>
                            <div class="input-field col-lg-6">
                                <div class="form-group">
                                    <label>Mysql Hostname</label>
                                    <input type="text" value="<?= $db['default']['hostname'] ?>" id="hostname" value="localhost" class="form-control" name="hostname"  />
                                </div>
                            </div>
                            <div class="input-field col-lg-6">
                                <div class="form-group">
                                    <label for="username">Mysql Username</label><input value="<?= $db['default']['username'] ?>" type="text" id="username" class="form-control" name="username"  />
                                </div>
                            </div>

                            <div class="input-field col-lg-6">
                                <div class="form-group">
                                    <label for="password">Mysql Password</label><input value="<?= $db['default']['password'] ?>" type="password" id="password" class="form-control" name="password"  />
                                </div>
                            </div>

                            <div class="input-field col-lg-6">
                                <div class="form-group">
                                    <label for="database">Mysql Database Name</label><input type="text" value="<?= $db['default']['database'] ?>" id="database" class="form-control" name="database" />
                                </div>
                            </div>
                            <div class="input-field col-lg-12">
                                <INPUT class="btn btn-lg btn-login btn-block btn-success" id="loginButton" TYPE="SUBMIT" value="Update FixBook">
                                    </div>

                            </div>
                            </form>
                        <div style="clear: both;"></div>
                        </div>
                    <div style="clear: both;"></div>
                </div>
            </div>

        </div>
		

	  <?php } else { ?>
      <p class="error">Please make the application/config/database.php file writable. <strong>Example</strong>:<br /><br /><code>chmod 777 application/config/database.php</code></p>
	  <?php } ?>

	</body>
</html>
