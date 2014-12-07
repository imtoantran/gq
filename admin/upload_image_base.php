<?php 	if($_FILES[$input_img]['name']){
			$n++;
			$max_size = 30000;          // maximum file size, in KiloBytes
			//basename($_FILES[$input_img]['name']);
			$alwidth = 2000;            // maximum allowed width, in pixels
			$alheight = 2000;           // maximum allowed height, in pixels
			$allowtype = array('jpeg','jpg','png' );        // allowed extensions
			$FileName=NULL;
			

			$sepext = explode('.', strtolower($_FILES[$input_img]['name']));
			$type = end($sepext);       // gets extension
			$fileupload = $uploadpath.$name_upload.'.jpg';       // gets the file name
			list($width, $height) = getimagesize($_FILES[$input_img]['tmp_name']);     // gets image width and height
			$err = '';         			// to store the errors
		
			// Checks if the file has allowed type, size, width and height (for images)
			if(!in_array($type, $allowtype))
				$err .= 'The file: <b>'. $_FILES[$input_img]['name']. '</b> File không được phép Upload.';
			if($_FILES[$input_img]['size'] > $max_size*1000) 
				$err .= '<br/>File vượt quá dung lượng cỡ cho phép: '. $max_size. ' KB.';
			if(isset($width) && isset($height) && ($width >= $alwidth || $height >= $alheight))
				$err .= '<br/>Vượt quá kích cỡ cho phép: '. $alwidth. ' x '. $alheight;
		
			// If no errors, upload the image, else, output the errors
			if($err == '') {
				if(move_uploaded_file($_FILES[$input_img]['tmp_name'], $fileupload)) { 
					$FileName=$name_upload.'.'.$type;
					$FileType=$_FILES[$input_img]['type'];
					$FileSize=number_format($_FILES[$input_img]['size']/1024, 3, '.', '') .' KB';
						if(isset($width) && isset($height)) 
					$WidthHeight= $width. ' x '. $height;
					$Imageaddress='http://'.$_SERVER['HTTP_HOST'].
												rtrim(dirname($_SERVER['REQUEST_URI']), '\\/').'/'.$fileupload;

					   $image = new SimpleImage();
					   $image->load($fileupload);
					   $image->resize(80,80);
					   $image->save($uploadpath.'thumb_'.$name_upload.'.jpg');
					   					   
				}
				else $err='Upload file không thành công';
			}
			else { $err = 'Upload file không thành công'.$err; }		

		}
        ?>