<?php

namespace App\Controller;

use App\Document\Stream;
use App\Document\User;
use Doctrine\ODM\MongoDB\DocumentManager;
use Doctrine\ODM\MongoDB\Repository\DocumentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class StreamController
 */
class StreamController extends AbstractController
{
    /**
     * @Route("/admin/streams/{page}", name="streams")
     */
    public function listStreams(DocumentManager $dm, $page = 0)
    {
        $limit = 10;
        $streams = $dm->getRepository(Stream::class)->getAllStreams($page, $limit);
        return $this->render("streams/list_streams.html.twig", [
            'streams' => $streams
        ]);
    }
}