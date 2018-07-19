<?php require_once APPROOT.'/views/include/header.php';?>
<?php require_once APPROOT.'/views/include/navbar.php';?>
<div class="addcontainer">
    <div class="row mt-1 mb-3">
        <div class="col">
            <a href="<?php echo URLROOT.'/posts/show/'.$data['id'];?>" class="btn bn"><i class="fas fa-arrow-left"></i> Back</a>
        </div>
    </div>
    <div class="card card-body mb-3">
        <h2>Edit Post</h2>
        <p>Make changes in your post through this form</p>
        <form action="<?php echo URLROOT.'/posts/edit/'.$data['id'];?>" method="post">
            <div class="form-group">
                <label for="title">Title : *</label>
                <input type="text" name="title" class="form-control <?php echo empty($data['title_err'])?'':'is-invalid'?>" value="<?php echo $data['title'];?>" placeholder="Enter title here ..">
                <span class="invalid-feedback"><?php echo $data['title_err'];?></span>
            </div>
            <div class="form-group">
                <label for="body">Post content : *</label>
                <textarea name="body" id="editor" class="form-control <?php echo empty($data['body_err'])?'':'is-invalid'?>" rows="7" placeholder="Enter the content here"><?php echo $data['body'];?></textarea>
                <span class="invalid-feedback"><?php echo $data['body_err'];?></span>
            </div>
            <div class="form-group">
                <input type="submit" value="Submit" class="bn bn-success bn-block">
            </div>
        </form>
    </div>
</div>
<?php require_once APPROOT.'/views/include/footer.php';?>