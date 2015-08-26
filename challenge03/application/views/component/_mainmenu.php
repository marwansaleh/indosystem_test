<nav class="navbar navbar-default">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li <?php echo $active_menu=='home'?'class="active"':''; ?>><a href="<?php echo site_url('home'); ?>">Home</a></li>
                <li <?php echo $active_menu=='gallery'?'class="active"':''; ?>><a href="<?php echo site_url('gallery'); ?>">Gallery</a></li>
                <li <?php echo $active_menu=='login'?'class="active"':''; ?>><a href="<?php echo site_url('login'); ?>">Admin</a></li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>