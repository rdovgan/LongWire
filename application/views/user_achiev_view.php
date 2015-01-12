<div id="data">
    <div class="bigText">Achievements</div>
<table class="table table-striped">
    <tr><th>Group</th><th>Name</th><th>Desc</th><th>Got</th><th>Date</th></tr>
    <?php if(isset($achievs) && $achievs!=false) {
        foreach ($achievs as $item): ?>
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
    <?php endforeach;
} else {echo "Sorry, we can't take your achievements";}?>
</table>
</div>
</body>
</html>