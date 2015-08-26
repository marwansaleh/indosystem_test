<div class="container">
    <h1><?php echo $page_title; ?></h1>
    
    <p>Please fill the form</p>
    
    <p class="text-danger"><?php echo $error; ?></p>
    <form role="form" method="post" action="<?php echo site_url('home/save'); ?>">
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Your name">
        </div>
        <div class="form-group">
            <label for="address">Address</label>
            <input type="text" class="form-control" id="address" name="address" placeholder="Your address">
        </div>
        <div class="form-group">
            <label for="phone">Phone Number</label>
            <input type="text" class="form-control" id="phone" name="phone" placeholder="Your phone">
        </div>
        <div class="form-group">
            <label for="note">Note</label>
            <input type="text" class="form-control" id="note" name="note" placeholder="Your note">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>