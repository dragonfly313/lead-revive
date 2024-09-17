<section class="content-header">
    <h1>
        Edit Template: <?php echo $template->Title; ?>
        <small>(#<?php echo $template->Id; ?>)</small>
        <a href="{{ route('profile.show') }}">
            <button type="button" class="btn btn-success float-right">
                <span class="fa fa-backward"></span>
               &nbsp;&nbsp;&nbsp; Return To Main Page
            </button>
        </a>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo \Sinevia\Cms\Helpers\Links::adminHome(); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo \Sinevia\Cms\Helpers\Links::adminHome(); ?>">CMS</a></li>
        <li><a href="<?php echo \Sinevia\Cms\Helpers\Links::adminTemplateManager(); ?>">Templates</a></li>
        <li class="active">Edit Template</li>
    </ol>
</section>
