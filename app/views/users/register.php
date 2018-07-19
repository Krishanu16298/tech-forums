<?php require_once APPROOT.'/views/include/header.php';?>
<?php require_once APPROOT.'/views/include/navbar.php';?>
<div class="container">
<div class="row">
    <div class="col-md-6 mr-auto ml-auto mt-3">
        <div class="card card-body">
                <?php flash('post_msg');?>
                <h2>Register</h2>
                <p>Fill this form to register</p>
                <form action="<?php echo URLROOT;?>/users/register" method="post">
                <div class="form-group">
                    <label for="name">Name : </label>
                    <input type="text" class="form-control <?php echo empty($data['name_err'])?'':'is-invalid'?>" name="name" value="<?php echo $data['name'];?>">
                    <span class="invalid-feedback"><?php echo $data['name_err'];?></span>
                </div>
                <div class="form-group">
                    <label for="email">Email : </label>
                    <input type="email" class="form-control <?php echo empty($data['email_err'])?'':'is-invalid'?>" name="email" value="<?php echo $data['email'];?>">
                    <span class="invalid-feedback"><?php echo $data['email_err'];?></span>
                </div>
                <div class="form-group">
                    <label for="pass">Password : </label>
                    <input type="password" class="form-control <?php echo empty($data['pass_err'])?'':'is-invalid'?>" name="pass" value="<?php echo $data['pass'];?>">
                    <span class="invalid-feedback"><?php echo $data['pass_err'];?></span>
                </div>
                <div class="form-group">
                    <label for="conpass">Confirm Password : </label>
                    <input type="password" class="form-control <?php echo empty($data['conpass_err'])?'':'is-invalid'?>" name="conpass" value="<?php echo $data['conpass'];?>">
                    <span class="invalid-feedback"><?php echo $data['conpass_err'];?></span>
                </div>
                <hr>
                <div class="row">
                    <div class="col">
                        <input type="submit" class="form-control bn bn-success" value="Register">
                    </div>
                    <div class="col">
                        <a href="<?php echo URLROOT;?>/users/login" class="form-control bn bn-light">Have an account? Login</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
</div>
<?php require_once APPROOT.'/views/include/footer.php';?>