<h1>
    Page Manager
    <button type="button" class="btn btn-primary float-right" onclick="showPageCreateModal();">
        <span class="fa fa-plus-circle"></span>
        Add Page
    </button>
    <a href="{{ route('profile.show') }}">
        <button type="button" class="btn btn-success float-right">
            <span class="fa fa-backward"></span>
           &nbsp;&nbsp;&nbsp; Return To Main Page
        </button>
    </a>
</h1>
<ol class="breadcrumb">
    <li><a href="<?php echo \Sinevia\Cms\Helpers\Links::adminHome(); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="<?php echo \Sinevia\Cms\Helpers\Links::adminPageManager(); ?>">CMS</a></li>
    <li class="active"><a href="<?php echo \Sinevia\Cms\Helpers\Links::adminPageManager(); ?>">Pages</a></li>
</ol>
