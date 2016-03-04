<?php
include '../class/pcss.class.php';
/**
 * ���ӽ�����
 */
class watch{
	private $allFile=array();
	private $pcss;
	
	private $outputDir='';
	
	/**
	 * ���캯���������У�������pcss������
	 */
	public function __construct(){
		$this->pcss=new pcss();
	}
	
	/**
	 * ����һ���ļ�����Ŀ¼
	 * 
	 * @param string $name �ļ�����Ŀ¼
	 * @param string $outputDir �����Ŀ¼
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
	 * ѭ������Ŀ¼
	 * 
	 * @param string $dirname ���ӵ�Ŀ¼
	 * @param string $outputdir Ĭ��Ϊ�գ������Ŀ¼
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
	 * ѭ�������ļ�
	 * 
	 * @param string $filename ���ӵ��ļ�
	 * @param string $outputdir Ĭ��Ϊ�գ������Ŀ¼
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
	 * ��ȡĳ���ļ��ĺ�׺��
	 * 
	 * @param string $file Ҫȡ�ú�׺�����ļ�
	 * @return string ���غ�׺��
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
	 * �����ļ�
	 * 
	 * @param string $dirname Ҫ�����ӵ�Ŀ¼����
	 */
	private function fetchFile($filename){
		$ext=$this->get_extension($filename);
		if($ext=='pcss'){
			$file_md5=$this->allFile[$filename];
			if(empty($file_md5)){
				//����php
				$this->pcss->fetch($filename,$this->outputDir.basename($filename,'.pcss').'.css');
				echo $filename.' fetch to'.$this->outputDir.basename($filename,'.pcss').'.css'."\n";
				$this->allFile[$filename]=md5_file($filename);
			}
				
			if($file_md5!=md5_file($filename)){
				//����php
				$this->pcss->fetch($filename,$this->outputDir.basename($filename,'.pcss').'.css');
				echo $filename.' fetch to'.$this->outputDir.basename($filename,'.pcss').'.css'."\n";
				$this->allFile[$filename]=md5_file($filename);
			}
		}
	}
	/**
	 * ����Ŀ¼
	 * 
	 * @param string $dirname Ҫ�����ӵ�Ŀ¼����
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
