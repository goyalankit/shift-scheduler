<?php


    if(!empty($variables) && isset($variables[0]["UniqueId"])){        
        $variables = $variables[0];    
    }       
   
?>
		<style type="text/css">
			body {
				font-family: Arial, Verdana, sans-serif;}
			form div {
				border-bottom: 1px solid #efefef;
				margin: 10px;
				padding-bottom: 10px;
				width: 260px;}
			.submit {
				text-align: right;}
		</style>
	</head>
	<body>
		<form action="processUser.php" method="post">			
                    <div>
				<label for="first name" class="title" >First Name:</label>
				<input type="text" id="name" name="FirstName" value="<?php isset($variables["FirstName"]) ? print $variables["FirstName"] : "" ?>" required/>
			</div>
                        <div>
				<label for="last name" class="title">Last Name:</label>
				<input type="text" id="name" name="LastName" value="<?php isset($variables["LastName"]) ? print $variables["LastName"] : "" ?>"  />
			</div>
                        <div>
				<label for="Nick Name" class="title">Nick Name:</label>
				<input type="text" id="name" name="NickName" value="<?php isset($variables["NickName"]) ? print $variables["NickName"] : "" ?>" />
			</div>
                    
                        <div>
				<label for="UT EID required" class="title">UT EID:</label>
				<input type="text" id="name" name="UniqueId" value="<?php isset($variables["UniqueId"]) ? print $variables["UniqueId"] : "" ?>" required />
			</div>                    	                        
                    
			<div class="radio-buttons">
				<span class="title">Active:</span>
				<input type="radio" name="Active" id="yes" value="true" value ="true"  <?php (isset($variables["Active"]) && $variables["Active"]=="true") ? print "checked" : "" ?> />
				<label for="true">yes</label>
				<input type="radio" name="Active" id="no" value="false" value ="false" <?php isset($variables["Active"]) && $variables["Active"]=="false" ? print "checked" : "" ?>/>
				<label for="false">no</label><br />
			</div>
                    
			<div class="submit">
				<input type="submit" value="<?php isset($variables["UniqueId"]) ? print "update" : print "create" ?>" id="submit" />
			</div>
		</form>
	</body>
</html>