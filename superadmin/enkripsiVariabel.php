<?php
function kunci($str)
{
    $kunci = 'emsa218e0632df2935317f98d47956c7';
    $hasil = '';
    for ($i = 0; $i < strlen($str); $i++) {
        $karakter = substr($str, $i, 1);
        $kuncikarakter = substr($kunci, ($i % strlen($kunci)) - 1, 1);
        $karakter = chr(ord($karakter) + ord($kuncikarakter));
        $hasil .=  $karakter;
    }
    return urlencode(base64_encode($hasil));
}
function buka($str)
{
    $str = base64_decode(urldecode($str));
    $hasil = '';
    $kunci = 'emsa218e0632df2935317f98d47956c7';
    for ($i = 0; $i < strlen($str); $i++) {
        $karakter = substr($str, $i, 1);
        $kuncikarakter = substr($kunci, ($i % strlen($kunci)) - 1, 1);
        $karakter = chr(ord($karakter) - ord($kuncikarakter));
        $hasil .= $karakter;
    }
    return $hasil;
}