<?php
$a = 0;
$b = 1;

for ($i = 0; $i < 10; $i++) {
    echo $a;

    if ($i < 9) {
        echo ", ";
    }

    $next = $a + $b;
    $a = $b;
    $b = $next;
}

echo '<br>';
?>

<?php
$n = 5;
$num = 1;

for ($i = 1; $i <= $n; $i++) {
    for ($j = 1; $j <= $i; $j++) {
        echo $num . " ";
        $num++;
    }

    echo "<br>";
}
?>


<?php
$n = 5;


for ($i = 1; $i <= $n; $i++) {
    for ($j = 1; $j <= $i; $j++) {
        echo chr(64 + $j) . " ";
    }
    echo "<br>";
}

for ($i = $n - 1; $i >= 1; $i--) {
    for ($j = 1; $j <= $i; $j++) {
        echo chr(64 + $j) . " ";
    }
    echo "<br>";
}
?>
