<?php

//banner

system("clear");
echo banner();
echo " [?] Lanjutkan (Y/n) >> ";
$n = trim(fgets(STDIN));
$next = strtolower($n);
if($next == 'n') exit("\n  [!] LABIL LU !? [!]\n\n");

//input nomor
$no = array_unique(explode("\n",str_replace("\r","",file_get_contents("no.txt"))));

echo " [?] [MAX 20] Jumlah >> ";
$jumlah = trim(fgets(STDIN));
if($jumlah > 20){
    exit("\n  [!] MAX 20, BUTA LU YA ? [!]\n\n");
}else{
echo "\n\n";

//count 
$s = 0;
$f = 0;
$l = 0;
$total = count($no);
echo "[!] Total $total nomor [!]\n\n";

//looping

for ($i = 0; $i < $jumlah; $i++) {

foreach ($no as $nomor){
   
   global $nomor;
   
   for ($i = 0; $i < 1; $i++) {
    
        //delay1
        sleep(1);

        //api
     
        $url = "https://api.banditcoding.xyz/prank/bomcall/?no=$nomor";
     
        //curl
     
        $ch = curl_init();
           curl_setopt($ch, CURLOPT_URL, $url);
           curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
           curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
           curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'content-type: application/json',
            'accept: application/json, text/plain, */*'));
        $ok = curl_exec($ch);
        curl_close($ch);
     
        //response
     
        if(strpos($ok, '"msg":"success call to 0'.$nomor.'"')){
            $s++; 
            echo "====================================\n[!] Success call to 0$nomor [!]\n====================================\n";
        }elseif(strpos($ok, '"msg":"failed call to 0'.$nomor.'"')){
            $l++;
            echo "====================================\n[!] Limit call to 0$nomor [!]\n====================================\n";
        }elseif(strpos($ok, '"msg":"invalid parameter"')){
            echo "\n\n[!] INVALID PARAMETER [!]\n\n";
            exit();
        }else{
            $f++;
            echo "====================================\n[!] Error call to 0$nomor [!]\n====================================\n";
            echo $ok;
        }
   }
   
//result
echo "
          ______________
         | [!] INFO [!] |
   ============================
   [-] Success call $s X     [-]
   [-] Limit call $l X       [-]
   [-] Error call $f X       [-]
   ============================
       [!] Delay 10 sec [!]
    [!] CTRL + Z for exit [!]

";

//delay2
sleep(10);

}

}
}


function banner(){
    date_default_timezone_set("Asia/Jakarta");
    $date = date("l, d-m-Y (H:m:s)");
    $banner = "

    ▄▄▄▄·       • ▌ ▄ ·.      ▄▄·  ▄▄▄· ▄▄▌  ▄▄▌  
    ▐█ ▀█▪▪     ·██ ▐███▪    ▐█ ▌▪▐█ ▀█ ██•  ██•  
    ▐█▀▀█▄ ▄█▀▄ ▐█ ▌▐▌▐█·    ██ ▄▄▄█▀▀█ ██▪  ██▪  
    ██▄▪▐█▐█▌.▐▌██ ██▌▐█▌    ▐███▌▐█ ▪▐▌▐█▌▐▌▐█▌▐▌
    ·▀▀▀▀  ▀█▄▀▪▀▀  █▪▀▀▀    ·▀▀▀  ▀  ▀ .▀▀▀ .▀▀▀ 
------------------------------------------------------
  Author   : Zlaxtert
  Version  : 1.2.0
  Date Now : $date
------------------------------------------------------ 
    [*] Note: Limit 1/number delay 10 sec/number [*]

";  
    return $banner;
}
