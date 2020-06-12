<?php

class IndexController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        $albums = new Application_Model_DbTable_Albums();
        $this->view->albums = $albums->fetchAll();
    }

    public function addAction()
    {
        $form = new Application_Form_Album();
        $form->submit->setLabel('Add');
        $this->view->form = $form;

        if ($this->getRequest()->isPost()) {
            $formData = $this->getRequest()->getPost();
            if ($form->isValid($formData)) {
                $artist = $form->getValue('artist');
                $title = $form->getValue('title');
                $albums = new Application_Model_DbTable_Albums();
                $albums->addAlbum($artist, $title);

                $this->_helper->redirector('index');
            }else{
                $form->populate($formData);
            }
        }
    }

    public function editAction()
    {
        $form = new Application_Form_Album();
        $form->submit->setLabel('Save');
        $this->view->form = $form;
        if ($this->getRequest()->isPost()) {
            $formData = $this->getRequest()->getPost();
            if ($form->isValid($formData)) {
                $id = (int)$form->getValue('id');
                $artist = $form->getValue('artist');
                $title = $form->getValue('title');
                $albums = new Application_Model_DbTable_Albums();
                $albums->updateAlbum($id, $artist, $title);
                $this->_helper->redirector('index');
            } else {
                $form->populate($formData);
            }
        } else {
            $id = $this->getParam('id', 0);
            if ($id > 0) {
                $albums = new Application_Model_DbTable_Albums();
                $form->populate($albums->getAlbum($id)->toArray());
            }
        }
    }

    public function deleteAction()
    {
        if ($this->getRequest()->isPost()) {
            $delValue = $this->getRequest()->getPost('del');
            if ($delValue === 'Yes') {
                $albums = new Application_Model_DbTable_Albums();
                $albums->deleteAlbum($this->getRequest()->getPost('id'));
            }
            $this->_helper->redirector('index');
        } else {
            $id = $this->getParam('id', 0);
            $albums = new Application_Model_DbTable_Albums();
            $this->view->album = $albums->getAlbum($id);
        }
    }


}







