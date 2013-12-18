<form type="submit" method="post" action="processShifts.php" class="well">                                  
    <?php    
    
    for ($i = 1; $i < 5; $i++) {
        $shift_var = empty($variables["shift" . $i]) ? NULL : $variables["shift" . $i];

        echo '<h3> Shift' . ($i) . '</h3>
                
        <div class="form-group">
            <label for="Active" class="col-sm-2 control-label">Active</label>
            <div class="col-sm-4">
                <input type="checkbox" value="true" ' . (is_null($shift_var) ? false : (!empty($shift_var["Active"]) ? "checked" : "")) . ' name="shift' . $i . '_active"/> <br/>
            </div>
        </div>
        <br/>
        <div class="form-group">
            <label for="from" class="col-sm-2 control-label">Timings</label>
            <div class="col-sm-4">               
               From: <input type="text" id="time3" name="shift' . $i . '_from" size="10" value="' . (is_null($shift_var) ? "08:00" : $shift_var["ShiftFrom"]) . '" />                    
                   To: <input type="text" id="time4" name="shift' . $i . '_to" size="10" value="' . (is_null($shift_var) ? "12:00" : $shift_var["ShiftTo"]) . '" />
            </div>
        </div><br/>
        
        <div class="form-group">
            <label for="to" class="col-sm-2 control-label">Number of Candidates </label>
            <div class="col-sm-1">               
              <input type="number" name="shift' . $i . '_numberOfCandidates" value="' . (is_null($shift_var) ? 3 : $shift_var["NumberOfCandidates"]) . '" />          
            </div>
        </div>
        <br/>
        
        <div class="form-group">        
        <label for="to" class="col-sm-2 control-label">Days </label>            
            <label class="checkbox-inline">
                <input type="checkbox" id="inlineCheckbox1" name="shift'.$i.'_days_sunday" value="sunday" '. (((getId("sunday", $shift_var['ShiftId'], $shift_var['Active'], "true")) == -1) ? "" : "Checked" ).'> Sun                
                <input type="text" name="shift'.$i.'_shiftid_sunday" class="hidden" value='.getId("sunday", $shift_var['ShiftId'], $shift_var['Active'], "false").'>    
            </label>

            <label class="checkbox-inline">
                <input type="checkbox" id="inlineCheckbox2" name="shift'.$i.'_days_monday" value="monday" '. ((getId("monday", $shift_var['ShiftId'], $shift_var['Active'], "true") == -1) ? "" : "Checked" ).'> Mon
                <input type="text" name="shift'.$i.'_shiftid_monday" class="hidden" value='.getId("monday", $shift_var['ShiftId'], $shift_var['Active'], "false").'>
            </label>
            <label class="checkbox-inline">
                <input type="checkbox" id="inlineCheckbox3" name="shift'.$i.'_days_tuesday" value="tuesday" '. ((getId("tuesday", $shift_var['ShiftId'],$shift_var['Active'], "true") == -1) ? "" : "Checked" ).'> Tue
                    <input type="text" name="shift'.$i.'_shiftid_tuesday" class="hidden" value='.getId("tuesday", $shift_var['ShiftId'], $shift_var['Active'], "false").'>
            </label>
            <label class="checkbox-inline">
                <input type="checkbox" id="inlineCheckbox3" name="shift'.$i.'_days_wednesday" value="wednesday" '. ((getId("wednesday", $shift_var['ShiftId'], $shift_var['Active'], "true") == -1) ? "" : "Checked" ).'> Wed
                        <input type="text" name="shift'.$i.'_shiftid_wednesday" class="hidden" value='.getId("wednesday", $shift_var['ShiftId'], $shift_var['Active'], "false").'>
            </label>
            <label class="checkbox-inline">
                <input type="checkbox" id="inlineCheckbox3" name="shift'.$i.'_days_thursday" value="thursday" '. ((getId("thursday", $shift_var['ShiftId'], $shift_var['Active'], "true") == -1) ? "" : "Checked" ).'> Thurs
                        <input type="text" name="shift'.$i.'_shiftid_thursday" class="hidden" value='.getId("thursday", $shift_var['ShiftId'], $shift_var['Active'], "false").'>
            </label>
            <label class="checkbox-inline">
                <input type="checkbox" id="inlineCheckbox3" name="shift'.$i.'_days_friday" value="friday" '. ((getId("friday", $shift_var['ShiftId'], $shift_var['Active'], "true") == -1) ? "" : "Checked" ).'> Fri
                    <input type="text" name="shift'.$i.'_shiftid_friday" class="hidden" value='.getId("friday", $shift_var['ShiftId'], $shift_var['Active'], "false").'>
            </label>
            <label class="checkbox-inline">
                <input type="checkbox" id="inlineCheckbox3" name="shift'.$i.'_days_saturday" value="saturday" '. ((getId("saturday", $shift_var['ShiftId'], $shift_var['Active'], "true") == -1) ? "" : "Checked" ).'> Sat
                    <input type="text" name="shift'.$i.'_shiftid_saturday" class="hidden" value='.getId("saturday", $shift_var['ShiftId'], $shift_var['Active'], "false").'>
            </label>
        </div>

    <br/>';
    }
    
    
    //$boolkey = true corresponds to the checkboxes field. It's value will be used to decide whether checkbox is checked or not
    //$boolkey = false sets the value of the shiftid to be set. If shift is active then the shiftd will be returned else -1 is returned.        
    function getId($value,$id_day,$activeArray,$boolkey){
        if(empty($id_day))
            return -1;
        $key = array_search($value, $id_day);        
        if($key == FALSE){
            return -1;
        }
        else{
            if($boolkey == "false"){
                return $key;
            }
            else{
                if($activeArray[$key] == "false")
                    return -1;
                else
                    return $key;    
            }            
        }
    }
    
    //                <input type="text" name="shift'.$i.'_shiftid" class="hidden" '.(is_null($shift_var) ? "" : "value=".$shift_var["ShiftId"]).'>
    ?>                                   
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-primary">Create/Update</button>
            <a href="processAdminLogin.php" class="btn btn-info btn-large"><i class="icon-white icon-arrow-left"></i> back</a>
        </div>
    </div>   <br/> 

</form>

<br/>
<!--<input type="text" name="shift' . $i . '_shiftid" class="hidden" ' . (is_null($shift_var) ? "" : "value=" . $shift_var["ShiftId"]) . '>            -->