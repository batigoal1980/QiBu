<div class="mainBlock">
  <div class="stepsBox">
    <ol>
      <li>Database Server</li>
      <li>Web Server</li>
      <li>GuruDonation Settings</li>
      <li style="font-weight: bold;">Finished!</li>
    </ol>
  </div>

  <h1>New Installation</h1>

  <p>This web-based installation routine will correctly setup and configure GuruDonation to run on this server.</p>
  <p>Please follow the on-screen instructions that will take you through the database server, web server, and store configuration options. If help is needed at any stage, please consult the documentation.</p>
</div>

<div class="contentBlock">
  <div class="infoPane">
    <h3>Step 4: Finished!</h3>

    <div class="infoPaneContents">
      <p>Congratulations on installing and configuring GuruDonation!</p>
      <p>We wish you all the best with the success of your site and welcome you.</p>
    </div>
  </div>

  <div class="contentPane">
    <h2>Finished!</h2>

<?php
  $dir_fs_document_root = $HTTP_POST_VARS['DIR_FS_DOCUMENT_ROOT'];
  if ((substr($dir_fs_document_root, -1) != '\\') && (substr($dir_fs_document_root, -1) != '/')) {
    if (strrpos($dir_fs_document_root, '\\') !== false) {
      $dir_fs_document_root .= '\\';
    } else {
      $dir_fs_document_root .= '/';
    }
  }

  $http_url = parse_url($HTTP_POST_VARS['HTTP_WWW_ADDRESS']);
  $http_server = $http_url['scheme'] . '://' . $http_url['host'];
  $http_catalog = $http_url['path'];
  if (isset($http_url['port']) && !empty($http_url['port'])) {
    $http_server .= ':' . $http_url['port'];
  }

  if (substr($http_catalog, -1) != '/') {
    $http_catalog .= '/';
  }

  $file_contents = '<?php' . "\n" .
                   '  $domainurl="' . $http_server . '/";' . "\n" .
				   '  $databasename="'. trim($HTTP_POST_VARS['DB_DATABASE']) . '";'. "\n".
				   '  $dbusername="'. trim($HTTP_POST_VARS['DB_SERVER_USERNAME']) . '";'. "\n".
				   '  $dbpassword="'. trim($HTTP_POST_VARS['DB_SERVER_PASSWORD']) . '";'. "\n".
				   '  $hostname="'. trim($HTTP_POST_VARS['DB_SERVER']). '";'. "\n".
                   '?>';

  	$fp = fopen($dir_fs_document_root . 'includes/config.php', 'w');
  	fputs($fp, $file_contents);
  	fclose($fp);
	include($dir_fs_document_root . "includes/createdb.php");
	include($dir_fs_document_root . "includes/init.php");
	include_once($dir_fs_document_root . "includes/func.php");
	newsett("adminpaypal",trim($HTTP_POST_VARS['CFG_STORE_OWNER_EMAIL_ADDRESS']));
	newadmin(trim($HTTP_POST_VARS['CFG_ADMINISTRATOR_USERNAME']),trim($HTTP_POST_VARS['CFG_ADMINISTRATOR_PASSWORD']));
?>

    <p>The installation and configuration was successful! You need to delete install folder for the security.</p>

    <br />

  </div>
</div>
