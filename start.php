<?php
date_default_timezone_set('Asia/Baghdad');
$config = json_decode(file_get_contents('config.json'),1);
$id = $config['id'];
$token = $config['token'];
$config['filter'] = $config['filter'] != null ? $config['filter'] : 1;
$screen = file_get_contents('screen');
exec('kill -9 ' . file_get_contents($screen . 'pid'));
file_put_contents($screen . 'pid', getmypid());
include 'index.php';
$accounts = json_decode(file_get_contents('accounts.json') , 1);
$cookies = $accounts[$screen]['cookies'];
$useragent = $accounts[$screen]['useragent'];
$users = explode("\n", file_get_contents($screen));
$uu = explode(':', $screen) [0];
$se = 100;
$i = 0;
$gmail = 0;
$hotmail = 0;
$yahoo = 0;
$mailru = 0;
$aol = 0;
$true = 0;
$false = 0;
$edit = bot('sendMessage',[
    'chat_id'=>$id,
    'text'=>"*Status:-*",
    'parse_mode'=>'markdown',
    'reply_markup'=>json_encode([
            'inline_keyboard'=>[
                [['text'=>'Checked  : '.$i,'callback_data'=>'fgf']],
                [['text'=>'On Userโ๏ธ๐ : '.$user,'callback_data'=>'fgdfg']],
                [['text'=>"Gmail: $gmail",'callback_data'=>'dfgfd'],['text'=>"Yahoo: $yahoo",'callback_data'=>'gdfgfd']],
                [['text'=>'MailRu: '.$mailru,'callback_data'=>'fgd'],['text'=>'Hotmail: '.$hotmail,'callback_data'=>'ghj']],
                [['text'=>'Aol: '.$aol,'callback_data'=>'fahmyaol']],
                [['text'=>'Live โ : '.$true,'callback_data'=>'gj']],
                [['text'=>'NO Live โ: '.$false,'callback_data'=>'dghkf']]
            ]
        ])
]);
$se = 100;
$editAfter = 1;
foreach ($users as $user) {
    $info = getInfo($user, $cookies, $useragent);
    if ($info != false and !is_string($info)) {
        $mail = trim($info['mail']);
        $usern = $info['user'];
        $e = explode('@', $mail);
               if (preg_match('/(live|hotmail|outlook|yahoo|Yahoo|aol|Aol)\.(com)|(gmail)\.(com)|(mail|bk|yandex|inbox|list)\.(ru)/i', $mail,$m)) {
            echo 'check ' . $mail . PHP_EOL;
                    if(checkMail($mail)){
                        $inInsta = inInsta($mail);
                        if ($inInsta !== false) {
                            // if($config['filter'] <= $follow){
                                echo "True - $user - " . $mail . "\n";
                                if(strpos($mail, 'gmail.com')){
                                    $gmail += 1;
                                } elseif(strpos($mail, 'hotmail.com') or strpos($mail,'outlook.com') or strpos($mail,'live.com')){
                                    $hotmail += 1;
                                } elseif(strpos($mail, 'yahoo.com')){
                                    $yahoo += 1;
                                } elseif(preg_match('/(mail|bk|yandex|inbox|list)\.(ru)/i', $mail)){
                                    $mailru += 1;
                                } elseif(strpos($mail, 'aol.com')){ 
                                	$aol += 1;
                                }
                                $follow = $info['f'];
                                $following = $info['ff'];
                                $media = $info['m'];
                                bot('sendMessage', ['disable_web_page_preview' => true, 'chat_id' => $id, 'text' => "ใ๐ ๐๐ ๐๐๐ ๐๐๐ ๐๐๐๐ ๐ใ
โโโโโโโโโโโโ
  .๐. ๐๐๐ด๐ : `$usern`\n 
  .๐งก. ๐ด๐ผ๐ฐ๐ธ๐ป : `$mail`\n 
  .๐. ๐ต๐พ๐ป๐ป๐พ๐๐ด๐๐ : $follow\n 
  .๐งก. ๐ต๐พ๐ป๐ป๐พ๐๐ธ๐ฝ๐ถ : $following\n 
  .๐. ๐ฟ๐พ๐๐ : $media\n
  .๐งก. ๐๐ธ๐ผ๐ด : ".date("Y")."/".date("n")."/".date("d")." : " . date('g:i') . "\n" . " 
โโโโโโโโโโโโ
  โฏTeleโฏ.ย?ย?ย?ย?ย?ย?ย?ย?ย?ย?ย?ย?ย?ย?ย?ย?ย?ย?    ย?ย? โฏCHโฏ\n
:-ย? @Y_OMOย?ย?ย?ย?ย?ย?ย?ย?ย?ย?ย?ย?ย? :-ย? @TTTPTTTTT",
                                
                                'parse_mode'=>'markdown']);
                                
                                bot('editMessageReplyMarkup',[
                                    'chat_id'=>$id,
                                    'message_id'=>$edit->result->message_id,
                                    'reply_markup'=>json_encode([
                                        'inline_keyboard'=>[
                                            [['text'=>'Checked : '.$i,'callback_data'=>'fgf']],
                                            [['text'=>'On User : '.$user,'callback_data'=>'fgdfg']],
                                            [['text'=>"Gmail: $gmail",'callback_data'=>'dfgfd'],['text'=>"Yahoo: $yahoo",'callback_data'=>'gdfgfd']],
                                            [['text'=>'MailRu: '.$mailru,'callback_data'=>'fgd'],['text'=>'Hotmail: '.$hotmail,'callback_data'=>'ghj']],
                                            [['text'=>'Aol: '.$aol,'callback_data'=>'fahmyaol']],
                                            [['text'=>'Live โ : '.$true,'callback_data'=>'gj']],
                                            [['text'=>'NO Live โ : '.$false,'callback_data'=>'dghkf']]
                                        ]
                                    ])
                                ]);
                                $true += 1;
                            // } else {
                            //     echo "Filter , ".$mail.PHP_EOL;
                            // }
                            
                        } else {
                          echo "No Rest $mail\n";
                        }
                    } else {
                        $false +=1;
                        echo "Not Vaild 2 - $mail\n";
                    }
        } else {
          echo "BlackList - $mail\n";
        }
    } elseif(is_string($info)){
        bot('sendMessage',[
            'chat_id'=>$id,
            'text'=>"ุงูุญุณุงุจ - `$screen`\n ุชู ุญุธุฑู ูู *ุงููุญุต*",
            'reply_markup'=>json_encode([
                'inline_keyboard'=>[
                        [['text'=>'ููู ุงููุณุชู ุงูู ุญุณุงุจ ุงุฎุฑ ๐','callback_data'=>'moveList&'.$screen]],
                        [['text'=>'โ ุญุฐู ุงูุญุณุงุจ','callback_data'=>'del&'.$screen]]
                    ]    
            ]),
            'parse_mode'=>'markdown'
        ]);
        exit;
    } else {
        echo "Not Bussines - $user\n";
    }
    usleep(750000);
    $i++;
    if($i == $editAfter){
        bot('editMessageReplyMarkup',[
            'chat_id'=>$id,
            'message_id'=>$edit->result->message_id,
            'reply_markup'=>json_encode([
                'inline_keyboard'=>[
                    [['text'=>'Checked : '.$i,'callback_data'=>'fgf']],
                    [['text'=>'On Userโ๏ธ๐ : '.$user,'callback_data'=>'fgdfg']],
                    [['text'=>"Gmail: $gmail",'callback_data'=>'dfgfd'],['text'=>"Yahoo: $yahoo",'callback_data'=>'gdfgfd']],
                    [['text'=>'MailRu: '.$mailru,'callback_data'=>'fgd'],['text'=>'Hotmail: '.$hotmail,'callback_data'=>'ghj']],
                    [['text'=>'Aol: '.$aol,'callback_data'=>'fahmyaol']],
                    [['text'=>'Live โ : '.$true,'callback_data'=>'gj']],
                    [['text'=>'NO Live โ : '.$false,'callback_data'=>'dghkf']]
                ]
            ])
        ]);
        $editAfter += 1;
    }
}
bot('sendMessage', ['chat_id' => $id, 'text' =>"๐ุงูุชูู ุงููุญุต : ".explode(':',$screen)[0]]);





