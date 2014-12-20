<div id="userPanel">
    <div class="panelTitle">PAGES</div>
    <ul class="nav nav-pills nav-stacked">
        <li class="active"><a href="#"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>Dashboard</a></li>
        <li><a href="#"><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span>Messages</a></li>
        <li><a href="#"><span class="glyphicon glyphicon-thumbs-up" aria-hidden="true"></span>People</a></li>
        <li><a href="#"><span class="glyphicon glyphicon-calendar" aria-hidden="true"></span>Calendar</a></li>
        <li><a href="#"><span class="glyphicon glyphicon-picture" aria-hidden="true"></span>Galary</a></li>
        <li><a href="#"><span class="glyphicon glyphicon-user" aria-hidden="true"></span>Profile</a></li>
    </ul>
    <div class="panelTitle">ELEMENTS</div>
    <ul class="nav nav-pills nav-stacked">
        <li><a href="#"><span class="glyphicon glyphicon-text-width" aria-hidden="true"></span>Typography</a></li>
        <li><a href="#"><span class="glyphicon glyphicon-heart-empty" aria-hidden="true"></span>Layout</a></li>
        <li><a href="#"><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>Tables</a></li>
        <li><a href="#"><span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>Form</a></li>
        <li><?php echo anchor('#', '<span class="glyphicon glyphicon-pushpin" aria-hidden="true"></span>Buttons') ?></li>
        <li><a href="#"><span class="glyphicon glyphicon-phone" aria-hidden="true"></span>Mobile</a></li>
    </ul>
</div>
<div id="data">
    <p>The basic goals of ASP.NET Ajax are:
    <ul>
        <li>Reduced web server </li>
        <li>Reduced Network load</li>
        <li>Interactive user interface</li>
        <li>Platform and architecture neutrality</li>
        <li>Support for both synchronous and asynchronous communication</li>
        <li>Provide a server- and client-side framework</li>
    </ul></p>
<table class="table table-striped">
    <tr><th>Group</th><th>Name</th><th>Desc</th><th>Got</th><th>Date</th></tr>
    <?php foreach ($achievs as $item): ?>
        <tr>
            <td>
                <?php echo $item['ach_gr']; ?>
            </td>
            <td>
                <?php echo $item['ach_name']; ?>
            </td>
            <td>
                <?php echo $item['ach_desc']; ?>
            </td>
            <td>
                <?php echo $item['ach_checked']; ?>
            </td>
            <th>
                <?php echo ($item['ach_checked'] == 'true') ? date('Y/m/d', strtotime($item['ach_got'])) : ''; ?>
            </th>
        <tr>
        <?php endforeach; ?>
</table>
</div>