<?php
/*
 * CopyRight  : [DisM!] (C)2001-2099 DisM Inc.
 * Created on : 2020-02-11,11:00:52
 * Author     : DisM!Ӧ������ dism.taobao.com $
 * Description: ����Դ��Դ�������ռ�,��������ѧϰ����������������ҵ��;����������24Сʱ��ɾ��!.
 * ����Դ��Դ�������ռ�,��������ѧϰ����������������ҵ��;����������24Сʱ��ɾ��!
 * ����ַ�������Ȩ��,�뼰ʱ��֪����,���Ǽ���ɾ��!
 */
if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}
/*
 * Created on 20:31 2011-8-2
 * Author : LKK , http://lianq.net
 * ʹ�÷�����
 *$resizeimage = new myThumbClass($file_name,120,90,$thumb,0,0);  //����120x90��С
 *$resizeimage = new myThumbClass($file_name,1,2,$thumb,1,233);   //���ɸ�,��֮�����233
 *$resizeimage = new myThumbClass($file_name,660,1,$thumb,-1,0);  //���ɿ��660
 *$resizeimage = new myThumbClass($file_name,1,660,$thumb,-1,0);  //���ɸ߶�660
 *ע�⣺�¸߶Ȼ��¿�ȶ�����Ϊ0
*/

class myThumbClass{

	public $sur_file;	//��ȡ��ԭͼƬ
	public $des_file;	//����Ŀ��ͼƬ
	public $tem_file;	//��ʱͼƬ
	public $tag;		//���Ա�ǩ  0,Ĭ��,���̶��ĸ߿�����  1,�����л�̶���󳤶�����  -1,��ĳ����Ȼ�ĳ���߶���С
	public $resize_width;		//$tagΪ0ʱ,Ŀ���ļ���
	public $resize_height;		//$tagΪ0ʱ,Ŀ���ļ���
	public $sca_max;	//$tagΪ1ʱ,<0$sca_max<1ʱΪ��С����;$sca_max>1ʱΪ��󳤶�(�߻��֮�е����ֵ)

	public $type;		//ͼƬ����
	public $width;		//ԭͼƬ��
	public $height;		//ԭͼƬ��

	//���캯��
	public function __construct($surpic, $reswid, $reshei, $despic, $mark, $scamax){
		$this->sur_file = $surpic;
		$this->resize_width = $reswid;
		$this->resize_height = $reshei;
		$this->tag = $mark;
		$this->sca_max = $scamax;

		$this->type = strtolower(substr(strrchr($this->sur_file,"."),1));	//��ȡͼƬ����
		$this->init_img();	//��ʼ��ͼƬ
		$this->des_file = $despic;	//Ŀ��ͼƬ��ַ
		$this->width = imagesx($this->tem_file);
		$this->height = imagesy($this->tem_file);
		$this->new_img();
		imagedestroy($this->tem_file);
	}

	//ͼƬ��ʼ������
	private function init_img(){
		if($this->type == 'jpeg'){
			$this->tem_file = imagecreatefromjpeg($this->sur_file);
		}elseif($this->type == 'jpg'){
			$this->tem_file = imagecreatefromjpeg($this->sur_file);
		}elseif($this->type == 'gif'){
            $this->tem_file = imagecreatefromgif($this->sur_file);
		}elseif($this->type == 'png'){
            $this->tem_file = imagecreatefrompng($this->sur_file);
		}elseif($this->type == 'bmp'){
            $this->tem_file = imagecreatefrombmp($this->sur_file);	
		}
	}

	//ͼƬ���ɺ���
	private function new_img(){
		$ratio = ($this->width)/($this->height);	//ԭͼ����
		$resize_ratio = ($this->resize_width)/($this->resize_height);	//���Ժ����
		$newimg = imagecreatetruecolor($this->resize_width,$this->resize_height);//������ͼƬ

		if($this->tag == 0){	//���̶��߿��ȡ����ͼ
			$newimg = imagecreatetruecolor($this->resize_width,$this->resize_height);//������ͼƬ
			if($ratio>=$resize_ratio){//���ȱ�����,����ͼ�ĸ߱�ԭͼ��,��˸߲���
				imagecopyresampled($newimg, $this->tem_file, 0, 0, 0, 0, $this->resize_width,$this->resize_height, (($this->height)*$resize_ratio), $this->height);
			}elseif($ratio<$resize_ratio){//���ȱ�����,����ͼ�Ŀ��ԭͼ��,��˿���
				imagecopyresampled($newimg, $this->tem_file, 0, 0, 0, 0, $this->resize_width,$this->resize_height, $this->width, (($this->width)/$resize_ratio));
			}
		}elseif($this->tag == 1){	//���̶���������󳤶���С
			if($this->sca_max < 1){	//��������С
				$newimg = imagecreatetruecolor((($this->width)*($this->sca_max)),(($this->height)*($this->sca_max)));//������ͼƬ
				imagecopyresampled($newimg, $this->tem_file, 0, 0, 0, 0, (($this->width)*($this->sca_max)), (($this->height)*($this->sca_max)), $this->width, $this->height);

			}elseif($this->sca_max > 1){	//��ĳ����󳤶���С
				if($ratio>=1){	//��ȸ߳�
					$newimg = imagecreatetruecolor($this->sca_max,($this->sca_max/$ratio));//������ͼƬ
					imagecopyresampled($newimg, $this->tem_file, 0, 0, 0, 0, $this->sca_max,($this->sca_max/$ratio), $this->width, $this->height);
				}else{
					$newimg = imagecreatetruecolor(($this->sca_max*$ratio),$this->sca_max);//������ͼƬ
					imagecopyresampled($newimg, $this->tem_file, 0, 0, 0, 0, ($this->sca_max*$ratio),$this->sca_max, $this->width, $this->height);
				}
			}
		}elseif($this->tag == -1){	//��ĳ����Ȼ�ĳ���߶���С
		  if($resize_ratio>=1){//�¸�С���¿�,��ͼƬ���¿����С
		    $newimg = imagecreatetruecolor($this->resize_width,($this->resize_width/$ratio));//������ͼƬ
			imagecopyresampled($newimg, $this->tem_file, 0, 0, 0, 0, $this->resize_width,($this->resize_width/$ratio), $this->width, $this->height);
		  }elseif($resize_ratio<1){//�¿�С���¸�,��ͼƬ���¸߶���С
		    $newimg = imagecreatetruecolor(($this->resize_height*$ratio),$this->resize_height);//������ͼƬ
					imagecopyresampled($newimg, $this->tem_file, 0, 0, 0, 0, ($this->resize_height*$ratio),$this->resize_height, $this->width, $this->height);
		  }
		}
		

		//�����ͼƬ
		if($this->type == 'jpeg' || $this->type == 'jpg'){
			imagejpeg($newimg,$this->des_file);
		}elseif($this->type == 'gif'){
			imagegif($newimg,$this->des_file);
		}elseif($this->type == 'png'){
			imagepng($newimg,$this->des_file);
		}elseif($this->type == 'bmp'){
			imagebmp($newimg,$this->des_file);//bmp.php�а���
		}

	}#function new_img() end

}#end class

?>