<script>
    toastr.options.showEasing = 'swing';
    toastr.options.hideEasing = 'linear';
    toastr.options.closeEasing = 'linear';

    var notification = {};
    // var isNotificationSound = '<?php //echo $notification['sound']; ?>';
    
    notification.sound = function() {
        if (isNotificationSound)
        {
            // $('#notification-sound')[0].play();
        }
    }
</script>
<div class="row">
    <div class="col-md-12">
        <?php if ($this->session->flashdata('message')): ?>
            <script>
                toastr.info('<?php echo $this->session->flashdata('message'); ?>', 'MESSAGE:');
                notification.sound();
            </script>
        <?php endif; ?>
        <?php if ($this->session->flashdata('success')): ?>
            <script>
                toastr.success('<?php echo $this->session->flashdata('success'); ?>', 'SUCCESS:');
                notification.sound();
            </script>
        <?php endif; ?>
        <?php if ($this->session->flashdata('warning')): ?>
            <script>
                toastr.warning('<?php echo $this->session->flashdata('warning'); ?>', 'WARNING:');
                notification.sound();
            </script>
        <?php endif; ?>
        <?php if ($this->session->flashdata('error')): ?>
            <script>
                toastr.error('<?php echo $this->session->flashdata('error'); ?>', 'ERROR:');
                notification.sound();
            </script>
        <?php endif; ?>
    </div>
</div>
