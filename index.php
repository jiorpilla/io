<?php
echo 'test';

ob_start();
?>

<style>
  background{
    color:red;
    }
</style>
<?php
echo 'q';
$test = ob_get_clean();
echo $test;