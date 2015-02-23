<div id="data" class='content col-md-12'>
    <?php $isPerson = isset($personData) && $personData != false; ?>
    <?php if ($isPerson) { ?>
        <div id="personData" class="col-md-4 personBlock">
            <div class="medText">Your personal info</div>
            <table class="table table-condensed">
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
            <div class="medText">Update your personal info</div>
        <?php } else { ?>
            <div class="medText">Fill in personal info</div>
        <?php } ?>
        <div class="form-inline">
            <div class="form-group input-group-sm col-md-5">
                <input id="person_name" name="person_name" class="form-control" type="text" placeholder="Name" value="<?php echo $personData['person_name']; ?>"> </div>
            <div class="form-group input-group-sm col-md-5">
                <input id="person_surname" name="person_surname" class="form-control" type="text" placeholder="Surname" value="<?php echo $personData['person_surname']; ?>"> </div>
        </div>
        <div class="br"></div>
        <div class="form-inline">
            <div class="form-group input-group-sm col-md-7">
                <input id="person_birth" name="person_birth" class="form-control" type="date" placeholder="Birth" value="<?php echo $personData['person_birth']; ?>"> 
            </div>
            <div class="col-md-5"><select id="personGender" name="person_gender" style="width: 126%;" class="form-control">
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
                </select></div>
        </div>
        <div class="br"></div>
        <div class="input-group input-group-sm col-md-12">
            <div class="col-md-4">
                <input name="submit" class="btn btn-danger col-md-12" type="submit" value="Save">
            </div>
            <a href="#" style="font-size: 32px; float: right;">
                <span style="margin-right: 0px;" class="glyphicon glyphicon-info-sign" aria-hidden="true"></span>
            </a>
        </div>
    </div>
    <?php echo form_close(); ?>
    <div id="imgGalary" class="col-md-4 personBlock">
        <div class="medText">Show your face</div>
        <div class="br"></div>
        <?php
        $imgLink = FCPATH . '/img/avatars/' . $this->session->userdata('user_login') . '.png';
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
        <input class='file' type='file' name='userfile' value='Choose' size='20' />
        <input class='btn btn-sm btn-info col-md-5' style='margin-top: 20px;' type='submit' name='submit' value='Upload' />
        <?php echo "</form>" ?>
    </div>
    <?php if (isset($mailsList) && $mailsList != false) { ?>
        <div id = "mails" class="col-md-12">
            <table class = "table-striped col-md-12">
                <tr>
                    <th>Mail</th>
                    <th>Last log in</th>
                    <th>IP</th>
                    <th>Visibility</th>
                    <th>Remove</th>
                </tr>
                <?php
                foreach ($mailsList as $mail): {
                        ?>
                        <tr id="mailID<?php echo $mail['mail_id'] ?>">
                            <td><i style="color: #006dcc;">
                                    <?php
                                    $pos = strpos($mail['mail_email'], '@');
                                    echo str_replace(substr($mail['mail_email'], 3, $pos - 2), '**@', $mail['mail_email']);
                                    ?></i></td>
                            <td><?php echo $mail['mail_last_log_in'] ?></td>
                            <td width="30%;"><?php echo $mail['mail_ip'] ?></td>
                            <td width="100px;"><div class="access accessMail<?php echo $mail['mail_access'] ?>"></div></td>
                            <td width="100px;"><div id="mailID<?php echo $mail['mail_id'] ?>" class="deleteMail"></div></td>
                        </tr>
                        <?php
                    }
                endforeach;
                ?>
            </table>
        </div> <?php }
            ?>
    <?php echo form_open("user/addMail"); ?>
    <div id="addMail" class="col-md-4 personBlock">
        <div class="medText">Add email</div>
        <div class="br"></div>
        <div class="form-group">
            <label class="sr-only" for="exampleInputEmail3">Email address</label>
            <input type="email" class="form-control" id="mail" name="mail_email" placeholder="Enter email">
        </div>
        <div class="checkbox">
            <label>
                <input type="checkbox" name="mail_access"> Set visible to other
            </label>
        </div>
        <button type="submit" class="btn btn-default">Sign in</button>
    </div>
    <?php echo form_close(); ?>
</div>
</body>
</html>