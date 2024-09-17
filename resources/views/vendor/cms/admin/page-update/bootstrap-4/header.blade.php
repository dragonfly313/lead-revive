<h1>
    Edit Page1: <?php echo $page->Title; ?>
    <small>(<?php echo $page->Status; ?>)</small><a href="{{ route('profile.show') }}">
        <button type="button" class="btn btn-success float-right">
            <span class="fa fa-backward"></span>
           &nbsp;&nbsp;&nbsp; Return To Main Page
    </a>
</h1>
<ol class="breadcrumb">
    <li><a href="<?php echo \Sinevia\Cms\Helpers\Links::adminHome(); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="<?php echo \Sinevia\Cms\Helpers\Links::adminHome(); ?>">CMS</a></li>
    <li><a href="<?php echo \Sinevia\Cms\Helpers\Links::adminPageManager(); ?>">Pages</a></li>
    <li class="active">Edit Page</li>
</ol>
