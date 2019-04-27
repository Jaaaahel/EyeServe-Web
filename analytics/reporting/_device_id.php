<?php

function get_device_id($secureId)
{
    $query = db()->prepare('SELECT id FROM devices WHERE secure_id = ? LIMIT 1');
    $query->execute([$secureId]);

    $result = $query->fetch();

    if ($result) {
        return $result['id'];
    }

    return;
}
