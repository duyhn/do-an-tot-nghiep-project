<?php

class UsersController extends AppController {
	var $layout = "user";
	public $uses = array('Quyengiangvien','Khuvuc','Phong','Hocki','Lichgiangday');
	public function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow(array('index','login','logout','xemPhonghoc','danhsachphong'));
		$this->isGiangvien();
		$this->isGiaovu();
	}
	public function login() {

		// if we get the post information, try to authenticate
		if ($this->request->is('post')) {
			if ($this->Auth->login()) {
				$user=$this->Quyengiangvien->find("list",array('conditions' => array('Quyengiangvien.magiangvien' => $this->Auth->user('id')),'fields' => array('Quyengiangvien.maquyen'),'recursive'=>-1));
				$this->Session->write("roles",$user);
				$this->Session->setFlash(__('Welcome, '. $this->Auth->user('Giangvien.ten')));
				$this->redirect($this->Auth->redirectUrl());
			}
		}
		//if already logged-in, redirect
		if($this->Session->check('Auth.User')){
			$this->redirect(array('controller'=>'Giangviens','action' => 'index'));
		}
		$this->redirect($this->Auth->redirect());
	}

	public function logout() {
		$this->Session->destroy();
		$this->redirect($this->Auth->logout());
	}

	public function index() {
		//print_r($this->User->find('first', array('conditions' => array('User.id' => 45))));
		//print_r($this->Auth->user());
		//print_r(AuthComponent::password("123"));
	}

	public function xemPhonghoc() {
		$this->set("khuvus", $this->Khuvuc->find("all",array('recursive'=>-1)));
	}
	public function danhsachphong(){
		$this->layout=null;
		$khuvuc=$this->request->data['khu'];
		$ngay=$this->request->data['ngay'];
		$listphong=$this->Phong->find("all",array('conditions' => array('Phong.khuVuc' =>$khuvuc),'recursive'=>-1));
		
		$date_stamp = strtotime(date('Y-m-d', strtotime($ngay)));
		$stamp = date('l', $date_stamp);
		$thu=0;
		switch ($stamp){
			case "Sunday":
				$thu=1;
				break;
			case "Monday":
				$thu=2;
				break;
			case "Tuesday":
				$thu=3;
				break;
			case "Wednesday":
				$thu=4;
				break;
			case "Thursday":
				$thu=5;
				break;
			case "Friday":
				$thu=6;
				break;
			case "Saturday":
				$thu=5;
				break;
			default:
				$thu=-1;
		}
		$hocky=$this->Hocki->find("first",array('order'=>array('Hocki.kethuc'=>'DESC'),'recursive'=>-1));
		
		
		for($i=0; $i<count($listphong);$i++){
			$lichday=array();
			$listlich=$this->Lichgiangday->find("all",array('conditions' => array('Lichgiangday.mahocky' =>$hocky['Hocki']['id'],'Lichgiangday.ngaybatdau <= '=>$ngay,'Lichgiangday.ngayketthuc >= '=>$ngay,'Lichgiangday.thu'=>$thu,'Lichgiangday.maphong'=>$listphong[$i]['Phong']['id']),'recursive'=>-1));
			$tutiet=rand (1 , 12 );
			$dentiet=rand ($tutiet , 12 );
			if($dentiet-$tutiet<5 && $dentiet-$tutiet>1)
				array_push($lichday,array("tutiet"=>$tutiet,"dentiet"=>$dentiet));
			foreach ($listlich as $item){
				array_push($lichday,array("tutiet"=>$item['Lichgiangday']['tutiet'],"dentiet"=>$item['Lichgiangday']['dentiet']));
			}
			$listphong[$i]['lichday']=$lichday;
		}	
		$this->set("listphong",$listphong);
	}
}

?>