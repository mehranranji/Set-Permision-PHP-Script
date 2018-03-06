<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Change Permisions</title>
  <style>
    body {
      font-family: tahoma, arial;
      text-align: center;
    }

    body form {
      width: 992px;
      max-width: 100%;
      margin: 30px auto;
      text-align: center;

    }

    input[type="submit"] {
      padding: 25px 50px;
      font-family: tahoma, arial;
      font-size: 18px;
    }
    textarea{
      width:100%;
      width:calc(100% - 30px);
      font-family: tahoma, arial;
      padding:15px;
      margin:25px auto;
      color:#666;
      line-height:22px;
    }
    input{
      width:100%;
      padding:8px;
    }
    .form-group{
      margin:20px 0;
    }
  </style>
</head>

<body>
  <form action="" method="post">
    <input type="hidden" name="run" value="true" />
    <div class="form-group"><input type="submit" value="Run Script" /></div>
    <?
      function chmod_r($dir, $dirPermissions, $filePermissions) {
          $dp = opendir($dir);
          $html = '';
          while($file = readdir($dp)) {
            if (($file == ".") || ($file == ".."))
                continue;
            $fullPath = $dir."/".$file;

            if(is_dir($fullPath)) {
                chmod($fullPath, $dirPermissions);
                chmod_r($fullPath, $dirPermissions, $filePermissions);
            } else {
                chmod($fullPath, $filePermissions);
            }
            $html .= 'OK --> ' . $fullPath . "\n";
          }

          return $html;
          closedir($dp);
      }

      if($_POST['run']):
        $dirperm = 0755;
        $fileperm = 0644;
        echo '<textarea rows="10" readonly>'.chmod_r(dirname(__FILE__), $dirperm, $fileperm).'</textarea>';
      endif;

    ?>
  </form>
</body>

</html>