      <?php
        # Retrieve settings from Parameter Store
        error_log('Retrieving settings');
        require 'aws-autoloader.php';
      
        $az = file_get_contents('http://169.254.169.254/latest/meta-data/placement/availability-zone');
        $region = substr($az, 0, -1);
        
        $ssm_client = new Aws\Ssm\SsmClient([
          'version' => 'latest',
          'region'  => $region
        ]);

	# create S3Client
/*	$s3Client = new Aws\S3\S3Client([
		'version' => 'latest',
		'region' => $region,
		'credentials' => false	
	]);

	$result = $s3Client->getObject([
		'Bucket' => 'website-mthornton',
		'Key' => 'test.txt',
		'Body' => 'body'
	]);
 */

#	echo $result['Body'];

        try {
         /* # Retrieve settings from Parameter Store
          $result = $ssm_client->GetParametersByPath(['Path' => '/inventory-app/', 'WithDecryption' => true]);

          # Extract individual parameters
          foreach($result['Parameters'] as $p) {
              $values[$p['Name']] = $p['Value'];
          }

          $ep = $values['/inventory-app/endpoint'];
          $un = $values['/inventory-app/username'];
          $pw = $values['/inventory-app/password'];
          $db = $values['/inventory-app/db'];
	  */

	# Retrieve settings from .env
	
		
	$file = file_get_contents(".env");
	$json = json_decode($file, true);

	error_log($json["endpoint"]);

	$ep = $json["endpoint"];
	$un = $json["username"];
	$pw = $json["password"];
	$db = $json["database"];

	}

        catch (Exception $e) {
          $ep = '';
          $db = '';
          $un = '';
          $pw = '';
        }
      #error_log('Settings are: ' . $ep. " / " . $db . " / " . $un . " / " . $pw);
      ?>
