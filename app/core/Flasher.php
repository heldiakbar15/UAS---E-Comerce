<?php

class Flasher {
    public static function setFlash($pesan, $aksi, $tipe)
    {
        $_SESSION['flash'] = [
            'pesan' => $pesan,
            'aksi'  => $aksi,
            'tipe'  => $tipe
        ];
    }

    public static function flash()
    {
        if (isset($_SESSION['flash'])) {
            $flashData = $_SESSION['flash'];
            unset($_SESSION['flash']);
            return json_encode($flashData);
        }
        return null;
    }
 
}
