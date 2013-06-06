<?php
include_once $_SERVER['DOCUMENT_ROOT'] .
    '/includes/helpers.inc.php';
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title><?php htmlout($pageTitle);?></title>
    </head>
    <body>
       <h1><?php htmlout($pageTitle); ?></h1>
        <form action="?<?php htmlout($action); ?>" method="post">
            <div>
            <p>Are you sure you want to delete <?php echo htmlout($name); ?>?</p>
            </div>
            <div>
                
                <input type="hidden" name="id" value="<?php htmlout($id); ?>">
                <input type="submit" name="action" value="<?php htmlout($button); ?>">
            </div>
        </form>
    </body>
</html>
