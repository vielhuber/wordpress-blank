<?php
echo \WP\Core::asciiArt();
?>

<!DOCTYPE html>
<html <?= language_attributes() ?>
        class="font-base responsive-typography selection-color scrollbar <?= (!\WP\Core::isProduction() ? 'dev' : '') ?>">
<head>
    <?= wp_head() ?>
</head>
<body <?= body_class() ?>>
<?php include '_templates/_common/header.php'; ?>
