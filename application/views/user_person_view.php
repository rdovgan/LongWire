<div id="data" class='content'>

    <div class="bigText">Fill in personal info</div>

    <?php echo form_open("user/savePerson"); ?>
    <div id="personForm" class="col-md-4 panel">
        <div class="input-group input-group-sm col-md-12">
            <input id="person_name" name="person_name" class="form-control col-md-8" type="text" placeholder="Name"> </div>
        <div class="br"></div>
        <div class="input-group input-group-sm col-md-12">
            <input id="person_surname" name="person_surname" class="form-control col-md-8" type="text" placeholder="Surname"> </div>
        <div class="br"></div>
        <div class="input-group input-group-sm col-md-12">
            <input id="person_birth" name="person_birth" class="form-control col-md-8" type="date" placeholder="Birth"> </div>
        <div class="br"></div>
        <div class="input-group input-group-sm col-md-12">
            <select id="person_gender" name="person_gender" class="form-control col-md-8" placeholder="Gender">
                <option value='' disabled selected style='display:none;'>Choose your gender</option>
                <option value="1">Male</option>
                <option value="2">Female</option>
            </select>
        </div>
        <div class="br"></div>
        <div class="input-group input-group-sm col-md-12">
            <input name="submit" class="btn btn-danger col-md-4" type="submit" value="Save">
            <a href="#" style="font-size: 32px; float: right;">
                <span style="margin-right: 0px;" class="glyphicon glyphicon-info-sign" aria-hidden="true"></span>
            </a>
        </div>
    </div>
    <?php echo form_close(); ?>
</div>
</body>
</html>