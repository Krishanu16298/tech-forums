<?php require_once APPROOT.'/views/include/header.php';?>
<?php require_once APPROOT.'/views/include/navbar.php';?>
<div class="addcontainer">
    <div class="row mt-1 mb-3">
        <div class="col">
            <a href="<?php echo URLROOT.'/posts'?>" class="btn bn"><i class="fas fa-arrow-left"></i> Back</a>
        </div>
    </div>
    <div class="card card-body mb-3">
        <h2>Add Post</h2>
        <p>Fill this form to add new post</p>
        <form action="<?php echo URLROOT.'/posts/add';?>" method="post" id="addForm">
            <div class="form-group">
                <label for="title">Title : *</label>
                <input type="text" name="title" class="form-control <?php echo empty($data['title_err'])?'':'is-invalid'?>" value="<?php echo $data['title'];?>" placeholder="Enter title here ..">
                <span class="invalid-feedback"><?php echo $data['title_err'];?></span>
            </div>
            <div class="form-group">
                <label for="body">Post content : *</label>
                <textarea type="hidden" name="body" id="editor" class="form-control <?php echo empty($data['body_err'])?'':'is-invalid'?>" placeholder="Enter the content here"><?php echo $data['body'];?></textarea>
                <span class="invalid-feedback"><?php echo $data['body_err'];?></span>
            </div>
            <div class="form-group">
                <input type="submit" value="Submit" id="submit" class="bn bn-success bn-block">
            </div>
        </form>
    </div>
</div>
<script>
   
</script>
<?php require_once APPROOT.'/views/include/footer.php';?>