<h1>
    Template Manager
    <button type="button" class="btn btn-primary pull-right" onclick="showTemplateCreateModal();">
        <span class="glyphicon glyphicon-plus-sign"></span>
        Add Template
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
    <li><a href="<?php echo \Sinevia\Cms\Helpers\Links::adminHome(); ?>">CMS</li>
    <li class="active"><a href="<?php echo \Sinevia\Cms\Helpers\Links::adminTemplateManager(); ?>">Templates</li>
</ol>
