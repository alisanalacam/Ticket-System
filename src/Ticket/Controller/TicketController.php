<?php

namespace Ticket\Controller;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Ticket\Entity\TicketCategory;
use Ticket\Form\TicketCategoryForm;

/**
 * Class TicketController
 * @package Ticket\Controller
 */
class TicketController
{
    public function indexAction(Request $request, Application $app)
    {
        return $app['twig']->render('ticket/index.html.twig');
    }

    public function createAction(Request $request, Application $app)
    {
        return $app['twig']->render('ticket/create.html.twig', array('form' => $form));
    }

    public function updateAction(Request $request, Application $app)
    {
        return $app['twig']->render('ticket/update.html.twig');
    }

    public function destroyAction(Request $request, Application $app)
    {
        return $app['twig']->render('ticket/index.html.twig');
    }

    public function indexCategoryAction(Request $request, Application $app)
    {
        $ticketCategory = $app['orm.em']->getRepository('Ticket\Entity\TicketCategory')->findBy(array(
            'deleted' => 0,
        ), array('id' => 'DESC'));

        return $app['twig']->render('ticket/category/index.html.twig', array('ticketCategory' => $ticketCategory));
    }

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

            $redirect = $app['url_generator']->generate('ticket_category_index');
        } else {
            $redirect = $app['url_generator']->generate('homepage');
        }
        return $app->redirect($redirect);
    }
}