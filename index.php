<?php
    
    // XÂY DỰNG WEBSITE KIẾM TIỀN ONLINE MMO | LIÊN HỆ ZALO 0966142061 | JZONTECH.ASIA

	require_once($_SERVER['DOCUMENT_ROOT']."/core/database.php");
	require_once($_SERVER['DOCUMENT_ROOT']."/core/function.php");

	if(isset($_SESSION['username'])){
		header('Location: /home');
		exit;
	}else{
		if(setting('landing_page') != ''){

			try {
				if (! @include_once($_SERVER['DOCUMENT_ROOT']."/pages/landing/".setting('landing_page').".php")) 
					throw new Exception ('Lỗi: NO_LANDING_PAGE_FOUND (Liên hệ ngay cho đơn vị thiết kế website để xử lí lỗi này)');

				if (!file_exists($_SERVER['DOCUMENT_ROOT']."/pages/landing/".setting('landing_page').".php"))
					throw new Exception ('Lỗi: NO_LANDING_PAGE_FOUND (Liên hệ ngay cho đơn vị thiết kế website để xử lí lỗi này)');

				else
					require_once($_SERVER['DOCUMENT_ROOT']."/pages/landing/".setting('landing_page').".php"); 
			}
			catch(Exception $e) {    
				die('Lỗi: NO_LANDING_PAGE_FOUND (Liên hệ ngay cho đơn vị thiết kế website để xử lí lỗi này)');
			}

		}else{
			header('Location: /auth/login');
			exit;
		}
	}

?>