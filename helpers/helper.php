<?php
function query($sql, $fetch = true)
{
    $link = mysqli_connect('localhost', 'root', '12345678', 'system');
    $result = mysqli_query($link, $sql);

    if ($fetch) {
        $result = mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    mysqli_close($link);

    return $result;
}

function now()
{
    return date_format((new DateTime())->setTimezone(new DateTimeZone('Asia/Taipei')), 'Y-m-d H:i:s');
}

function dd($object)
{
    var_dump($object);
    exit;
}
?>