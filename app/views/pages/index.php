<?php require_once APPROOT.'/views/include/header.php';?>
<?php require_once APPROOT.'/views/include/navbar.php';?>
<div id="showcase" style="background:url('<?php echo URLROOT;?>/public/img/2.jpg') center center no-repeat;background-size:cover;">
    <div class="coverer">
        <h1><?php echo $data['title'];?></h1>
        <p style="font-family:Ubuntu;">Get answers to your questions, and solve others' problems!</p>
        <p><a href="<?php echo URLROOT.'/users/register';?>" class="bn">Register</a> or <a href="<?php echo URLROOT.'/users/login';?>" class="bn bn-success">Login</a></p>
        <p>I hope to make this portal better, like adding 'Search answers' feature in the future!</p>
    </div>
</div>
<?php require_once APPROOT.'/views/include/footer.php';?>