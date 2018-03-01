<?php
/**
 * Created by PhpStorm.
 * User: webintern
 * Date: 01.03.18
 * Time: 15:43
 */

namespace AdminBundle\Controller;


use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

abstract class BaseController extends Controller
{

    /**
     * @param $repo
     * @return \Doctrine\Common\Persistence\ObjectRepository|\Doctrine\ORM\EntityRepository
     */
    public function getRepo($repo){
        return $this->getDoctrine()->getManager()->getRepository($repo);
    }

}