<?php
/**
 * pcss文件的解析类
 */
class pcss{
	private $dirname='';
	private $tmpOutputFile='';
	/**
	 * 将pcss文件，解析成php文件
	 * 
	 * @param string $filename pcss文件
	 * @param string $outputFile 要输出的文件
	 * @return mixed 失败false，成功返回true
	 */
	public function fetch($filename,$outputFile){
		if(!file_exists($filename)){
			echo 'file not found';
			return FALSE;
		}
		$this->dirname=dirname($filename);
		$content_pcss=file_get_contents($filename);
		$content_pcss = preg_replace('/\{:((.|\n)*)\}/iU', '<?php $1 ?>', $content_pcss);
		$this->tempOutput($content_pcss);
		$this->output($outputFile);
		return true;
	}
	
	/**
	 * 输出临时文件，将pcss解析成php后，输出到指定的目录
	 * 
	 * @param string $content 要输出的内容
	 * @return bool 成功true，失败返回false
	 * 
	 */
	public function tempOutput($content){
		if(!file_exists($this->dirname.'/pcss_tmp')){
			mkdir($this->dirname.'/pcss_tmp');
		}
		$this->tmpOutputFile=$this->dirname.'/pcss_tmp/'.md5(time()).'.php';
		file_put_contents($this->tmpOutputFile, $content);
		return TRUE;
	}
	
	/**
	 * 输出目标文件
	 * 
	 * @param string $filename 目标文件
	 * @return bool 成功返回true，失败返回false
	 */
	public function output($filename){
		//如果目录不存在，则建立起目录
		$dir=dirname($filename);
		if(!is_dir($dir)){
			mkdir($dir,0777,TRUE);
		}
		ob_start();
		include($this->tmpOutputFile);
		$content=ob_get_contents();
		ob_end_clean();
		file_put_contents($filename, $content);
		return TRUE;
		
	}
}
