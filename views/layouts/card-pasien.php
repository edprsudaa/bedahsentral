<?php
    use app\models\pendaftaran\Layanan;
    use yii\helpers\Url;
    if($layanan['jenis_layanan']==Layanan::RJ){
        echo $this->render('card-pasien-rj',['layanan'=>$layanan]);
    }elseif($layanan['jenis_layanan']==Layanan::IGD){
        echo $this->render('card-pasien-igd',['layanan'=>$layanan]);
    }elseif($layanan['jenis_layanan']==Layanan::RI){
        echo $this->render('card-pasien-ri',['layanan'=>$layanan]);
    }elseif($layanan['jenis_layanan']==Layanan::OK){
        echo $this->render('card-pasien-ok',['layanan'=>$layanan]);
    }else{
        \Yii::$app->session->setFlash('warning', "Maaf,Pasien Tidak Valid, Harap Pilih Kembali");
        return $this->redirect(Url::to(['/site/index/'], true));
    }
    ?>