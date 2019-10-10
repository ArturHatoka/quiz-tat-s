<?php $cur_domin = 'lp.tat-sait.ru'; if($cur_domin != $_SERVER['SERVER_NAME']){ $headers  = 'MIME-Version: 1.0'."
".'Content-type: text/html; charset=utf-8'."
".'From: SITE-REPUBLISHED <noreplay@'.$_SERVER['SERVER_NAME'].'>'."
"; mail('43media@mail.ru, phonetoyou@gmail.com', 'Копирование сайта '.$cur_domin, '<p>Сайт '.$_SERVER['SERVER_NAME'].' был перенесен на '.$cur_domin.'</p>', $headers); unlink('_cur_domain.php'); } ?>