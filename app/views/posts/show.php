<?php require_once APPROOT.'/views/include/header.php';?>
<?php require_once APPROOT.'/views/include/navbar.php';?>
<div class="container mt-2 mb-5">
    <div class="row mt-1 mb-3">
        <div class="col">
            <a href="<?php echo URLROOT.'/posts';?>" class="btn bn"><i class="fas fa-arrow-left"></i> Back</a>
        </div>
    </div>
    <?php flash('post_msg');?>
    <div class="row">
        <div class="col-md-9">
            <h1><?php echo $data['post']->title;?></h1>
        </div>
        <?php if(isset($_SESSION['user_name'])):?>
        <?php if($_SESSION['user_name'] == $data['user']->name):?>
        <div class="col-md-3 text-right" style="font-family:Poppins;">
            <a href="<?php echo URLROOT.'/posts/edit/'.$data['post']->id;?>" class="bn bn-success mr-2"><i class="fas fa-pencil-alt"></i> Edit</a>
            <a href="<?php echo URLROOT.'/posts/delete/'.$data['post']->id;?>" class="bn bn-danger ml-2"><i class="fas fa-times"></i> Delete</a>
        </div>
        <?php endif;?>
        <?php endif;?>
    </div>
    <blockquote><span class="blockquote-footer">Posted by <?php echo $data['user']->name;?> at <?php echo $data['post']->posted_at;?></span></blockquote>
    <div class="card card-body mb-3" style="min-height:128px;">
        <div class="row">
            <div class="col-md-1 text-center">
                <p><i class="fas fa-angle-double-right text-success"></i></p>
            </div>
            <div class="col-md-11">
                <p><?php echo $data['post']->body;?></p>
            </div>
        </div>
    </div>
    <form action="<?php echo URLROOT;?>/posts/show/<?php echo $data['post']->id;?>" method="post" class="form-group mt-4">
        <input class="form-control" type="text" name="body" placeholder="Comments...">
        <input type="hidden" value="<?php echo $data['post']->id;?>" name="id">
        <input type="hidden" value="<?php echo $_SESSION['user_name'];?>" name="name">
    </form>
    <?php foreach($data['com'] as $com):?>
        <div class="row mt-3 mb-3">
            <div class="col-md-2 text-right">
                <p class="mt-4"><?php echo $com->comaut;?></p>
            </div>
            <div class="card-footer" style="width:80%;">
            <div class="col-md-10">
                <p><?php echo $com->comment;?></p>
            </div>
            </div>
        </div>
    <?php endforeach;?>
</div>
<?php require_once APPROOT.'/views/include/foot.php';?>
<?php require_once APPROOT.'/views/include/footer.php';?>