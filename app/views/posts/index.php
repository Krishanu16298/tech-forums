<?php require_once APPROOT.'/views/include/header.php';?>
<?php require_once APPROOT.'/views/include/navbar.php';?>
<div class="container" style="min-height:468px;">
    <div class="row mt-1 mb-3">
        <div class="col">
            <h2>Recent Posts</h2>
        </div>
        <div class="col text-right">
            <a href="<?php echo URLROOT.'/posts/add'?>" class="btn bn">Add post</a>
        </div>
    </div>
    
    <div class="row mt-2">
        <div class="col-md-8">
        <?php flash('post_msg');?>
            <?php if(empty($data['posts'])):?>
                <h3>No posts yet. <a href="<?php echo URLROOT.'/posts/add'?>">Add one</a></h3>
            <?php else:?>
            <?php foreach($data['posts'] as $post):?>
            <div class="card card-body mb-2">
                <h3><a href="<?php echo URLROOT.'/posts/show/'.$post->p_id;?>"><?php echo $post->title;?></a></h3>
                <div class="blockquote blockquote-footer">Posted by <?php echo $post->name;?> on <?php echo $post->posted_at;?></div>
                <div class="card-content">
                    <?php echo $post->body;?>
                </div>
                <form action="<?php echo URLROOT;?>/posts" method="post" class="form-group mt-4">
                    <input class="form-control" type="text" name="body" placeholder="Comments...">
                    <input type="hidden" value="<?php echo $post->p_id;?>" name="id">
                    <input type="hidden" value="<?php echo isset($_SESSION['user_name'])? $_SESSION['user_name'] : 'Annonymous' ;?>" name="name">
                </form>
                <?php $count = 0; foreach($data['comments'] as $com):?>
                    <?php if($com->post_id == $post->p_id && ($count++)<4):?>
                        <div class="row mt-2">
                            <div class="col-md-3 text-right">
                                <p class="mt-4"><?php echo $com->comaut;?></p>
                            </div>
                            <div class="card-footer" style="width:70%;">
                            <div class="col-md-9">
                                <p><?php echo $com->comment;?></p>
                            </div>
                            </div>
                        </div>
                    <?php endif;?>
                <?php endforeach;?>
            </div>
            <?php endforeach;?>
            <?php endif;?>
        </div>
        <div class="col-md-4">
            <div class="card card-body mb-4">
                <h3 style="color:rgb(0,80,150);"><b>News</b></h3>
                <hr>
                <?php foreach($data['news'] as $row):?>
                <div class="card-content news-feed mb-1">
                    <a href="<?php echo $row->url;?>" target="<?php echo ($row->url == '#') ? '' : 'blank' ;?>"><?php echo $row->title;?></a>
                </div>
                <?php endforeach;?>
            </div>
        </div>
    </div>
</div>
<?php require_once APPROOT.'/views/include/foot.php';?>
<?php require_once APPROOT.'/views/include/footer.php';?>