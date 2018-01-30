<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Apikey Controller
 *
 * @property \App\Model\Table\ApikeyTable $Apikey
 *
 * @method \App\Model\Entity\Apikey[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ApikeyController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users']
        ];
        $apikey = $this->paginate($this->Apikey);

        $this->set(compact('apikey'));
    }

    /**
     * View method
     *
     * @param string|null $id Apikey id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $apikey = $this->Apikey->get($id, [
            'contain' => ['Users']
        ]);

        $this->set('apikey', $apikey);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $apikey = $this->Apikey->newEntity();
        if ($this->request->is('post')) {
            $apikey = $this->Apikey->patchEntity($apikey, $this->request->getData());
            if ($this->Apikey->save($apikey)) {
                $this->Flash->success(__('The apikey has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The apikey could not be saved. Please, try again.'));
        }
        $users = $this->Apikey->Users->find('list', ['limit' => 200]);
        $this->set(compact('apikey', 'users'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Apikey id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $apikey = $this->Apikey->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $apikey = $this->Apikey->patchEntity($apikey, $this->request->getData());
            if ($this->Apikey->save($apikey)) {
                $this->Flash->success(__('The apikey has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The apikey could not be saved. Please, try again.'));
        }
        $users = $this->Apikey->Users->find('list', ['limit' => 200]);
        $this->set(compact('apikey', 'users'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Apikey id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $apikey = $this->Apikey->get($id);
        if ($this->Apikey->delete($apikey)) {
            $this->Flash->success(__('The apikey has been deleted.'));
        } else {
            $this->Flash->error(__('The apikey could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
