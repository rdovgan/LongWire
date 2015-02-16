<div id="data" class='content'>
    <?php $isPerson = isset($personData) && $personData != false; ?>
    <?php if ($isPerson) { ?>
        <div id="personData" class="col-md-6 personBlock">
            <div class="bigText">Your personal info</div>
            <table class="table table-striped">
                <tr>
                    <td>Name</td>
                    <td><?php echo $personData['person_name']; ?></td>
                </tr>
                <tr>
                    <td>Surname</td>
                    <td><?php echo $personData['person_surname']; ?></td>
                </tr>
                <tr>
                    <td>Date of birth</td>
                    <td><?php echo $personData['person_birth']; ?></td>
                </tr>
                <tr>
                    <td>Gender</td>
                    <td><?php
                        if ($personData['person_gender'] == '1') {
                            echo 'Male';
                        } else if ($personData['person_gender'] == '2') {
                            echo 'Female';
                        } else {
                            echo 'Unknown';
                        }
                        ?></td>
                </tr>
            </table>
            <button id="btnPersonForm" class="btn"><span class="glyphicon glyphicon-plus"></span></button>
        </div>
    <?php } ?>


    <?php echo form_open("user/savePerson"); ?>
    <div id="personFormBlock" class="col-md-4 panel personBlock" <?php
    if ($isPerson) {
        echo 'hidden="false"';
    }
    ?>>
             <?php if ($isPerson) { ?>
            <div class="bigText">Update your personal info</div>
        <?php } else { ?>
            <div class="bigText">Fill in personal info</div>
        <?php } ?>

        <div class="input-group input-group-sm col-md-12">
            <input id="person_name" name="person_name" class="form-control col-md-8" type="text" placeholder="Name" value="<?php echo $personData['person_name']; ?>"> </div>
        <div class="br"></div>
        <div class="input-group input-group-sm col-md-12">
            <input id="person_surname" name="person_surname" class="form-control col-md-8" type="text" placeholder="Surname" value="<?php echo $personData['person_surname']; ?>"> </div>
        <div class="br"></div>
        <div class="input-group input-group-sm col-md-12">
            <input id="person_birth" name="person_birth" class="form-control col-md-8" type="date" placeholder="Birth" value="<?php echo $personData['person_birth']; ?>"> </div>
        <div class="br"></div>
        <div class="input-group input-group-sm col-md-12">
            <select id="person_gender" name="person_gender" class="form-control col-md-8" placeholder="Gender">
                <option value='' disabled  <?php
                if ($personData['person_gender'] != '1' && $personData['person_gender'] != '2') {
                    echo 'selected';
                }
                ?>  style='display:none;'>Choose your gender</option>
                <option value="1" <?php
                if ($personData['person_gender'] == '1') {
                    echo 'selected';
                }
                ?> >Male</option>
                <option value="2"  <?php
                if ($personData['person_gender'] == '2') {
                    echo 'selected';
                }
                ?> >Female</option>
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
    <div id="imgGalary" class="col-md-6 personBlock">
        <div class="bigText">Show your face</div>
        <div class="br"></div>
        <?php
        $imgLink = FCPATH.'/img/avatars/'.$this->session->userdata('user_login').'.png';
        if (is_file($imgLink)) {
            ?>
            <div class="avatarBig">
                <img src="/img/avatars/<?php echo $this->session->userdata('user_login') ?>.png"
                     width="96" height="96" border="0">
            </div>
        <?php } ?>
            <?php
            if (isset($error) && isset($error['error'])) {
                echo $error['error'];
            }
            ?>
            <?php echo form_open_multipart('user/uploadAvatar'); ?>
            <?php echo "<input class='file' type='file' name='userfile' value='Choose' size='20' />"; ?>
            <?php echo "<input class='btn btn-sm btn-info col-md-3' style='margin-top: 20px;' type='submit' name='submit' value='Upload' /> "; ?>
            <?php echo "</form>" ?>
    </div>
</div>
</body>
</html>