<?php
/**
 * pcss�ļ��Ľ�����
 */
class pcss{
	private $dirname='';
	private $tmpOutputFile='';
	/**
	 * ��pcss�ļ���������php�ļ�
	 * 
	 * @param string $filename pcss�ļ�
	 * @param string $outputFile Ҫ������ļ�
	 * @return mixed ʧ��false���ɹ�����true
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
	 * �����ʱ�ļ�����pcss������php�������ָ����Ŀ¼
	 * 
	 * @param string $content Ҫ���������
	 * @return bool �ɹ�true��ʧ�ܷ���false
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
	 * ���Ŀ���ļ�
	 * 
	 * @param string $filename Ŀ���ļ�
	 * @return bool �ɹ�����true��ʧ�ܷ���false
	 */
	public function output($filename){
		//���Ŀ¼�����ڣ�������Ŀ¼
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
