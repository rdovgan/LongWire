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
</body>
</html>