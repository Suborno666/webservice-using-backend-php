<?php

class Status {
    protected function status(int $int, mixed $message) {
        http_response_code($int);
        echo json_encode(["status" => $int, "message" => $message]);
        exit();
    }
}
