<div class="row bs-callout bs-callout-primary task-comment-wrapper" id="task_comment_<?= $task_comment['id'] ?>">
    <div class="col-lg-1 no-padding">
        <img width="90%" src="<?= $task_comment['avatar'] ?>" alt="avatar" class="img-rounded avatar" />

    </div>
    <div class="col-lg-11 ">
        <div >
            <label class="control-label"><?php echo ($task_comment['comment_user'] ? $task_comment['comment_user'] : 'Admin') ?></label>
            comment on <span><?= date('M d, Y', strtotime($task_comment['log_date'])) ?></span>
        </div>
        <?= $task_comment['comment'] ?>
    </div>
    <?php $userdata = $this->session->userdata(); ?>
                                        <?php if (($userdata['employee_id'] == $task_comment['from_employee']) || isset($userdata['permissions']['global_admin'])) { ?>
                                            <div class="cmt-hover" id="cmt-hover-<?= $task_comment['id'] ?>">
                                                <a class="btn btn-outline btn-success btn-xs" href="tasks/edit_comment/<?= $task_comment['id'] ?>" data-target="#modal_window" data-toggle="modal">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                <a class="btn btn-outline btn-danger btn-xs" onclick="confirm('Delete comment?') && submit_form('#delete_comment<?= $task_comment['id'] ?>', '#save_result')" title="Delete">
                                                    <i class="fa fa-trash-o"></i>
                                                </a>

                                                <form action="tasks/delete_comment" method="POST" id="delete_comment<?= $task_comment['id'] ?>">
                                                    <input type="hidden" id="task_comment_id" name="task_comment_id" value="<?= $task_comment['id'] ?>" class="task_comment_id<?= $task_comment['id'] ?>">
                                                </form>
                                            </div>
                                        <?php } ?>
</div>


<style>
@media only screen and (min-width: 767px) {
.no-padding {
   
    text-align: center;
    margin: 0px auto;
}

img.img-rounded.avatar {
    max-width: 53%;
    display: inline-block;
}

.col-lg-11 {
    margin-top: 43px;
    padding: 0px;
}

.col-lg-11 p {
    width: 100%;
    text-align: justify;
}
}
</style>