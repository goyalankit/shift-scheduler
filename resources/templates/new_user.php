<?php
if (!empty($variables) && isset($variables[0]["UniqueId"])) {
    $variables = $variables[0];
}
?>

</head>
<body>

    <div class="page-header">
        <h3>Add a new user</h3>
    </div>

    <form class="form-horizontal well" role="form" action="processUser.php" method="post">
        <div class="form-group">
            <label for="firstname" class="col-sm-2 control-label">First Name</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" id="name" name="FirstName" value="<?php isset($variables["FirstName"]) ? print $variables["FirstName"]  : "" ?>" required/>      
            </div>
        </div>
        <div class="form-group">
            <label for="lastname" class="col-sm-2 control-label">Last Name</label>
            <div class="col-sm-4">
                <input type="text" id="name" name="LastName" class="form-control" value="<?php isset($variables["LastName"]) ? print $variables["LastName"]  : "" ?>"  />      
            </div>
        </div>
        <div class="form-group">
            <label for="Nickname" class="col-sm-2 control-label">Nick Name</label>
            <div class="col-sm-4">
                <input type="text" id="name" name="NickName"  class="form-control" value="<?php isset($variables["NickName"]) ? print $variables["NickName"]  : "" ?>" />
            </div>
        </div>
        <div class="form-group">
            <label for="inputPassword3" class="col-sm-2 control-label">Username</label>
            <div class="col-sm-4">
                <input type="text" id="name" name="UniqueId" class="form-control" value="<?php isset($variables["UniqueId"]) ? print $variables["UniqueId"]  : "" ?>" required />
            </div>
        </div>   

        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">

                <div class="checkbox">
                    <label>
                        <input type="radio" name="Active" id="yes" value="true" value ="true"  <?php (isset($variables["Active"]) && $variables["Active"] == "true") ? print "checked"  : "" ?> /> Activate
                    </label>
                </div>
                <div class="checkbox">
                    <label>
                        <input type="radio" name="Active" id="no" value="false" value ="false" <?php isset($variables["Active"]) && $variables["Active"] == "false" ? print "checked"  : "" ?>/> Inactivate
                    </label>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-default">create/update</button>
                <a href="processAdminLogin.php" class="btn btn-info btn-large"><i class="icon-white icon-arrow-left"></i> back</a>
            </div>
        </div>
    </form>
</body>
</html>