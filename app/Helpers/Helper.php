<?php

function responseJson($status, $massage, $data = null)
{
    if ($status == 'success') {
        $code = 200;
    } else {
        $code = 422;
    }
    return response()->json([
        'status' => $status,
        'message' => $massage,
        'data' => $data
    ], $code);
}
