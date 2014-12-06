<!doctype html>
<html>
<head>
    <title><?php echo $this->template->title->default("Default title"); ?></title>
    <meta charset="utf-8">
    <meta name="description" content="<?php echo $this->template->description; ?>">
    <meta name="author" content="">
    <?php echo $this->template->meta; ?>
    <link href="<?php print asset_url('css'); ?>/style.css" media="screen" rel="stylesheet" type="text/css" />
    <?php echo $this->template->stylesheet; ?>
</head>
<body>
<?php echo $this->template->header; ?>
<?php echo $this->template->content; ?>
<?php echo $this->template->footer; ?>
<?php echo $this->template->javascript; ?>
</body>
</html>