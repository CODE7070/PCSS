<?php
include $rootPath.'/class/pcss.class.php';
/**
 * 监视解析类
 */
class watch{
	private $allFile=array();
	private $pcss;
	
	private $outputDir='';
	
	/**
	 * 构造函数。在其中，创建了pcss解析类
	 */
	public function __construct(){
		$this->pcss=new pcss();
	}
	
	/**
	 * 监视一个文件或者目录
	 * 
	 * @param string $name 文件或者目录
	 * @param string $outputDir 输出的目录
	 */
	public function watch($name,$outputDir){
		if(empty($name)){
			echo "please add a file or a dir to watch\n";
			die;
		}
		if(empty($outputDir)){
			echo "please add a dir to output\n";
			die;
		}
		$this->outputDir=$outputDir;
		if(is_dir($name)){
			$this->watchDir($name);
		}else if(is_file($name)){
			$this->watchFile($name);
		}else{
			echo $name." can't found\n";
			die;
		}
	}
	/**
	 * 循环监视目录
	 * 
	 * @param string $dirname 监视的目录
	 * @param string $outputdir 默认为空，输出的目录
	 */
	public function watchDir($dirname,$outputDir=''){
		if(!empty($outputDir)){
			$this->outputDir=$outputDir;
		}
		while(TRUE){
			$this->fetchDir($dirname,$outputDir);
			sleep(1);
		}
	}
	/**
	 * 循环监视文件
	 * 
	 * @param string $filename 监视的文件
	 * @param string $outputdir 默认为空，输出的目录
	 */
	public function watchFile($filename,$outputDir=''){
		if(!empty($outputDir)){
			$this->outputDir=$outputDir;
		}
		while(TRUE){
			$this->fetchFile($filename,$outputDir);
			sleep(1);
		}
	}
	/**
	 * 获取某个文件的后缀名
	 * 
	 * @param string $file 要取得后缀名的文件
	 * @return string 返回后缀名
	 */
	private function get_extension($file)
	{
		$info = pathinfo($file);
		
		if(empty($info['extension'])){
			return '';
		}
		return $info['extension'];
	}
	
	/**
	 * 监视文件
	 * 
	 * @param string $dirname 要被监视的目录名字
	 */
	private function fetchFile($filename){
		$ext=$this->get_extension($filename);
		if($ext=='pcss'){
			$file_md5=$this->allFile[$filename];
			if(empty($file_md5)){
				//生成php
				$this->pcss->fetch($filename,$this->outputDir.basename($filename,'.pcss').'.css');
				echo $filename.' fetch to'.$this->outputDir.basename($filename,'.pcss').'.css'."\n";
				$this->allFile[$filename]=md5_file($filename);
			}
				
			if($file_md5!=md5_file($filename)){
				//生成php
				$this->pcss->fetch($filename,$this->outputDir.basename($filename,'.pcss').'.css');
				echo $filename.' fetch to'.$this->outputDir.basename($filename,'.pcss').'.css'."\n";
				$this->allFile[$filename]=md5_file($filename);
			}
		}
	}
	/**
	 * 监视目录
	 * 
	 * @param string $dirname 要被监视的目录名字
	 */
	private function fetchDir($dirname){
		foreach(glob($dirname."*") as $key=>$filename) {
  			if(!is_dir($filename) && is_file($filename)){
  				
  				$this->fetchFile($filename);
  		}else{
   			$this->fetchDir($filename."/");
  		}
 		}
	}
}
