<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Directory Controller
 *
 * @property \App\Model\Table\DirectoryTable $Directory
 *
 * @method \App\Model\Entity\Directory[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class DirectoryController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'conditions' => ['user_id'  => $this->Auth->user('id')]
        ];
        $directory = $this->paginate($this->Directory);
        //debug($directory);
        //$this->set(compact('directory'));
        $this->set([
            'directory' => $directory,
            '_serialize' => ['directory']
        ]);
    }

    /**
     * View method
     *
     * @param string|null $id Directory id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $directory = $this->Directory->get($id, [
            'contain' => ['Users']
        ]);

        $this->set('directory', $directory);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $directory = $this->Directory->newEntity();
        if ($this->request->is('post')) {
            $directory = $this->Directory->patchEntity($directory, $this->request->getData());
            if ($this->Directory->save($directory)) {
                $this->Flash->success(__('The directory has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The directory could not be saved. Please, try again.'));
        }
        $users = $this->Directory->Users->find('list', ['limit' => 200]);
        $this->set(compact('directory', 'users'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Directory id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $directory = $this->Directory->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $directory = $this->Directory->patchEntity($directory, $this->request->getData());
            if ($this->Directory->save($directory)) {
                $this->Flash->success(__('The directory has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The directory could not be saved. Please, try again.'));
        }
        $users = $this->Directory->Users->find('list', ['limit' => 200]);
        $this->set([
            'derectory' => $directory,
            '_serialize' => 'directory'
        ]);
    }

    /**
     * Delete method
     *
     * @param string|null $id Directory id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $directory = $this->Directory->get($id);
        if ($this->Directory->delete($directory)) {
            $this->Flash->success(__('The directory has been deleted.'));
        } else {
            $this->Flash->error(__('The directory could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
