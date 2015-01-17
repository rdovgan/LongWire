<div id="data" class='content'>

    <div class="bigText">Gallery page</div>

    <div id="imgGalary"></div>
    
    <div class="wide br-line"></div>
    
    <?php if(isset($error) && isset($error['error'])){echo $error.' '.$error['error'];} ?> <!-- Error Message will show up here -->
    <?php echo form_open_multipart('post/uploadAvatar'); ?>
    <?php echo "<input type='file' name='userfile' size='20' />"; ?>
    <?php echo "<input type='submit' name='submit' value='upload' /> "; ?>
    <?php echo "</form>" ?>

</div>
</body>
</html>