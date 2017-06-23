<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use AppBundle\Entity\GratDate;
use AppBundle\Entity\GratItem;


class DailyGratitudeController extends DefaultController
{


    /**
     * @Route("/daily-gratitude/init", name="daily_gratitude_init", options={"expose"=true})
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */

	public function daily_gratitude_init(Request $request) {

		$em = $this->getDoctrine()->getEntityManager();

		$today = new \DateTime();

		/** @var GratDate $GratDateRepo */
		$gratDateRepo = $em->getRepository('AppBundle:GratDate');

		$where_params = (Object) array(
			"fechaDt" => $today->format('Y-m-d')
		);

		$grat_date_entity = $gratDateRepo->fetch($where_params);

		if(null == $grat_date_entity) {
			//no existe, lo creo
			$grat_date_entity = $this->gratitude_date_create();
			$em->persist($grat_date_entity);
		} else {
			//existe
		}

		$em->flush();

		return $this->success($grat_date_entity);

	}


	public function gratitude_date_create() {

		$today = new \DateTime();
		$date = $today->format('Y-m-d');
		$date = new \DateTime($date);

		$gratDate = new GratDate();
		$gratDate->setFechaDt($date);
		$gratDate->setUserId(1);
		$gratDate->setStatus(0);

		return $gratDate;

	}


    /**
     * @Route("/daily-gratitude/submit", name="gratitude_date_submit", options={"expose"=true})
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */

	public function gratitude_date_submit(Request $request) {

		$data = $request->request->get('data');
		$idGratitude = $data['idGratitude'];
		$items       = $data['items'];

		$em = $this->getDoctrine()->getEntityManager();

		$grat_date_entity = $em->getRepository('AppBundle:GratDate')->find($idGratitude);

		foreach ($items as $item_index => $item) {
			$gratitude_item = $this->item_create($idGratitude, $item);
			$em->persist($gratitude_item);
		}

		//cerrar día
		$grat_date_entity->setStatus(1);

		$em->flush();

		return $this->success('done');
		
	}


	private function item_create($idGratitude, $item) {

		$gratitude_item = new GratItem();

		$gratitude_item->setGratId($idGratitude);
		$gratitude_item->setGratText($item['_text']);
		$gratitude_item->setFavoriteFlag($item['_favorite'] == 'true' ? true : false);
		$gratitude_item->setInsertDt(new \DateTime());

		return $gratitude_item;

	}


    /**
     * @Route("/daily-gratitude/consecutive-date", name="daily_gratitude_consecutive_date", options={"expose"=true})
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */

    public function getConsecutiveGratDate(Request $request) {

    	$em = $this->getDoctrine()->getEntityManager();

		/** @var GratDate $GratDateRepo */
		$gratDateRepo = $em->getRepository('AppBundle:GratDate');

		$where_params = (Object) array(
			"status" => 1
		);

		$order_by = " ORDER BY gd.fechaDt DESC";

		$raw = $gratDateRepo->fetch($where_params, $order_by);

		$today = new \DateTime();

		$yesterday = clone $today;
		$yesterday = $yesterday->sub(new \DateInterval('P1D'));

		//si el daily-gratitude de hoy se hizo, empiezo por ahí
		$pivot_date = ($raw[0]->getFechaDt()->format('Y-m-d') == $today->format('Y-m-d')) ? clone $today : clone $yesterday;

		$streak = 0;
		foreach ($raw as $grat_date) {

			if($grat_date->getFechaDt()->format('Y-m-d') == $pivot_date->format('Y-m-d')) {
				$streak++;
			} else {
				//streak broken
				break;
			}

			$pivot_date = clone $grat_date->getFechaDt();
			$pivot_date->sub(new \DateInterval('P1D'));

		}

		return $this->success($streak);

    }

}
