<?php

namespace App\Controller\Pages;

use \App\Utils\View;
// Testando o model
use \App\Model\Entity\Organization;


class Home extends Page{
    /**
     * Método responsável por retornar o centeúdo (view) da nossa home
     * @return string
     */
    // public static function getHome(){
    //     // View da Home
    //     $content = View::render('pages/home',[
    //         'name'=>'JEÚ JUNIOR',
    //         'description'=>'GFT',
    //         // 'gatos'=>['bubu','delita']
    //     ]);

    //     // Retorna a view da página
    //     return parent::getPage('JeuJunior',$content);
    // }
        public static function getHome(){
        // View da Home
        $organization = new Organization();
        
        $content = View::render('pages/home',[
            'name'=>$organization->name,
            'description'=>$organization->description,            
            'site'=>$organization->site,            
        ]);

        // Retorna a view da página
        return parent::getPage('JeuJunior',$content);
    }

}