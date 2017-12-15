<?php
/**
 * Created by PhpStorm.
 * User: wilder2
 * Date: 14/12/17
 * Time: 17:16
 */

namespace AppBundle\Controller;

use AppBundle\Repository\ObjectRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;

/**
 * Lists all object entities.
 *
 * @Route("search")
 */
class SearchController extends Controller
{
    /**
     * Lists all object entities.
     *
     * @Route("/", name="search")
     * @Method("GET")
     */
    public function searchAction()
    {
        $em = $this->getDoctrine()->getManager();

        $objects = $em->getRepository('AppBundle:Object')->findAll();

        return $this->render('search/search.html.twig', array(
            'objects' => $objects,
        ));
    }

    /**
     * @param Request $request
     * @param $object
     * @return JsonResponse
     * @Route("/objects/list/{object}", name="list-object")
     */
    public function autocompleteAction(Request $request, $object)
    {
        if ($request->isXmlHttpRequest()){
            /**
             * @var $repository ObjectRepository
             */
            $repository = $this->getDoctrine()->getRepository('AppBundle:Object');
            $data = $repository->getObjectLike($object);
            return new JsonResponse(["data" => json_encode($data)]);
        } else {
            throw new HttpException('500', 'Invalid call');
        }
    }
}