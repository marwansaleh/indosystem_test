<div class="container">
    <?php $this->load->view('component/_mainmenu');?>
</div>

<?php
if (isset($page)) {
    $this->load->view($page);
}
?>