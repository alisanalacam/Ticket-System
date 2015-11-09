<?php

namespace Ticket\Controller;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use Ticket\Entity\TicketCategories;
use Ticket\Entity\TicketCategory;
use Ticket\Entity\TicketTopic;
use Ticket\Form\TicketCategoryForm;
use Ticket\Form\TicketForm;
use Ticket\Form\TicketReplyForm;

/**
 * Class TicketController
 * @package Ticket\Controller
 */
class TicketController
{
    public function indexAction(Request $request, Application $app)
    {
        $userId = $app['session']->get('userId');

        // Kullanıcının ticketları
        if ($app['security']->isGranted('ROLE_USER')) {
            $tickets = $app['orm.em']->getRepository('Ticket\Entity\TicketTopic')->getTickets($userId);

        // Yöneticinin kendisine gelen ticketları
        } else if ($app['security']->isGranted('ROLE_ADMIN')) {
            $tickets = $app['orm.em']->getRepository('Ticket\Entity\TicketTopic')->getTickets(null, $userId);
        }

        foreach ($tickets as &$ticket) {

            $ticketCategories = $app['orm.em']->getRepository('Ticket\Entity\TicketTopic')->getTicketCategories($ticket['id']);

            $ticket['categories'] = $ticketCategories;
        }

        return $app['twig']->render('ticket/index.html.twig', array('tickets' => $tickets));
    }

    /**
     * Ticket oluşturur
     * @param Request $request
     * @param Application $app
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function createAction(Request $request, Application $app)
    {
        $view = new \Zend_View();
        $form = new TicketForm();

        $ticketPriorityList = $app['orm.em']->getRepository('Ticket\Entity\TicketPriority')->ticketPriorityList();
        $ticketCategoryList = $app['orm.em']->getRepository('Ticket\Entity\TicketCategory')->ticketCategoryList();

        $form->setAttrib('class', 'form-horizontal');
        $form->setAction($app['url_generator']->generate('ticket_create'));
        $form->setView($view);
        $form->getElement('priorityId')->addMultiOptions($ticketPriorityList);
        $form->getElement('categories')->setIsArray(true)->addMultiOptions($ticketCategoryList);

        if ($request->getMethod() == 'POST') {

            if ($form->isValid($request->request->all())) {

                $data = $form->getValues();

                $ticket = new TicketTopic();

                $ticket->setSubject($data['subject']);
                $ticket->setContent($data['content']);
                $ticket->setPriorityId($data['priorityId']);
                // Yeni Destek
                $ticket->setStatusId(1);
                // Yetkili Yönetici
                $ticket->setRecepientId(1);
                $ticket->setAuthorId($app['session']->get('userId'));
                $ticket->setUserIp($request->server->get
                ('REMOTE_ADDR'));
                $ticket->setCreatedAt(new \DateTime());
                $ticket->setDeleted(false);

                $app['orm.em']->persist($ticket);
                $app['orm.em']->flush();

                if (is_array($data['categories']) && count($data['categories']) > 0) {

                    foreach ($data['categories'] as $category) {

                        $ticketCategories = new TicketCategories();

                        $ticketCategories->setCategoryId($category);
                        $ticketCategories->setCreatedAt(new \DateTime());
                        $ticketCategories->setDeleted(false);
                        $ticketCategories->setTicketId($ticket->getId());

                        $app['orm.em']->persist($ticketCategories);
                        $app['orm.em']->flush();
                    }
                }

                $app['orm.em']->persist($ticket);
                $app['orm.em']->flush();

                $message = 'Destek başarıyla oluşturuldu.';
                $app['session']->getFlashBag()->add('success', $message);

                $redirect = $app['url_generator']->generate('ticket_index');
                return $app->redirect($redirect);
            }
        }
        return $app['twig']->render('ticket/create.html.twig', array('form' => $form));
    }

    /**
     * Ticket önizleme
     * @param Request $request
     * @param Application $app
     * @return mixed
     */
    public function showAction($id, Request $request, Application $app)
    {
        $view = new \Zend_View();
        $form = new TicketReplyForm();

        $userId = $app['session']->get('userId');

        // Kullanıcının ticketları
        if ($app['security']->isGranted('ROLE_USER')) {
            $ticket = $app['orm.em']->getRepository('Ticket\Entity\TicketTopic')->getTickets($userId, null, $id);

            // Yöneticinin kendisine gelen ticketları
        } else if ($app['security']->isGranted('ROLE_ADMIN')) {
            $ticket = $app['orm.em']->getRepository('Ticket\Entity\TicketTopic')->getTickets(null, $userId, $id);
        }

        $ticketCategories = $app['orm.em']->getRepository('Ticket\Entity\TicketTopic')->getTicketCategories($ticket['id']);
        $ticketReplies = array();

        $form->setAttrib('class', 'form-horizontal');
        $form->setAction($app['url_generator']->generate('ticket_show', array('id' => $id)));
        $form->setView($view);

        if ($request->getMethod() == 'POST') {

            if ($form->isValid($request->request->all())) {

                $data = $form->getValues();

                $ticket = new TicketTopic();

                $ticket->setSubject($data['subject']);
                $ticket->setContent($data['content']);
                $ticket->setPriorityId($data['priorityId']);
                // Yeni Destek
                $ticket->setStatusId(1);
                // Yetkili Yönetici
                $ticket->setRecepientId(1);
                $ticket->setAuthorId($app['session']->get('userId'));
                $ticket->setUserIp($request->server->get
                ('REMOTE_ADDR'));
                $ticket->setCreatedAt(new \DateTime());
                $ticket->setDeleted(false);

                $app['orm.em']->persist($ticket);
                $app['orm.em']->flush();

                $message = 'Destek cevaplandı.';
                $app['session']->getFlashBag()->add('success', $message);

                $redirect = $app['url_generator']->generate('show', array('id' => $id));
                return $app->redirect($redirect);
            }
        }

        return $app['twig']->render('ticket/show.html.twig', array(
            'form' => $form,
            'ticketReplies' => $ticketReplies,
            'ticket' => $ticket,
            'ticketCategories' => $ticketCategories
        ));
    }

    public function updateAction(Request $request, Application $app)
    {
        return $app['twig']->render('ticket/update.html.twig');
    }

    public function destroyAction(Request $request, Application $app)
    {
        return $app['twig']->render('ticket/index.html.twig');
    }

    /**
     * Ticket Kategorisi listeleme
     * @param Request $request
     * @param Application $app
     * @return mixed
     */
    public function indexCategoryAction(Request $request, Application $app)
    {
        $ticketCategory = $app['orm.em']->getRepository('Ticket\Entity\TicketCategory')->findBy(array(
            'deleted' => 0,
        ), array(
            'id' => 'DESC'
        ));

        return $app['twig']->render('ticket/category/index.html.twig', array('ticketCategory' => $ticketCategory));
    }

    /**
     * Ticket Kategorisi oluşturur
     * @param Request $request
     * @param Application $app
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function createCategoryAction(Request $request, Application $app)
    {
        $view = new \Zend_View();
        $form = new TicketCategoryForm();

        $form->setAttrib('class', 'form-horizontal');
        $form->setAction($app['url_generator']->generate('ticket_category_create'));
        $form->setView($view);

        if ($request->getMethod() == 'POST') {

            if ($form->isValid($request->request->all())) {

                $data = $form->getValues();

                // Kategori adı sistemde mevcut mu?
                $existCategoryName = $app['orm.em']->getRepository('Ticket\Entity\TicketCategory')->findOneBy(array(
                    'deleted' => 0,
                    'categoryName' => $data['category_name']
                ));

                // Kategori adı sistemde mevcut ise
                if ($existCategoryName !== null) {

                    $form->getElement('email')->setErrors(array('Bu kategori adı sistemde mevcut!'));

                    return $app['twig']->render('ticket/category/create.html.twig', array('form' => $form));
                }

                $ticketCategory = new TicketCategory();

                $ticketCategory->setCategoryName($data['category_name']);
                $ticketCategory->setCreatedAt(new \DateTime());
                $ticketCategory->setDeleted(false);

                $app['orm.em']->persist($ticketCategory);
                $app['orm.em']->flush();

                $message = 'Destek kategorisi başarıyla oluşturuldu.';
                $app['session']->getFlashBag()->add('success', $message);

                $redirect = $app['url_generator']->generate('ticket_category_index');
                return $app->redirect($redirect);
            }
        }
        return $app['twig']->render('ticket/category/create.html.twig', array('form' => $form));
    }

    /**
     * Ticket Kategorisi günceller
     * @param $id
     * @param Request $request
     * @param Application $app
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function updateCategoryAction($id, Request $request, Application $app)
    {
        $ticketCategory = $app['orm.em']->getRepository('Ticket\Entity\TicketCategory')->findOneBy(array(
            'deleted' => 0,
            'id' => $id,
        ));

        if ($ticketCategory === null) {
            return $app->redirect($app['url_generator']->generate('homepage'));
        }

        $view = new \Zend_View();
        $form = new TicketCategoryForm();

        $form->setAttrib('class', 'form-horizontal');
        $form->getElement('category_name')->setValue($ticketCategory->getCategoryName());
        $form->setAction($app['url_generator']->generate('ticket_category_update', array('id' => $id)));
        $form->setView($view);

        if ($request->getMethod() == 'POST') {
            if ($form->isValid($request->request->all())) {

                $data = $form->getValues();

                // Kendisi dışındaki Kategori adı sistemde mevcut mu?
                $existCategoryName = $app['orm.em']->getRepository('Ticket\Entity\TicketCategory')->existTicketCategory($id, $data['category_name']);

                // Kategori adı sistemde mevcut ise
                if ($existCategoryName !== null) {

                    $form->getElement('catogory_name')->setErrors(array('Bu kategori adı sistemde mevcut!'));

                    return $app['twig']->render('ticket/category/update.html.twig', array('form' => $form));
                }

                $ticketCategory->setCategoryName($data['category_name']);
                $ticketCategory->setUpdatedAt(new \DateTime());

                $app['orm.em']->persist($ticketCategory);
                $app['orm.em']->flush();

                $message = 'Destek kategorisi başarıyla güncellendi.';
                $app['session']->getFlashBag()->add('success', $message);

                $redirect = $app['url_generator']->generate('ticket_category_index');
                return $app->redirect($redirect);
            }
        }
        return $app['twig']->render('ticket/category/update.html.twig', array('form' => $form));
    }

    /**
     * Ticket kategorisini siler
     * @param $id
     * @param Request $request
     * @param Application $app
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function deleteCategoryAction($id, Request $request, Application $app)
    {
        $ticketCategory = $app['orm.em']->getRepository('Ticket\Entity\TicketCategory')->findOneBy(array(
            'deleted' => 0,
            'id' => $id
        ));

        if ($ticketCategory !== null) {
            $ticketCategory->setDeleted(true);
            $ticketCategory->setDeletedAt(new \DateTime());

            $app['orm.em']->persist($ticketCategory);
            $app['orm.em']->flush();

            $message = 'Destek kategorisi başarıyla silindi.';
            $app['session']->getFlashBag()->add('success', $message);

            $redirect = $app['url_generator']->generate('ticket_category_index');
        } else {
            $redirect = $app['url_generator']->generate('homepage');
        }
        return $app->redirect($redirect);
    }
}