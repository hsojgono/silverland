<h1>Add Permission</h1>

<div id="infoMessage"><?php echo $message;?></div>

<?php echo form_open();?>
<p>
    <label for="">Function:</label><br />
    <select class="" name="function_id">
        <?php foreach ($system_functions as $key => $value): ?>
        <option value="<?php echo $value->s_function_id; ?>"><?php echo $value->s_function_name; ?></option>
        <?php endforeach; ?>
    </select>
</p>
<p>
    <?php echo form_label('Name:', 'perm_name');?> <br />
    <?php echo form_input('perm_name', set_value('perm_name')); ?> <br />
    <?php echo form_error('perm_name'); ?>
</p>
<p>
    <?php echo form_label('Key:', 'perm_key');?> <br />
    <?php echo form_input('perm_key', set_value('perm_key')); ?> <br />
    <?php echo form_error('perm_key'); ?>
</p>



<p>
    <?php echo form_submit('submit', 'Save');?>
    <?php echo form_submit('cancel', 'Cancel');?>
</p>

<?php echo form_close();?>
