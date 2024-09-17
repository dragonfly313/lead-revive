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
        <li class="breadcrumb-item">
            <a href="<?php echo \Sinevia\Cms\Helpers\Links::adminHome(); ?>">
                @include("cms::shared.icons.bootstrap.bi-house")
                Home
            </a>
        </li>
        <li class="breadcrumb-item">
            <a href="<?php echo \Sinevia\Cms\Helpers\Links::adminTemplateManager(); ?>">
                CMS
            </a>
        </li>
        <li class="breadcrumb-item">
            <a href="<?php echo \Sinevia\Cms\Helpers\Links::adminTemplateManager(); ?>">
                Templates
            </a>
        </li>
        <li class="breadcrumb-item active">
            Edit Template
        </li>
    </ol>
</section>
