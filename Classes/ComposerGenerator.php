<?php
/**
 * Create composer.json
 */
class ComposerGenerator {
	public $arrPostData;

	function __construct() {
		$this->arrPostData = $_POST;
		$this->arrGetData = $_GET;
		$this->arrFileUploadEmconf = $_FILES;
		$this->hiddedAction = 'createCompooser';
		$this->extensionName = '';
		$this->invalidPHPFile = '';

		// Let's create composer.json
		if(isset($this->arrPostData['btnCreateComposer'])) {
			$this->createComposer();
		}
		// Let's grab data from ext_emconf
		else if(isset($this->arrFileUploadEmconf['fileUploadEmconf'])) {
			$this->hiddedAction = 'fileUploadEmconf';
			$this->uploadEmconf();
		}
		// Download sample file
		if (!empty($this->arrGetData['downloadFile'])) {
			$filePath = $this->arrGetData['downloadFile'];
			$fileHandle = fopen($filePath, 'r');
		    
		    // Process download
		    if(file_exists($filePath)) {
		        header('Content-Description: File Transfer');
		        header('Content-Type: application/octet-stream');
		        header('Content-Disposition: attachment; filename="'.basename($filePath).'"');
		        header('Expires: 0');
		        header('Cache-Control: must-revalidate');
		        header('Pragma: public');
		        header('Content-Length: ' . filesize($filePath));
		        flush(); // Flush system output buffer
		        readfile($filePath);
		        exit;
		    }
		}
	}

	function getPostData($fieldName) {
		if(isset($this->arrPostData[$fieldName]) && !empty($this->arrPostData[$fieldName])) {
			return $this->arrPostData[$fieldName];
		}
	}

	function uploadEmconf() {
		$phpTempFile = $this->arrFileUploadEmconf['fileUploadEmconf']["tmp_name"];
		$fileHandle = fopen($phpTempFile,'r');
		$strFile = fread($fileHandle, filesize($phpTempFile));

		// Check is it PHP File?
		$isPHPFile = substr($strFile, 0, 5);
		if (strpos($strFile, '<?php') !== false) {
			$strFile = str_replace("<?php", "", $strFile);
			$strFile = str_replace("_EXTKEY", "ext", $strFile);
			@eval($strFile);

			//echo "<pre>";print_r($EM_CONF);

			$this->extensionName = $this->arrPostData['txtAuthorName'] = $EM_CONF['']['title'];

			//$this->arrPostData['txtName'] = $this->extensionName;
			$this->arrPostData['txtTYPO3Core'] = $EM_CONF['']['constraints']['depends']['typo3'];
			$this->arrPostData['txtAuthorName'] = $EM_CONF['']['author'];
			$this->arrPostData['txtAuthorEmail'] = $EM_CONF['']['author_email'];
			$this->arrPostData['txtDescription'] = preg_replace('/\t+/', '', $EM_CONF['']['description']);
			
			$strDepends = '';
			foreach ($EM_CONF['']['constraints']['depends'] as $key => $value) {
				if($key != 'typo3') {
					$this->arrPostData['txtExtName1'] = $key;
					$this->arrPostData['txtExtVersion1'] = $value;
				}
			}

			$txtAutoload = @array_keys($EM_CONF['']['autoload']['psr-4']);
			$this->arrPostData['txtAutoload'] = $txtAutoload[0];
		}
		else {
			$this->invalidPHPFile = 'Yes';
		}

		//print_r($this->arrPostData);exit;

		// Read whole ext_emconf.php
		/*while ($line = fgets($fh)) {

			$arrField = explode("'typo3' => ", $line);
			if(isset($arrField[1])) {
				$this->arrPostData['txtTYPO3Core'] = $this->cleanupComposer($arrField[1]);
			}

			$arrField = explode("'author' => ", $line);
			if(isset($arrField[1])) {
				$this->arrPostData['txtAuthorName'] = $this->cleanupComposer($arrField[1]);
			}

			$arrField = explode("'author_email' => ", $line);
			if(isset($arrField[1])) {
				$this->arrPostData['txtAuthorEmail'] = $this->cleanupComposer($arrField[1]);
			}

			$arrField = explode("'description' => ", $line);
			if(isset($arrField[1])) {
				$this->arrPostData['txtDescription'] = $this->cleanupComposer($arrField[1]);
			}
		}
		fclose($fh);*/
		//echo "<pre>";print_r($this->arrPostData);exit;
		//exit;

		/*// Create folder
		$extFolder = "Downloads/".$this->arrPostData['txtName'];
		if (!file_exists($extFolder)) {
			mkdir($extFolder, 0755);
		}

		$fileName = "ext_emconf.txt";
		$filePath = $extFolder."/".$fileName;
	    $fileHandle = fopen($filePath, 'w');
	    fwrite($fileHandle, $strComposer);*/
	}

	function cleanupComposer($replaceString) {
		$returnString = substr($replaceString, 1, -3);
		return $returnString;
	}

	function createComposer() {
		//echo "<pre>"; print_r($this->arrPostData); echo "</pre>";exit;

		$arrKeywords = explode(",",$this->arrPostData['txtKeywords']);
		$txtKeywords = "";
		foreach ($arrKeywords as $key => $value) {
			$txtKeywords .= ' "'.trim($value).'",';
		}
		
$strComposer = '{
  "name": "'.$this->arrPostData['txtName'].'",
  "type": "typo3-cms-extension",
  "description": "'.$this->arrPostData['txtDescription'].'",
  "keywords": [
    '.$txtKeywords.'
  ],
  "authors": [
    {
      "name": "'.$this->arrPostData['txtAuthorName'].'",
      "email": "'.$this->arrPostData['txtAuthorEmail'].'",
      "role": "'.$this->arrPostData['txtAuthorRole'].'",
      "homepage": "'.$this->arrPostData['txtAuthorURL'].'"
    }
  ],
  "support": {
    "issues": "'.$this->arrPostData['txtSupport'].'"
  },
  "license": ["'.$this->arrPostData['txtLicense'].'"],
  "require": {
    "typo3/cms-core": "'.$this->arrPostData['txtTYPO3Core'].'"
  },
  "autoload": {
    "psr-4": {
      "'.$this->arrPostData['txtAutoload'].'": "Classes/"
    }
  },
  "replace": {
    "'.$this->arrPostData['txtName'].'": "self.version",
    "'.$this->arrPostData['txtVendorPackage'].'": "self.version"
  },
  "extra": {
      "typo3/cms": {
          "extension-key": "'.$this->arrPostData['txtName'].'"
      }
  }
}
';

		// Create folder
		$extFolder = "Downloads/".$this->arrPostData['txtName'];
		if (!file_exists($extFolder)) {
			mkdir($extFolder, 0755);
		}

		// Create and write composer file
		$fileName = "composer.json";
		$filePath = $extFolder."/".$fileName;
	    $fileHandle = fopen($filePath, 'w');
	    fwrite($fileHandle, $strComposer);
	    
	    // Process download
	    if(file_exists($filePath)) {
	        header('Content-Description: File Transfer');
	        header('Content-Type: application/octet-stream');
	        header('Content-Disposition: attachment; filename="'.basename($filePath).'"');
	        header('Expires: 0');
	        header('Cache-Control: must-revalidate');
	        header('Pragma: public');
	        header('Content-Length: ' . filesize($filePath));
	        flush(); // Flush system output buffer
	        readfile($filePath);
	        exit;
	    }
	}
}
?>