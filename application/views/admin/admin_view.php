<div id="data" class="content col-md-12">
    <div class="medText">Admin page</div>
    <div class="br"></div>
    <div class="col-md-12">
        <div class="panel panel-primary">
                <div class="panel-heading" id="achHead">
                    <h3 class="panel-title">Achievements</h3>
                </div>
                <div class="panel-body">
                    <p>In this block you can add or update achievements. If you want to add an achievement - try to click this button 
                        <a id="addAchLink" href="#" style="font-size: 20px;"><span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span></a>
                    </p>
                    <div id="addAchBlock" hidden>
                        <div class="form-inline form-group-sm col-md-12">
                            <input id="achName" class="form-control">
                            <input id="achDesc" class="form-control">
                            <a id="addAchBtn" href="#" class="btn-sm">ADD</a>
                        </div>
                    </div>
                </div>
                <table id="achList" class="table table-striped" hidden>
                    <tr>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Group</th>
                        <th>Edit</th>
                    </tr>
                    <?php
                    foreach ($achievs as $ach): {
                            $ach = (array) $ach;
                            ?>
                            <tr>
                                <td><?php echo $ach['achievs_name']; ?></td>
                                <td><?php echo $ach['achievs_desc']; ?></td>
                                <td><?php echo $ach['achievs_group']; ?></td>
                                <td><a href="#"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a></td>
                            </tr>
                            <?php
                        }
                    endforeach;
                    ?>
                </table>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading" id="grHead">
                    <h3 class="panel-title">Achievement Groups</h3>
                </div>
                <div class="panel-body">
                    <p>Below you can see groups of achievements. For now it's empty, and all new achievements will get group_id(1).
                        <br>
                        In future it must be a list of groups and posibility to add more. And when you will add a new achievement above,
                        you will be able to choose a group from dropbox.
                    </p>
                </div>
                <table id="grList" class="table table-striped" hidden>
                    <tr>
                        <th>Name</th>
                        <th>Edit</th>
                        <th>Ach Count</th>
                    </tr>
                    <tr>
                        <td>NONE</td>
                        <td>NONE</td>
                        <td>NONE</td>
                    </tr>
                </table>
            </div>

    </div>
</div>